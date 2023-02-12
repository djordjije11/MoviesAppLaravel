<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all();
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
            'title' => 'required|string|max:50',
            'year' => 'required|integer|max:'.now()->year,
            'synopsis' => 'string',
            'genre' => 'string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $movie = Movie::create([
            'title' => $request->title,
            'year' => $request->year,
            'synopsis' => $request->synopsis,
            'genre' => $request->genre
        ]);
        $movie->save();
        return response()->json(["The movie is stored.", $movie]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $movie = Movie::find($id);
        if($movie){
            return $movie;
        } else return response()->json(["The review is not found in the database."], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'year' => 'required|integer|max:'.now()->year,
            'synopsis' => 'string',
            'genre' => 'string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $movie = Movie::find($id);
        if($movie){
            $movie->title = $request->title;
            $movie->year = $request->year;
            $movie->synopsis = $request->synopsis;
            $movie->genre = $request->genre;
            $movie->save();
        return response()->json(["The movie is updated successfully.", $movie]);
        } else return response()->json(["The movie is not updated successfully."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $movie = Movie::find($id);
        if($movie){
            $movie->delete();
            return response()->json(["The movie is deleted.", $movie]);
        } else return response()->json(["The movie is not deleted successfully."]);
    }
}
