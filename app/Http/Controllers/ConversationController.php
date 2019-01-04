<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Interest;
use Illuminate\Http\Request;
use Validator;

class ConversationController extends Controller
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
            'title' => 'required|unique:conversations',
            'id' => 'required|integer'
         ]);
         if ($validator->fails()) {
             return response()->json($validator->errors());
         }
         $conv = Conversation::create([
            'title' => $request->title,
            'interest_id' =>$request->id,
            'participants' => 1
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function isSubscribed($pageTitle, $userInt)
    {
       foreach ($userInt as $userI) {
           if ($userI['title'] = $pageTitle) {
               $subscribed = true;
           }
       }

       return response()->json(["subscribed" => $subscribed]);
    }

    public function subscribed($id)
    {
        $conversation = Conversation::find($id)->load('message.user', 'interest');

        return response()->json(["conversation" => $conversation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
