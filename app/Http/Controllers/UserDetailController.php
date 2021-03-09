<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'address'
        ]);
        $userDetails = UserDetail::create($request->all());

        return response()->json([
            'message' => 'Added to the table user_details',
            'code' => 201,
            'user_details' => $userDetails
        ]);
    }

}
