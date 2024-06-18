<?php

namespace App\Http\Controllers;

use App\Models\RegistredStudent;
use Illuminate\Http\Request;

class RegisteredStudentController extends Controller
{
    public function activateStudent($token)
    {
        $student = RegistredStudent::where('token', $token)->first();

        if ($student) {
            $student->actived = 1;
            $student->save();
            //TODO: doplnit inkrementaciu na tabulku kde pocita ze kolko studentov je uz prihlaseny
            return response()->json(['msg' => 'Aktivacia prebehla v poriadku'], 200);
        } else {
            return response()->json(['msg' => 'Nenasiel som taku registraciu'], 404);
        }
    }
}
