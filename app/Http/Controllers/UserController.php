<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function show($user)
    {
        return response()->json($user);
    }

    public function showProfile()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function regiister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'username'  => 'required|unique:users',
            'role_id'   => 'required|',
            'password'  => 'required',
            'c_password'=> 'required'
            
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors
            ]);
        }

        $data = $request->only('email','username', 'role_id');
        $data['password'] = becrypt($data['password']);
        $user = User::create($data);

        return response()->json([
            'user'  => $user
        ]);
    }

    public function login(Request $request)
    {
        $validator =  Validatior::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $status = 401;
        $response = ['errors' => 'Unauthorised'];

        if(Auth::attemt($request->only(['email', 'password']))){
            $status = 200;
            return response()->json([
                'token'  => Auth::user(),
                'tokens' => Auth::user()->createToken()->accessToken()
            ]);
            return response()->json($status,$response);
        }
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        $status = User::delete();

        return response()->json([
            'status'    => $status,
            'message'   => $status ? 'Success Deleted User' : 'Error Deleting User'
        ]);
    }
}
