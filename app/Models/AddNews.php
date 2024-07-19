<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddNews extends Model
{
    protected $fillable = [
        'id', 'fio', 'job', 'news_type', 'title','link','descr','shortDescr'
    ];
}