<?php

namespace App\Http\Controllers;

use App\Models\Sponsors;
use Illuminate\Http\Request;


class SponsorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors = Sponsors::all();

        // base64 converting
        foreach ($sponsors as $sponsor) {
            $sponsor->photo = base64_encode($sponsor->photo);
        }

        return response()->json($sponsors);
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
        $sponsor = Sponsors::query()->findOrFail($id);
        $sponsor->link = $request->input('link', null);

        $sponsor->update();
        return response()->json($sponsor, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sponsor = Sponsors::query()->find($id);
        if($sponsor){
            $sponsor -> delete();
            return response()->json('Sponsor deleted', 201);
        } else return response()->json("Sponsor not found", 404);
    }
}
