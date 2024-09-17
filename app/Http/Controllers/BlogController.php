<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest()->get();

        return view('site.index', [
            'posts' => $posts
        ]);
    }

    public function post(Post $post)
    {
        $relatedPost = Post::whereHas('tags', function ($q) use ($post) {
            return $q->whereIn('name', $post->tags->pluck('name'));
        })
        ->where('id', '<>', $post->id)
        ->get();

        return view('site.post', [
            'post' => $post,
            'relatedPost' => $relatedPost
        ]);
    }
}
