<?php

namespace App\Http\Controllers;

use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return Reviewer::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'birthday' => 'string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $reviewer = Reviewer::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthday' => $request->birthday
        ]);
        $reviewer->save();
        return response()->json(["The reviewer is stored.", $reviewer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function show(int $id) //GET
    {
        $reviewer = Reviewer::find($id);
        if($reviewer){
            return $reviewer;
        } else return response()->json(["The reviewer is not found in the database."], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function edit(Reviewer $reviewer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'birthday' => 'string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $reviewer = Reviewer::find($id);
        if($reviewer){
            $reviewer->firstname = $request->firstname;
            $reviewer->lastname = $request->lastname;
            $reviewer->birthday = $request->birthday;
            $reviewer->save();
            return response()->json(["The reviewer is updated successfully.", $reviewer]);
        } else return response()->json(["The reviewer is not in the database."], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $reviewer = Reviewer::find($id);
        if($reviewer){
            $reviewer->delete();
            return response()->json(["The reviewer is deleted.", $reviewer]);
        } else return response()->json(["The reviewer is not in the database."], 404);
    }
}
