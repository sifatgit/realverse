<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $limit = 5;
            $last_comment_id = $request->last_comment_id ?? null;

            $query = Comment::where('blog_id', $request->blog_id);

            if ($last_comment_id) {
                // Load older comments than the last loaded comment
                $query->where('id', '<', $last_comment_id);
            }

            $comments = $query->orderByDesc('id')->limit($limit)->get();

            $comments_html = view('frontend.renders.comments', compact('comments'))->render();

            return response()->json([
                'comments_html' => $comments_html,
                'last_comment_id' => $comments->count() ? $comments->last()->id : null
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try{

            $request->validate([

                'user_id' => 'nullable|integer',
                'blog_id' => 'required|integer',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'comment' => 'required',

            ]);
        }

        catch (ValidationException $e) {

            if($request->ajax()){

                return response()->json(['errors' => $e->errors()], 422);
            }
            
        }

        if($request->ajax()){

           $comment = Comment::create($request->all());
           $comment_html = view('frontend.renders.comment',compact('comment'))->render();

           $comments_counter = Comment::where('blog_id',$request->blog_id)->count();

            return response()->json(['comment_html' => $comment_html,'comments_counter' => $comments_counter]);
        }

        Comment::create($request->all());

        return back();
    }
}
