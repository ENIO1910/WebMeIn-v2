<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Services\CourseService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return View
     */
    public function index()
    {
        $categories = Category::all();

        return view('courses.index', [
            'courses' => Course::paginate(10),
            'categories' => CourseService::setCategoryName($categories)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create():View
    {
        return view("courses.create", [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $course = new Course($request->all());
        $course->category_id = $request->category;
        $course->image_path = $request->file('image')->store('courses');
        $course->save();
        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Course  $course
     * @return View
     */
    public function edit(Course $course): View
    {
        return view("courses.edit", [
            'categories' => Category::all(),
            'course' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        $course->fill($request->all());
        $course->category_id = $request->category;
        if(!empty($request->file('image'))) {
            $course->image_path = $request->file('image')->store('courses');
        }
        $course->save();
        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Course $course
     * @return JsonResponse
     */
    public function destroy(Course $course): JsonResponse
    {
        try{
            $course->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aby usunąć kurs usuń lekcje z nim powiązane!'
            ])->setStatusCode(500);
        }

    }
}
