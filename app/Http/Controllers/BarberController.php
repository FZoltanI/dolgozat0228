<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarberController extends Controller
{
    function index(){
        $barbers = Barber::all();
        return response()->json($barbers, 200, [], JSON_UNESCAPED_UNICODE);
    }

    function store(Request $request){
    }

    function destroy(Request $request){

    }
}
