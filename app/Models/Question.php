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

    public function comment()
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

    public function getUserInformation($id)
    {
        return $this->where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }

    public function tagCategorySearch($tagCategory, $id)
    {
        return $this->where('tag_category_id', $tagCategory)
                    ->where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }

    public function wordSearch($searchWord, $id)
    {
        return $this->where('title', 'like', '%'.$searchWord.'%')
                    ->where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }
}
