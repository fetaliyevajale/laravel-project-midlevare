<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog; 
class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all(); 
        return view('blogs.index', compact('blogs')); 
    }

    public function create()
    {
        return view('blogs.create'); 
    }

    public function store(Request $request)
    {
        // Validasiya
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

 
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

     
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName, 
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog yazısı uğurla yaradıldı.');
    }

    
    public function edit($id)
    {
        $blog = Blog::findOrFail($id); 
        return view('blogs.edit', compact('blog')); 
    }

   
    public function update(Request $request, $id)
    {
      
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $blog = Blog::findOrFail($id);

        
        if ($request->hasFile('image')) {
           
            if ($blog->image) {
                unlink(public_path('images/' . $blog->image));
            }
           
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $blog->image = $imageName;
        }

        
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save(); 

        return redirect()->route('blogs.index')->with('success', 'Blog yazısı uğurla güncəlləndi.');
    }

   
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id); 
      
        if ($blog->image) {
            unlink(public_path('images/' . $blog->image));
        }
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog yazısı uğurla silindi.');
    }
}
