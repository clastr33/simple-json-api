<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::create($request->all());

        // Save address if it exists
        $address = $request->input('address');
        if ( isset($address) ) {
            // Take last row
            $userLastRow = User::latest('id')->first();

            // Add user_id to request
            $request->request->add(['user_id' => $userLastRow['id']]);

            UserDetail::create($request->all());
        }

        return response()->json([
            'message' => 'User created',
            'code' => 201,
            'user' => $user
        ]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user->update($request->all());

        return response()->json([
            'message' => 'User updated (put)',
            'code' => 200,
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User deleted',
            'code' => 204
        ]);
    }

}

