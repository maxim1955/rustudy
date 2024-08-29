<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $getcode = $request->promocode;
        $promocode = Promocode::all()
            ->where('code',  $getcode);
        if ($promocode)
        {
            if ($promocode->end >= date('Y-m-d')){
                $promocode->active = 1;
            }
            else $promocode->active = 0;
            return response()->json($promocode);
        }
        else return response()->json("no such promocode");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
