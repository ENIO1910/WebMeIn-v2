<?php

namespace App\Services;


use App\Models\Category;
use App\Models\Course;
use App\Models\Scores;
use Illuminate\Support\Facades\Auth;


class CourseService{
    public static function setCategoryName($categories): array
    {
        $courses = Course::all();
        $categoryNames = [];
        foreach($courses as $course){
            foreach($categories as $category)
                if($course->category_id === $category->id){
                    $categoryNames[$course->category_id] = $category->name;
                }
        }
        return($categoryNames);
    }

    public static function updateScores($request, $id)
    {
        $withoutScore = $request->input('withoutScore');
        if(isset($withoutScore) && $withoutScore === "true"){
            $score = Scores::where('lesson_id', '=', $id)->where('user_id', '=', Auth::user()->id)->firstOrFail();
            $score->percentage = 1;
            $score->update();
            return redirect()->back();
        } else {
            dd('false', $withoutScore);
        }

    }

}
