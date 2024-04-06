<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FinanceType extends Model {

    protected $fillable = [
        'name'
    ];

    protected $table = 'finance_type';


}

?>