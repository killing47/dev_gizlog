<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\User\QuestionsRequest;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TagCategory;
use Auth;

class QuestionController extends Controller
{
    protected $question;

    public function __construct(Question $question)
    {
        $this->middleware('auth');
        $this->question = $question;
    }


    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $tagCategory = $request->input('tag_category_id');
        $searchWord  = $request->input('search_word');
        if (isset($tagCategory)  &&  $tagCategory !== '0') {
            $questions = $this->question->searchTagCategory($tagCategory);
        } elseif (isset($searchWord)) {
            $questions = $this->question->searchWord($searchWord);
        } else {
            $questions = $this->question->get();
        }
        return view('user.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  App\Models\TagCategory  $tagCategory
     * @return \Illuminate\Http\Response
     */
    public function create(TagCategory $tagCategory)
    {
        $tagCategorys = $tagCategory->get();
        return view('user.question.create', compact('tagCategorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->question->fill($input)->save();
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->find($id);
        return view('user.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\TagCategory  $tagCategory
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, TagCategory $tagCategory)
    {
        $question = $this->question->find($id);
        $tagCategorys = $tagCategory->get();
        foreach ($tagCategorys as $tagCategory) {
            if ($question->tagCategory->name !== $tagCategory->name) {
                $tagCategorysSelectArray[] =  $tagCategory;
            }
        }
        return view('user.question.edit', compact('question', 'tagCategorysSelectArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->question->find($id)->fill($input)->save();
        return redirect()->route('question.mypage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.mypage');
    }

    public function mypage(Request $request)
    {
        $id = Auth::id();
        $questions = $this->question->getUserQuestion($id);
        return view('user.question.mypage', compact('questions'));
    }

    public function confirm(QuestionsRequest $request)
    {
        return view('user.question.confirm', compact('request'));
    }
}
