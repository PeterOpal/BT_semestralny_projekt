<?php

namespace App\Http\Controllers;

use App\Mail\StudentRegistraciaEmail;
use App\Models\RegistredStudent;
use App\Models\VybranePrednasky;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class EmailController extends Controller
{
    private $token='';
    private $msg='Error!';
    public function sendEmail(Request $request){
        $to=$request->post('mail');
        $meno=$request->post('meno');
        $priezvisko=$request->post('priezvisko');

        $stageProgramController = new StageProgramController();
        $programy=$request->post('selected_programs');
        $konvertovane_programy=$stageProgramController->getProgramsName(json_encode($programy));

        if($this->controlAndSave($to, $meno, $priezvisko, $programy)){
            Mail::to($to)->send(new StudentRegistraciaEmail($meno,$priezvisko, $konvertovane_programy, $this->token));
        } else{
            return response()->json(['msg' => $this->msg], 404);
        }

 }

    private function controlAndSave($mail, $meno, $priezvisko, $programy)
    {
        $existingStudent = RegistredStudent::where('mail', $mail)->first();

        if ($existingStudent) {
            $this->msg="Uz si bol registrovany s tymto e-mailom!";
            return false;
        }

        $student=new RegistredStudent();
        //['meno','priezvisko', 'mail', 'skola', 'token', 'activated'];
        $student->meno=$meno;
        $student->priezvisko=$priezvisko;
        $student->mail=$mail;
        do {
            $token = Str::random(32); // Generate a random 32-character token
        } while (RegistredStudent::where('token', $token)->exists());

        $student->token = $token;
        $this->token=$token;
        $student->save();
        $this->ulozitProgramy($student->id,$programy);
        return true;
    }

    private function ulozitProgramy($studentID, $programy){
        //if kontrola ... TODO: doplnit ci je este obsahuje tato stage s aktualnym prednaskami miesto -- else error msg
        foreach ($programy as $programID) {
            if($programID!=null && $programID!=-1){
                $selectedProgram = new VybranePrednasky();
                $selectedProgram->student_id = $studentID;
                $selectedProgram->prednaska_id = $programID;
                $selectedProgram->save();
            }
        }
    }
}
