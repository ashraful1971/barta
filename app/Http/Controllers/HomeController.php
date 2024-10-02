<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with(['user','comments'])->get();
        return view('pages.feed', compact('posts'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'image' => 'image|nullable'
        ]);

        if($request->hasFile('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }

        $request->user()->posts()->create($validatedData);

        return redirect()->back()->with('success', 'New post published!');
    }

    public function show(Post $post)
    {
        return view('pages.post.show', compact('post'));
    }
    
    public function edit(Post $post)
    {
        return view('pages.post.edit', compact('post'));
    }
    
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'image' => 'image|nullable'
        ]);

        if($request->hasFile('image')){
            if($post->image){
                Storage::delete($post->image);
            }
            
            $validatedData['image'] = $request->file('image')->store('images');
        }

        $post->update($validatedData);

        return redirect()->back();
    }
    
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::delete($post->image);
        }
        
        $post->delete();
        
        return redirect()->back();
    }
}
