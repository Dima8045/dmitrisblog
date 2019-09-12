<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Services\ImageService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class PostController
 * @package App\Http\Controllers\Admin
 */
class PostController extends Controller
{
    /**
     * @var \App\Http\Services\ImageService
     */
    private $imageService;
    private $imageFolder = 'posts';

    /**
     * ImageController constructor.
     *
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $model)
    {
        return view('posts.index', ['posts' => $model->orderBy('created_at', 'desc')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact( 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostUpdateRequest $request)
    {

        if (!$request->has('published')) {
            $request->merge(['published' => 0]);
        };
        $data = $request->except(['_token', '_method']);

        if ($request->has('image')) {
            $file = $request->file('image');
            $name = $this->imageService->upload($file, $this->imageFolder);
            $data = $request->except(['image']);
            $data = Arr::add($data, 'image', $name);
        }

        $data = Arr::add($data, 'user_id', Auth::id());
        $post = new Post();
        $post->fill($data);
        if ($post->save()) {
            if (!empty($data['tags'])) {
                    $tags = [];

                foreach ($data['tags'] as $tag) {
                    $tags[] = ['post_id' => $post->id, 'tag_id' => $tag];
                }
                DB::table('post_tag')->insert($tags);
            }
            return redirect('post')->with('status', 'Post was created');
        }
        return redirect('post')->with('status', 'Post was not created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Post $post)
    {
        if ($request->user()->cannot('update-post', $post))
        {
            return redirect('post')->with('status', 'You have not permission');
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post',  'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->has('published')) {
            $request->merge(['published' => 0]);
        };
        $data = $request->except(['_token', '_method']);

        if ($request->has('image')) {
            $file = $request->file('image');
            $name = $this->imageService->upload($file, $this->imageFolder);
            $data = $request->except(['image']);
            $data = Arr::add($data, 'image', $name);
        }

        $post = Post::find($id);
        if ($request->user()->cannot('update-post', $post))
        {
            return redirect('post')->with('status', 'You have not permission');
        }

            DB::table('post_tag')->wherePostId($id)->delete();

        if (!empty($data['tags'])) {
            $tags = [];
            foreach ($data['tags'] as $tag) {
                $tags[] = ['post_id' => $id, 'tag_id' => $tag];
            }

            DB::table('post_tag')->insert($tags);
        }

        if ($post->update($data)) {
            return redirect('post')->with('status', 'Post was updated');
        }
        redirect('post')->with('status', 'Post was not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Post $post)
    {
        if ($request->user()->cannot('update-post', $post))
        {
            return redirect('post')->with('status', 'You have not permission');
        }
        $post->delete();
        return redirect()->back()->with('status', 'Post was deleted');
    }
}
