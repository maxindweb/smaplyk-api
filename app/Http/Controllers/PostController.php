<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Validator;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all(), 200);
    }

    public function userScope()
    {
        $user = User::auth()->id();

        return response()->json(Post::with('Tag',)->where('user_id', $user)->first(), 200);
    }

    public function scopePublished()
    {
        return response()->json(Post::where('is_published', '=', true)->with('Tag')->first(), 200);
    }

    public function show($id)
    {
        return response()->json(Post::with('Tag', 'Comments')->where('id' ,$id)->first(), 200);
    }

    public function uploadImage(Request $request, Post $post)
    {
        $post->addMediaFromRequest('image')->toMediaCollection('image');
    }

    /**
     * Sotred Post to disk
     * @param Request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'slug'          => 'required|',
            'body'          => 'required|max:255',
            'description'   => 'required|max:255',
            'user_id'       => 'required',
            'tag_id'        => 'required',
            'thumbnail_id'  => 'required|string'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'errors'=> $validator->errors()
            ]);
        }

        $post = Post::create([
            'title'         => $request->article,
            'slug'          => $request->slug,
            'description'   => $request->descriptio,
            'body'          => $request->body,
            'user_id'       => $request->user_id,
            'thumbnail_id'  => $request->thumbnail_id
        ]);

        return response()->json([
            'article'   => $article,
            'status'    => $article ? 'Success Created Post' : 'Error Creating Post'
        ]);
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        $status = Article::delete();

        return response()->json([
            'status'    => $status,
            'message'   => $status ? 'Success Deleted Post' : 'Error Deleting Post'
        ]);
    }
}
