<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $table = 'events';

>>>>>>> 4dc915241025ad6c35266f8529aed3074e7b8fbf
}
