<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AutoCompleteController extends Controller
{
    public function getUsers()
    {
        $users = User::get();

        return response()->json(["users" => $users]);
    }
    public function searchUsers($id)
    {
        $searchedUsers = User::findOrFail()->where('name', '=', $id)->get();

        return response()->json(["searchedUsers" => $searchedUsers]);
    }
}
