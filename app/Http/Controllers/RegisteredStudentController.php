<?php

namespace App\Http\Controllers;

use App\Models\RegistredStudent;
use App\Models\Stage;
use App\Models\StageProgram;
use App\Models\VybranePrednasky;
use Illuminate\Http\Request;

class RegisteredStudentController extends Controller
{

    private $increment_msg='';
    public function activateStudent($token)
    {
        $student = RegistredStudent::where('token', $token)->first();

        if ($student) {
            $zvolene_programy = VybranePrednasky::where('student_id', $student->id)->get();

            if($student->actived==0){
                $student->actived = 1;
                $student->save();

                $this->incrementMiesta($student->id);
                $zvolene_programy = VybranePrednasky::where('student_id', $student->id)->get();

                return response()->json(['msg' => 'Aktivacia prebehla v poriadku', "was_activated"=>0 ,"student"=>$student, "programy"=>$zvolene_programy, "increment_msg"=>$this->increment_msg], 200);
            } else{
                return response()->json(['msg' => 'Pouzivatel uz bol aktivovane', "was_activated"=>1, "student"=>$student, "programy"=>$zvolene_programy], 200);
            }

        } else {
            return response()->json(['msg' => 'Nenasiel som taku registraciu'], 404);
        }
    }

    public function getStudents()
    {
        $student = RegistredStudent::all();
        return response()->json($student);
    }
    private function incrementMiesta($studentID)
    {
        $programs = VybranePrednasky::where('student_id', $studentID)->get();

        foreach ($programs as $program) {
            $stage_program = StageProgram::find($program->prednaska_id);

            if ($stage_program) {
                $stage = Stage::find($stage_program->stage_id);

                if ($stage) {
                    if ($stage_program->obsadenost < $stage->kapacita) {
                        $stage_program->obsadenost++;
                        $stage_program->save();
                    } else{
                        $this->increment_msg.= $stage_program->nazov_prednasky." uz nie je dostupne kvoli kapacitu. ";
                        $program->delete();
                    }
                }
            }
        }

        $this->increment_msg = json_encode($this->increment_msg);
    }

    public function zrusitRezervaciu($token){
        $student = RegistredStudent::where('token', $token)->first();
        $programs = VybranePrednasky::where('student_id', $student->id)->get();
        foreach ($programs as $program) {
            $stage_program = StageProgram::find($program->prednaska_id);
            if($stage_program){
                $stage_program->obsadenost--;
                $stage_program->save();
            }
            $program->delete();
        }
        $student->delete();
        return response()->json(["msg"=>"Zrusena registracia"]);
    }

}
