<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blogs;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = blogs::all();
        return view('blogs.index', ['blogs' => $blogs]);


    }

    public function post()
    {
        return view('blogs.post');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newBlog = blogs::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Blog post created successfully!'
        ]);
    }

    public function edit(blogs $blog)
    {
        return view('blogs.edit_blog', ['blog' => $blog]);
    }

    public function update(Request $request, blogs $blog)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $blog->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully!'
        ]);
    }


    public function destroy(blogs $blog)
    {
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully.'
        ]);
    }


    public function showTable()
    {
        $blogs = blogs::all();
        return view('blogs.table', ['blogs' => $blogs]);
    }
}
