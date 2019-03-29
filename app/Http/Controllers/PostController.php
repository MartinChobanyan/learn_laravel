<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

    public function getPhoto($post_id)
    {
        $post = Post::findOrFail($post_id);
        $file = Storage::get($post->photo);
        $mimeType = Storage::mimeType($post->photo);

        $response = Response::make($file);
        $response->header('Content-Type', $mimeType);

        return $response;
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
            'photo' => 'required|image|mimes:jpeg,bmp,png,gif,svg|max:4096|dimensions:min_width:100,min_height:100',
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
        $post = Post::where('author_id', Auth::id())
            ->where('id', $post_id)
            ->firstOrFail();

        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,bmp,png,gif,svg|max:4096|dimensions:min_width:100,min_height:100',
            'title' => 'required|string|min:3|max:80',
            'content' => 'required|string|min:3|max:700'
        ]);

        $post->fill($request->except('photo'));

        if($request->photo){
            Storage::delete($post->photo);
            $post->photo = $request->photo->store('images');
        }

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
        $post = Post::findOrFail($post_id);
        
        Storage::delete($post->photo);
        $post->delete();

        return response()->json(['success' => 'Post has been successfully deleted']);
    }
}
