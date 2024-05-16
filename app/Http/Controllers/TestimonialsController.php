<?php

namespace App\Http\Controllers;

use App\Models\Testimonials;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonials::all();

        /*foreach ($testimonials as $testimonial) {
            $testimonial->photo = base64_encode($testimonial->photo);
        }*/
        return response()->json($testimonials);
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
        $testimonial = new Testimonials();
        if(!empty($request->post('person')) && !empty($request->post('description'))) {
            $testimonial->person = $request->post('person');
            $testimonial->description = $request->post('description');
            $testimonial->photo = $request->post('photo', '');
            $testimonial->save();
            return response()->json($testimonial, 201);
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
        $testimonial = Testimonials::query()->findOrFail($id);
        $testimonial->person = $request->input('person');
        $testimonial->description = $request->input('description');

        $testimonial->update();
        return response()->json($testimonial, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonials::query()->find($id);
        if($testimonial){
            $testimonial -> delete();
            return response()->json('Testimonial deleted', 201);
        } else return response()->json("Testimonial not found", 404);
    }
}
