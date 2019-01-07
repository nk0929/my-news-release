<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = News::where('title', $cond_title) . orderBy('created_at', 'desc')->paginate(5);
        } else {
            $posts = News::orderBy('created_at', 'desc')->paginate(10);

        }

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('news.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }
    public function show(Request $request)
    {
        $post = News::find($request->id);
        return view('news.show', ['post' => $post]);
    }
}
