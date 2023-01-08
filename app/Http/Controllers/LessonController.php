<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Scores;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Collection;

class LessonController extends Controller
{
    public function index(Course $course): View
    {
        return view("courses.lessons.index", [
            'course' => $course,
            'lessons' => Lesson::paginate(5),
        ]);
    }

    public function create(Course $course): View
    {
        return view("courses.lessons.create", [
            'course' => $course
        ]);
    }

    /**
     * Save data to database
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $lesson = new Lesson($request->all());
        $lesson->file_path = $request->file('files');
        $lesson->pdf_file_path = $request->file('pdf');
        $lesson->save();
        $lesson->file_path->store("courses/lessons_".$lesson->id."/files");
        $lesson->file_path->store("courses/lessons_".$lesson->id."/pdf");

        return redirect(route('courses.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lesson $lesson
     * @return View
     */
    public function edit(Lesson $lesson): View
    {
        return view("courses.lessons.edit", [
            'lesson' => $lesson
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lesson $lesson
     * @return JsonResponse
     */
    public function destroy(Lesson $lesson): JsonResponse
    {
        try{
            $lesson->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }

    }

    /**
     * @param Lesson $lesson
     * @return View
     */
    public function userView(Lesson $lesson): View
    {
        return view("lessons.userView", [
            'lesson' => $lesson,
            'score' => Scores::where('lesson_id', $lesson->id)->first(),
            'course' => Course::where('id', $lesson->course_id)->first()
        ]);
    }
}
