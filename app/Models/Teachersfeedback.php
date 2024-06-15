<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Teachersfeedback extends Model
{
    protected $fillable = [
        'teachername',
        'title',
        'image',
        'text',
        'created_at',
    ];

    protected $table = 'teachersfeedbacks';
}
