<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Scores;
use App\Models\User;
use App\Services\CourseService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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
            'lessons' => Lesson::where('course_id', $course->id)->orderBy('number', 'asc')->paginate(5)
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
    public function store(Request $request, Course $course): RedirectResponse
    {

        $validated = $request->validate([
            'number' => 'required|integer',
            'name' => 'required|max:500',
            'description' => 'required|max:1500',
            'files' => 'nullable|mimes:zip,rar',
            'pdf' => 'nullable|mimes:pdf',
            'course_id' => 'required'
        ]);

        $lesson = new Lesson($validated);
        if(!empty($request->file('files'))) {
            $lesson->file_path = $request->file('files')->store("courses/lessons_" . $course->id . "/files");
        }

        if(!empty($request->file('pdf'))) {
            $lesson->pdf_file_path = $request->file('pdf')->store("courses/lessons_" . $course->id . "/pdf");
        }

        $lesson->save();

        $users = User::pluck('id');
        foreach ($users as $user) {
            $score = new Scores;
            $score->lesson_id = $lesson->id;
            $score->user_id = $user;
            $score->course_id = $course->id;
            $score->percentage = 0;
            $score->save();
        }


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
     * Update the specified resource in storage.
     * @param Request $request
     * @param Lesson $lesson
     * @return RedirectResponse
     */
    public function update(Request $request, Lesson $lesson): RedirectResponse
    {

        $validated = $request->validate([
            'number' => 'required|integer',
            'name' => 'required|max:500',
            'description' => 'required|max:1500',
            'files' => 'nullable|mimes:zip,rar',
            'pdf' => 'nullable|mimes:pdf',
        ]);

        $lesson->fill($validated);
        if(!empty($request->file('files'))) {
            $lesson->file_path = $request->file('files')->store("courses/lessons_".$lesson->course_id."/files");
        }
        if(!empty($request->file('pdf'))) {
            $lesson->pdf_file_path = $request->file('pdf')->store("courses/lessons_".$lesson->course_id."/pdf");
        }
        $lesson->save();

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
            Scores::where('lesson_id', $lesson->id)->delete();
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
            'user' => Auth::user(),
            'lesson' => $lesson,
            'score' => Scores::where('lesson_id', $lesson->id)->where('user_id', '=', Auth::user()->id)->first(),
            'course' => Course::where('id', $lesson->course_id)->first(),
        ]);
    }

    /**
     * @param Lesson $lesson
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile(Lesson $lesson)
    {
        if (empty($lesson->file_path)) {
            return redirect()->back();
        }

        $lesson = Lesson::where('id', $lesson->id)->first();
        return Response::download('storage/'.$lesson->file_path);
    }

    public function updateScore(Request $request, $lesson_id, $withoutScore = false)
    {
        CourseService::updateScores($request, $lesson_id, $withoutScore);
        return redirect()->back();
    }
}
