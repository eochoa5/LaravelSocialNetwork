<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller{

    public function postCreatePost(Request $request){
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request['body'];

        $message = "There was an error";

        if($request->user()->posts()->save($post)){
            $message = "Post successfully created!";

        }

        return redirect()->route('dashboard')->with(['message'=>$message]);


    }

    public function getDashboard(){

        $posts = Post::all()->sortByDesc("created_at");


        return view('dashboard', ['posts'=>$posts]);
    }

    public function deletePost($id){
        $post = Post::where('id', $id)->first();

        if(Auth::user() != $post->user){
            return redirect()->back();
        }

        $post->delete();
        return redirect()->route('dashboard')->with(['message'=>'Successfully deleted!']);

    }

    public function editPost(Request $request){
        $this->validate($request, [
            'body' => 'required'
        ]);

        $post = Post::find($request['postid']);

        if(Auth::user() != $post->user){
            return redirect()->back();
        }

        $post->body = $request['body'];
        $post->update();

        return response()->json(['new_body'=>$post->body],200);

    }

}