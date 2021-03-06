<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plant;
use App\PlantType;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$plants =  Plant::all();
       // $planttype = PlantType::all();

       // return Response::json(['plants' => $plants,'planttype' => $planttype]);

        return Plant::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'type' => 'required|string|max:191',
            'name' => 'required|string|max:191'
        ]);
            
        $input = $request->all();
        return Plant::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191'
        ]);

        $plant = Plant::findOrFail($id);

        $plant->update($request->all());

        return ['message' => 'Update success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plant = Plant::findOrFail($id);

        //delete the user
        $plant->delete();

        return ['messege' => 'User Deleted'];
    }
}
