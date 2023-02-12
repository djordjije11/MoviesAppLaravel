<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReviewResource::collection(Review::all());
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
            'rating' => 'required|integer|max:5|min:1',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $movie = Movie::find($request->movie_id);
        if(!$movie){
            return response()->json(["The movie is not in the database."], 404);
        }
        $reviewer = Reviewer::find($request->reviewer_id);
        if(!$reviewer){
            return response()->json(["The reviewer is not in the database."], 404);
        }
        $review = Review::create([
            'reviewer_id' => $reviewer->id,
            'movie_id' => $movie->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);
        $review->save();
        return response()->json(["The review is stored.", $review]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $review = Review::find($id);
        if($review){
            $reviewResource = new ReviewResource($review);
            if($reviewResource){
                return $reviewResource;
            }
        }
        return response()->json(["The review is not found in the database."], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $review = Review::find($id);
        if($review){
            $review->delete();
            return response()->json(["The review is deleted.", $review]);
        } else return response()->json(["The review is not deleted successfully."]);
    }
}
