<?php

namespace App\Http\Controllers;

use App\Models\Speakers;
use Illuminate\Http\Request;

class SpeakersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $speakers = Speakers::all();
        return response()->json($speakers);
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
        $speaker = new Speakers();
        if (
            !empty($request->post('meno')) ||
            !empty($request->post('kratky_popis')) ||
            !empty($request->post('dlhy_popis')) ||
            !empty($request->post('spolocnost')) ||
            !empty($request->post('link_na_spolocnost')) ||
            !empty($request->post('photo'))
        ) {
            //"meno", "photo", "kratky_popis", "dlhy_popis", "company_name", "company_link", "headliner", "facebook_link", "twitter_link", "web_link"
            $speaker->meno = $request->post('meno');
            $speaker->photo = $request->post("photo");
            $speaker->kratky_popis = $request->post("kratky_popis");
            $speaker->dlhy_popis= $request->post("dlhy_popis");
            $speaker->company_name = $request->post("spolocnost");
            $speaker->company_link = $request->post("link_na_spolocnost");
            $speaker->headliner = $request->post("headliner");
            $speaker->facebook_link = $request->post('facebook_link', '');
            $speaker->twitter_link = $request->post('twitter_link', '');
            $speaker->web_link = $request->post('webova_stranka', '');
            $speaker->save();
            return response()->json($speaker, 201);
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
        $speaker = Speakers::query()->findOrFail($id);
        $speaker->meno=$request->input("data.meno");
        //$speaker->photo=$request->input("data.photo", null);
        $speaker->kratky_popis=$request->input("data.kratky_popis");
        $speaker->dlhy_popis=$request->input("data.dlhy_popis");
        $speaker->company_name=$request->input("data.company_name");
        $speaker->company_link=$request->input("data.company_link");
        $speaker->headliner=$request->input("data.headliner");
        if ($request->filled('data.facebook_link')) {
            $speaker->facebook_link = $request->input('data.facebook_link');
        }

        if ($request->filled('data.twitter_link')) {
            $speaker->twitter_link = $request->input('data.twitter_link');
        }

        if ($request->filled('data.web_link')) {
            $speaker->web_link = $request->input('data.web_link');
        }
        $speaker->update();
        return response()->json($speaker,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $speaker=Speakers::query()->find($id);
        if($speaker){
            $program=$speaker->stagePrograms;
            if($program){$program->delete();}
            $speaker->delete();
            return response()->json("Deleted speaker with program", 200);
        } else {
            return response()->json("Speaker not found", 404);
        }
    }
}
