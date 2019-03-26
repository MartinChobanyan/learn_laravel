<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile/posts/my-posts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|nullable|image|mimes:jpeg,bmp,png,gif,svg|max:4096|dimensions:min_width:100,min_height:100,max_width=350,max_height=350',
            'title' => 'required|string|min:3|max:80',
            'content' => 'required|string|min:3|max:700'
        ]);

        $postData = $request->except('photo');
        $postData['author_id'] = Auth::id();
        $postData['photo'] = $request->photo->store('images');
        Post::create($postData);

        return redirect()->back()->with('success', 'Your post has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);

        $request->validate([
            'photo' => 'active_url|nullable|string|max:150',
            'title' => 'required|string|min:3|max:80',
            'content' => 'required|string|min:3|max:700'
        ]);

        $post->fill($request->all());

        $post->save();

        return response()->json(['success' => 'Your post has been successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($post_id)
    {
        Post::destroy($post_id);

        return response()->json(['success' => 'Post has been successfully deleted']);
    }
}
