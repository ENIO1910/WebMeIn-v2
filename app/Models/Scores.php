<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lesson_id',
      'percentage',
    ];

    public static function percentageOver75ByCourse()
    {
        return Scores::selectRaw('course_id,
                            ROUND((SUM(IF(percentage > 0.75, 1, 0)) / COUNT(id)) * 100, 2) as percentage_over_75')
            ->groupBy('course_id')
            ->get();
    }

}
