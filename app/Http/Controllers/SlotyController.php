<?php

namespace App\Http\Controllers;

use App\Models\Sloty;
use Illuminate\Http\Request;

class SlotyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sloty = Sloty::all();
        return response()->json($sloty);
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
        $slot = new Sloty();
        if(!empty($request->post('od')) || !empty($request->post('do'))) {
            $slot->od = $request->post('od');
            $slot->do = $request->post('do');
            $slot->save();
            return response()->json($slot, 201);

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
        $sloty = Sloty::query()->findOrFail($id);
        $sloty->od = $request->input('data.od');
        $sloty->do = $request->input('data.do');

        $sloty->update();
        return response()->json($sloty, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $slot = Sloty::query()->find($id);
        if($slot){
            $slot -> delete();
            return response()->json('Slot deleted', 201);
        } else return response()->json("Slot not found", 404);
    }
}
