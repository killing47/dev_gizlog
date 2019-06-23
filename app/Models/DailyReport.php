<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time'
    ];

    public function getAll($id)
    {
        return $this->where('user_id', $id)->get();
    }
}
