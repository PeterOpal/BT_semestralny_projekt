<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\StageProgram;
use Illuminate\Http\Request;

class StageProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $programs = StageProgram::with(['speaker:id,meno,company_name,company_link,photo', 'sloty:id,od,do'])->get();
        return response()->json($programs);
    }

    public function getProgramsName($IDs)
    {
        $zvoleneProgramy = explode(',', $IDs);
        $filtorovaneProgramy = array_filter($zvoleneProgramy, function ($id) { return $id !== null && $id != -1; });

        $programs = StageProgram::whereIn('id', $filtorovaneProgramy)->with("sloty")->get(['nazov_prednasky', 'cas']);
        //return json_encode($programs);
        $result="";
        foreach($programs as $program){
            $result.= $program->sloty->od . " - " . $program->nazov_prednasky . "<br>";
        }
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $program = new StageProgram();
        if(!empty($request->post('cas')) || !empty($request->post('nazov_prednasky')) || !empty($request->post('popis'))) {
            $program->cas = $request->post('cas');
            $program->nazov_prednasky = $request->post('nazov_prednasky');
            $program->popis = $request->post('popis');
            $program->stage_id = $request->post('stage_id');
            $program->speaker_id = $request->post('speaker_id', 0);
            $program->save();
            $program->load('speaker');
            return response()->json($program, 201);

        } else {
            return response()->json('Incorrect data', 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $program = StageProgram::query()->findOrFail($id);
        $program->cas = $request->input('data.cas', '');
        $program->nazov_prednasky = $request->input('data.nazov_prednasky', '');
        $program->popis = $request->input('data.popis', "");
        $program->speaker_id = $request->input("data.speaker_id", "");
        $program->update();
        $program->load('speaker');
        return response()->json(['nazov_prednasky'=>$program->nazov_prednasky, 'speaker'=>$program->speaker->meno],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $program = StageProgram::query()->find($id);
        if($program){
            $program -> delete();
            return response()->json('Program deleted', 201);
        } else return response()->json("Program not found", 404);
    }
}
