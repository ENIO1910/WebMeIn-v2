<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Scores;
use App\Services\CourseService;
use App\Services\LessonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $scores = Scores::where('user_id', Auth::user()->id)->get();
        $courses_percentages = Scores::percentageOver75ByCourse();
        return view('home', [
            'courses' => Course::paginate(10),
            'lessons' => Lesson::all(),
            'scores' => $scores,
            'percentages' => $courses_percentages
        ]);
    }




}
