<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        $lesson->save();
        $lesson->file_path->store("courses/lessons_".$lesson->id."/files");

        return redirect(route('courses.index'));
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
}