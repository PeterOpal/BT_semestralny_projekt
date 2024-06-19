<?php

namespace App\Http\Controllers;

use App\Models\CustomStranka;
use Illuminate\Http\Request;

class CustomStrankaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stranky=CustomStranka::all();
        return response()->json($stranky);
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
        $stranka = new CustomStranka();
        if(!empty($request->post('nazov_stranky', ''))) {
            $stranka->nazov_stranky = $request->post('nazov_stranky');
            $stranka->html_kod= $request->post("html_kod");
            $stranka->save();
            return response()->json("OK", 201);

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
        $stranka = CustomStranka::query()->findOrFail($id);
        $stranka->nazov_stranky=$request->input("nazov_stranky");
        $stranka->html_kod=$request->input("html_kod");

        $stranka->update();
        return response()->json("OK",200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stranka=CustomStranka::query()->find($id);
        if($stranka){
            $stranka->delete();
            return response()->json("Deleted webpage", 200);
        } else {
            return response()->json("Webpage not found", 404);
        }
    }
}
