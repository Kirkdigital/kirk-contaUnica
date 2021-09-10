<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function show(Post $post)
    {
        $comments = $post->comments()->with('user:id,name,profile_image')->get();
        return view('timeline.show', compact('post', 'comments'));
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->with('user:id,name,profile_image')->withCount('comments', 'likes')
        ->with('likes', function($like){
            return $like->where('user_id', auth()->user()->id)
                ->select('id', 'user_id', 'post_id')->get();
            })
            ->get();

        return view('timeline.index', compact('posts'));
    }
}