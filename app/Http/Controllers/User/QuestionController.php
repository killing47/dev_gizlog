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
    protected $tagCategory;

    public function __construct(Question $question, TagCategory $tagCategory)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->tagCategory = $tagCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tagCategoryId = $request->input('tag_category_id');
        $searchWord = $request->input('search_word');
        $tagCategories = $this->tagCategory->getTagCategories();
        if (isset($tagCategoryId) || isset($searchWord)) {
            $questions = $this->question->searchCategoryWord($tagCategoryId, $searchWord);
        } else {
            $questions = $this->question->with('user', 'tagCategory', 'comments')->get();
        }
        return view('user.question.index', compact('questions', 'tagCategories', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  App\Models\TagCategory  $tagCategory
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tagCategories = $this->tagCategory->getTagCategories();
        $tagCategoriesByNameId = $tagCategories->pluck('name', 'id')->prepend('Select category', '');
        return view('user.question.create', compact('tagCategoriesByNameId'));
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
    public function edit($id)
    {
        $question = $this->question->find($id);
        $tagCategories = $this->tagCategory->getTagCategories();
        $tagCategoriesByNameId = $tagCategories->pluck('name', 'id')->prepend('Select category', '');
        return view('user.question.edit', compact('question', 'tagCategoriesByNameId'));
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
        return redirect()->route('question.showMypage');
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
        return redirect()->route('question.showMypage');
    }

    public function showMypage(Request $request)
    {
        $questions = $this->question->getQuestionByUserId(Auth::id());
        return view('user.question.mypage', compact('questions'));
    }

    public function confirm(QuestionsRequest $request)
    {
        $input = $request->all();
        $tagCategory = $this->tagCategory->find($input['tag_category_id']);
        return view('user.question.confirm', compact('request', 'tagCategory'));
    }
}
