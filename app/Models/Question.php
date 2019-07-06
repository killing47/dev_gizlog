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

    public function getUserQuestion($id)
    {
        return $this->where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }

    public function searchTagCategory($tagCategoryId)
    {
        return $this->where('tag_category_id', $tagCategoryId)
                    ->orderBy('created_at', 'desc')->get();
    }

    public function searchWord($searchWord)
    {
        return $this->where('title', 'like', '%'.$searchWord.'%')
                    ->orderBy('created_at', 'desc')->get();
    }

    public function searchCategoryWord($tagCategoryId, $searchWord)
    {
        return $this->where('tag_category_id', $tagCategoryId)
                    ->where('title', 'like', '%'.$searchWord.'%')
                    ->orderby('created_at', 'desc')->get();
    }
}
