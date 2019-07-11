<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\User\CommentRequest;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->middleware('auth');
        $this->comment = $comment;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\User\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->comment->fill($input)->save();
        return redirect()->route('question.show', ['id' => $input['question_id']]);
    }
}
