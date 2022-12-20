<?php

namespace App\Services;


use App\Models\Category;
use App\Models\Course;


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
}
