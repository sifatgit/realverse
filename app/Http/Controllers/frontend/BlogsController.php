<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at','asc')->get();

        return view('frontend.pages.blogs',compact('blogs'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        $comments = Comment::where('blog_id',$blog->id)->orderBy('id','desc')->limit(5)->get();

        return view('frontend.pages.single_blog',compact('blog','comments'));
    }

}
