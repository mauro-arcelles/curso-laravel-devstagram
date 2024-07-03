<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [new Middleware(('auth'))];
    }
    //
    public function __invoke()
    {
        // obtener a quienes seguimos
        $ids = auth()->user()->following->pluck('id');
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);


        return view('home', [
            'posts' => $posts
        ]);
    }
}
