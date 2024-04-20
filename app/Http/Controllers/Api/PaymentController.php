<?php

namespace App\Http\Controllers\Api;

use Illuminate\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;

class PaymentController extends RestController
{
    public function submit(Request $req) 
    {
        $name = $req->fio;
        $country = $req->country;
        $email = $req->email;
        $phone = $req->telephone;
        Payment::insert([
            'name' => $name,
            'country' =>$country,
            'email' => $email,
            'phone' => $phone
        ]);
        return $this->sendResponse(200);
    }
}
