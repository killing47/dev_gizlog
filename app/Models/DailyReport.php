<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $dates = ['reporting_time','deleted_at'];

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time'
    ];

    public function getUserInformation($id)
    {
        return $this->where('user_id', $id)->orderBy('reporting_time', 'desc')->get();
    }

    public function dailyReportSearch($search, $id)
    {
        return $this->where('reporting_time', 'like', '%'.$search.'%')->where('user_id', $id)->orderBy('reporting_time', 'desc')->get();
    }
}
