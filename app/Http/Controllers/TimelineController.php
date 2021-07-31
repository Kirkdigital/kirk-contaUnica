<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function show(Post $post)
    {
        return view('timeline.show', compact('post'));
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('timeline.index', compact('posts'));
    }
}