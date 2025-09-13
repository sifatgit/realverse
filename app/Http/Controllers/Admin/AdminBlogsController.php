<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;

class AdminBlogsController extends Controller
{
    public function index(){

        $blogs = Blog::all();

        return view('backend.admin.pages.blogs.index',compact('blogs'));
    }

    public function store(Request $request){

        try{

            $request->validate([
                
                'topic' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg',
                'details' => 'required|string',
                'author' => 'required|string',
            ]);

        }

        catch (ValidationException $e){

            if($request->ajax()){

                return response()->json([
                    'errors' => $e-errors()
                ], 422);
            }
        }

        if($request->ajax()){

            return response()->json(['success' => true]);
        }

        $blog = new Blog;

        $blog->topic = $request->topic;
        $blog->title = $request->title;

        $image = $request->file('image');

        if($image){
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/admin/images/blogs/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $blog->image = $image_url;            
        }

        $blog->details = $request->details;
        $blog->author = $request->author;

        $blog->save();


        return back()->with('success','Blog created successfully!');
    }

    public function comments($id){

        $comments = Comment::where('blog_id',$id)->orderByDesc('id')->paginate(5);

        return view('backend.admin.pages.blogs.comments',compact('comments'));
    }

    public function comment_delete($id){

        $comment = Comment::findOrFail($id);

        $comment->delete();

        return back()->with('success','Comment deleted successfully!');
    }

    public function delete($id){
        $blog = Blog::findOrFail($id);

        $blog->delete();

        return back()->with('success','Blog deleted successfully!');
    }
    public function deleteall(){
        
        $blog = Blog::all();

        $blog->each->delete();

        return back()->with('success','Entire Blog table cleared successfully!');
    }
}
