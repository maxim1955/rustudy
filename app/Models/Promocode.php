<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promocode extends Model
{
    public function onCreating($row)
    {
        $row->setAttribute('code', Str::random(10));
    }
}
