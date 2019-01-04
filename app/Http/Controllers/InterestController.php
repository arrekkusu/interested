<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use JWTAuth;
use Validator;
use Carbon\Carbon;
use App\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'title' => 'required|unique:interests',
            'description' => 'required',
            'category_id' => 'required|array'
         ]);
         if ($validator->fails()) {
             return response()->json($validator->errors());
         }
         $interest = Interest::create([
            'title' => $request->title,
            'description' => $request->description,
            'participants' => 0
         ]);

        $categories = $request->category_id;

        foreach ($categories as $category) {
            $interest->category()->attach($category);
        }

        $success = true;

        return response()->json(["success" => $success]);
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function getAll(Interest $interest)
    {
        $interests = Interest::select('id', 'title', 'description', 'interest_url')->orderBy('title')->get();
    
        return response()->json(["interests" => $interests]);
    }

    public function show($id)
    {
        $interest = Interest::find($id)->load('conversation', 'category');
    
        return response()->json(["interest" => $interest]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function edit(Interest $interest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function subscribe(int $int, $id, Request $request)
    {
        $user = User::find($id);

        $interest = Interest::find($int)->increment('members');

        $interest = Interest::find($int)->load('category');

        $user->interest()->attach($int);

        $category = $interest->category;

        foreach ($category as $intCategory) {

            $cat = $intCategory['id'];

                $user->category()->syncWithoutDetaching($cat);
            }

        $subscribed = true;

        return response()->json(["subscribed" => $subscribed, "interest" => $int, "user" => $id, "category" => $category]);
    }

    public function unsubscribe($int, $id)
    {
        $user = User::find($id);

        $interest = Interest::find($int)->load('category')->decrement('members');

        $user->interest()->detach($interest);

        $subscribed = false;

        return response()->json(["subscribed" => $subscribed]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interest $interest)
    {
        //
    }
}
