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
        $promocode = $req->promocode;
        $sum = $req->sum;
        $address = $req->address;
        $pickup = $req->pickup;
        $subscription = $req->subscription;
        $version = $req->version;
        $courses = $req->courses;
        Payment::insert([
            'name' => $name,
            'country' =>$country,
            'email' => $email,
            'phone' => $phone,
            'promocode' => $promocode,
            'sum' => $sum,
            'address' => $address,
            'pickup' => $pickup,
            'subscription' => $subscription,
            'version' => $version,
            'courses' => $courses
        ]);
        return $this->sendResponse(200);
    }
}