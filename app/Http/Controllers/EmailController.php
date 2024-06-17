<?php

namespace App\Http\Controllers;

use App\Mail\StudentRegistraciaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    public function sendEmail(Request $request){
        $to=$request->post('mail');
        $meno=$request->post('meno');
        $priezvisko=$request->post('priezvisko');

        $stageProgramController = new StageProgramController();
        $programy=$request->post('selected_programs');
        $konvertovane_programy=$stageProgramController->getProgramsName(json_encode($programy));

        Mail::to($to)->send(new StudentRegistraciaEmail($meno,$priezvisko, $konvertovane_programy));
    }
}
