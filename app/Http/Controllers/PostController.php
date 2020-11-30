<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Validator;
use Carbon;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all(), 200);
    }

    public function userScope()
    {
        $user = User::auth()->id();

        return response()->json(Post::where('user_id', $user)->first(), 200);
    }

    public function scopePublished()
    {
        return response()->json(Post::where('is_published', '=', true)->first(), 200);
    }

    public function show($slug)
    {
        return response()->json(Post::with('tagged')->where('slug', $slug)->get(), 200);
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
            'title'              => 'required',
            'slug'               => 'string',
            'body'               => 'required|max:255',
            'description'        => 'required|max:255',
            'post_category_id'   => 'required',
            'user_id'            => 'required',
            'tags'               => 'string',
            'thumbnail_id'       => 'string',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'errors'=> $validator->errors()
            ]);
        }

        $post = Post::create([
            'title'             => $request->title,
            'slug'              => $request->slug,
            'description'       => $request->description,
            'body'              => $request->body,
            'post_category_id'  => $request->post_category_id,
            'user_id'           => $request->user_id,
            'thumbnail_id'      => $request->thumbnail_id,
            'is_published'      => true,
        ]);

        foreach($post->tags as $tag) {
            echo $tag->name . ' with url slug of ' . $tag->slug;
        }
        $post->tag(explode(',', $request->tags));

        return response()->json([
            'article'   => $post,
            'status'    => $post ? 'Success Created Post' : 'Error Creating Post'
        ]);
    }

    public function publieshedArticle(Request $request)
    {
        if($role->haPermissionTo())
        $validator = Validator::make($request->all(), [
            'title'              => 'required',
            'slug'               => 'string',
            'body'               => 'required|max:255',
            'description'        => 'required|max:255',
            'post_category_id'   => 'required',
            'user_id'            => 'required',
            'tag_id'             => 'string',
            'thumbnail_id'       => 'string'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'errors'=> $validator->errors()
            ]);
        }
        $data = [
            
        ];
        

        $post = Post::updateOrCreate([
            'title' => $request->get('title'),
            'slug'  => $request->get('slug'),
            'description'  => $request->get('description'),
            'body'  => $request->get('body'),
            'post_category_id'  => $request->get('post_category_id') ,
            'user_id'           => $request->get('user_id'),
            'is_published'      => true
        ]);
        $post->reTag($request->tags);

        
        
        return response()->json([
            'status'    => (bool)$post,
            'post'      => $post
        ]);
    }

    public function archive($id)
    {
        $post = Post::find($id);
        $post->is_published = false;
        $post->save();
        
        return response()->json([
            'status'  => (bool)$post,
            'message' => $post ? 'Success Archived Post' : 'Error Archive Post' 
        ]);
    }

    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->body = $request['body'];
        $post->retag($request->tags); //
        $post->save();

        return response()->json([
            'status'  => (bool) $post,  
            'post'    => $post,
        ]);
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
