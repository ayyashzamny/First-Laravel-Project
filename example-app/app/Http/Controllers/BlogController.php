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
            'title' => 'required',
            'content' => 'required'
        ]);

        $newBlog = blogs::create($data);

        return redirect(route('blog.index'));

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

        return redirect(route('blog.index'))->with('message', 'Blog Updated Successfully');
    }


    public function destroy(blogs $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index')->with('message', 'Blog deleted successfully.');
    }
}
