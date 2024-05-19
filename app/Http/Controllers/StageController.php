<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = Stage::all();
        return response()->json($stages);
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
        $stage = new Stage();
        if(!empty($request->post('name', '')) || !empty($request->post('datum', '')) || !empty($request->post('kapacita', ''))) {
            $stage->name = $request->post('name');
            $stage->datum = $request->post('datum');
            $stage->kapacita = $request->post('kapacita');
            $stage->save();
            return response()->json($stage, 201);

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
        //
        $stage = Stage::query()->findOrFail($id);
        $stage->name = $request->input('name', '');
        $stage->datum = $request->input('datum', '');
        $stage->kapacita = $request->input('kapacita', 0);

        $stage->update();
        return response()->json($stage, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $stage = Stage::query()->find($id);
        if($stage){
            $stage -> delete();
            return response()->json('Stage deleted', 201);
        } else return response()->json("Stage not found", 404);
    }
}
