<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all(), 200);
    }

    public function userScope()
    {
        $user = User::find()->auth();

        
    }

    public function show()
    {
        //
    }

    /**
     * 
     */
    public function store()
    {

    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
