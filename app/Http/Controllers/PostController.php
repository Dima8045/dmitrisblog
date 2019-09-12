<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->has('tag_id')) {
            $posts = Post::with(['category','tags'])
                ->wherePublished(1)
                ->whereHas('tags', function($query) use ($request){
                    return $query
                        ->where('tags.id', $request->tag_id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        } else {
            $posts = Post::with(['category', 'tags'])
                ->wherePublished(1)
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }
        return view('welcome', compact('posts'));
    }
}
