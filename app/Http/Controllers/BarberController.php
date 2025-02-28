<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barber;
use Illuminate\Validation\ValidationException;

class BarberController extends Controller
{
    function index(){
        $barbers = Barber::all();
        return response()->json($barbers, 200, [], JSON_UNESCAPED_UNICODE);
    }

    function store(Request $request){
        try{
            $request->validate([
                "barber_name" => "required|string|max:255", 
            ], [
                "required" => "A(z) :attribute megadása kötelező!",
                "string" => "A(z) :attribute csak szöveg lehet.",
                "max" => "A(z) :attribute maximum :max karakter hosszú lehet."
            ], [
                "barber_name" => "barber neve",
            ]);

            $barber = Barber::create($request->all());
            return response()->json(["success" => true, "message" => "A barber sikeresen rögzítve!"], 200, [], JSON_UNESCAPED_UNICODE);
        } catch(ValidationException $e){
            return response()->json(["success" => false, "message" => $e->errors()], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    function destroy(Request $request){
        try{
            $request->validate([
                "id" => "required|integer|exists:barbers,id"
            ], [
                "required" => "A(z) :attribute megadása kötelező!",
                "integer" => "A(z) :attribute csak szám lehet",
                "exists" => "A megadott :attribute nem létezik."
            ]);

            $barber = Barber::findOrFail($request->id);
            if ($barber->delete()){
                return response()->json(["success" => true, "message" => "A barber törlése sikeres!"], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(["success" => false, "message" => "A barber nem található!"], 404, [], JSON_UNESCAPED_UNICODE);
            }
        } catch(ValidationException $e){
            return response()->json(["success" => false, "message" => $e->errors()], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
