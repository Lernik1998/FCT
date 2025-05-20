<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtengo todos los posts
        $posts = Post::all();

        return inertia('Public/Posts', compact('posts'));
    }

    public function show(Post $post)
    {
        return inertia('Public/Post/PostDetails', compact('post'));
    }
}
