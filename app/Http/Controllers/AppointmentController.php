<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    function index(){
        $appointments = Appointment::all()->load("barber");
        return response()->json($appointments, 200, [], JSON_UNESCAPED_UNICODE);
    }

    function store(Request $request){
        try {
            $request->validate([
                "name" => "required|string|max:255",
                "barber_id" => "required|integer|exists:barbers,id",
                "appointment" => "required|date",
            ], [
                "required" => "A(z) :attribute megadása kötelező!",
                "string" => "A(z) :attribute csak szöveg lehet.",
                "max" => "A(z) :attribute maximum :max karakter hosszú lehet.",
                "integer" => "A(z) :attribute csak szám lehet",
                "date" => "A(z) :attribute csak dátum lehet",
                "exists" => "A megadott :attribute nem létezik."
            ], [
                "name" => "név",
                "barber_id" => "barber azonosító",
                "appointment" => "időpont"
            ]);

            $appointment = Appointment::create($request->all());
            return response()->json(["success" => true, "message" => "Az időpont sikeresen rögzítve!"], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (ValidationException $e) {
            return response()->json(["success" => false, "message" => $e->errors()], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    function destroy(Request $request){
        try{
            $request->validate([
                "id" => "required|integer|exists:appointments,id"
            ], [
                "required" => "A(z) :attribute megadása kötelező!",
                "integer" => "A(z) :attribute csak szám lehet",
                "exists" => "A megadott :attribute nem létezik."
            ]);

            $appointment = Appointment::findOrFail($request->id);
            if ($appointment->delete()){
                return response()->json(["success" => true, "message" => "Az időpont sikeresen lemondva!"], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(["success" => false, "message" => "Hiba az időpont lemondása közben!"], 404, [], JSON_UNESCAPED_UNICODE);
            }
        } catch(ValidationException $e){
            return response()->json(["success" => false, "message" => $e->errors()], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
