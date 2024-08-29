<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promocode extends Model
{
    public function onCreating($row)
    {
        $row->setAttribute('code', Str::random(10));
        // $date = date('Y-m-d');
        // if($row->getEnd()>=$date) {
        //     $row->setAttribute('active', 1);
        // }
        // else $row->setAttribute('active', 0);        
    }
}
