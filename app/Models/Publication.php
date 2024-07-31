<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model {
    protected $table = 'publications';
    protected $attributes = ['type_id' => 1,'published'=>1];
}

?>
