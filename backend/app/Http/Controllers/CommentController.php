<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        //
        $comment = auth()->user()->comments()->create($request->all());
        $comment->users = auth()->user();
        return response(["message" => "Comment Success", "comment" =>$comment], Response::HTTP_CREATED);
    }

    public function index() {
        return response(auth()->user()->comments, Response::HTTP_OK);
    }

    public function update(CommentRequest $req, Comment $comment) {
        $comment->update($req->all());
        return response("Update Success", Response::HTTP_OK);
    }

    public function destroy(Comment $comment) {
        $comment->delete();
        return response("Delete Success", Response::HTTP_OK);
    }

    public function show(Comment $comment) {
        return response($comment, Response::HTTP_OK);
    }
}
