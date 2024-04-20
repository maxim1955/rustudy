<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'id', 'img_path', 'title', 'brief', 'news_type'
    ];
}
