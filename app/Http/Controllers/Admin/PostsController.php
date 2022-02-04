<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|max:255|min:2',
                'content' => 'required'
            ],
            [
                'title.required' => 'Post title is always required',
                'title.min' => 'Post title must be made of least :min characters',
                'title.max' => 'Post title must contain only :max characters',
                'content.required' => 'Post content or description is required'
            ]
        );
        $data = $request->all();
        $new_post = new Post();
        $new_post->category_id = $data['category_id'];
        $new_post->fill($data);
        $new_post->slug = Post::createSlug($data['title']);
        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post)->with('created', 'New post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $categories = Category::find($id);
        return view('admin.posts.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => 'required|max:255|min:2',
                'content' => 'required'
            ],
            [
                'title.required' => 'Post title is always required',
                'title.min' => 'Post title must be made of least :min characters',
                'title.max' => 'Post title must contain only :max characters',
                'content.required' => 'Post content or description is required'
            ]
        );
        $data = $request->all();
        if($data['title'] != $post->title){
            $data['slug'] = Post::createSlug($data['title']);
        }
        $post->update($data);
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', 'Post successfully deleted from Database');
    }
}
