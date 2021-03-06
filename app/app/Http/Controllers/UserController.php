<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), User::getRules(), User::getValidationMessage());

        if ($validator->fails()) {
            return response(json_encode(["message" => "Registration unsuccessful", "error" => $validator->errors()]), 400);
        }

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        dispatch(new \App\Jobs\SendMail($request->email));

        return response("Successfully registered", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), ["email" => "required", "password" => "required"]);

        if ($validator->fails()) {
            return response(json_encode(["message" => "Please enter your credentials"]), 400);
        }

        if (!Auth::attempt($request->all())) {
            return response(json_encode(["message" => "Invalid credentials"]), 401);
        }

        $accessToken = Auth::user()->createToken("authToken")->accessToken;
        return response(["message" => "Successfully registered logged in", "token" => $accessToken], 201);
    }
}
