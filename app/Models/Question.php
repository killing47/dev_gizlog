<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function tagCategory()
    {
        return $this->belongsTo('App\Models\TagCategory');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getQuestionByUserId($id)
    {
        return $this->userId($id)->orderBy('created_at', 'desc')
            ->with('user', 'tagCategory', 'comments')->get();
    }

    public function searchCategoryWord($tagCategoryId, $searchWord)
    {
        return $this->category($tagCategoryId)->searchWord($searchWord)
            ->orderBy('created_at', 'desc')->with('user', 'tagCategory', 'comments')
            ->get();
    }

    public function getAllQuestions()
    {
        return $this->with('user', 'tagCategory', 'comments')->get();
    }

    public function scopeUserId($query, $id)
    {
        return $query->where('user_id', $id);
    }

    public function scopeCategory($query, $tagCategoryId)
    {
        if (!empty($tagCategoryId)) {
            return $query->where('tag_category_id', $tagCategoryId);
        }
    }

    public function scopeSearchWord($query, $searchWord)
    {
        if (!empty($searchWord)) {
            return $query->where('title', 'like', '%'.$searchWord.'%');
        }
    }
}
