<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {

    protected $fillable = [
        'status',
        'close',
        'name',
    ];

    protected $table = 'courses';


}

?>