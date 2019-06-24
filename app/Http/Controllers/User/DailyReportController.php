<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Http\Request;
use Carbon;
use Auth;

class DailyReportController extends Controller
{
    public $daily_report;

    public function __construct(DailyReport $daily_report)
    {
        $this->middleware('auth');
        $this->daily_report = $daily_report;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daily_reports = $this->daily_report->getAll(Auth::id());
        return view('user.daily_report.index', compact('daily_reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.daily_report.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DailyReportRequest $request)
    {
        $input = $request->all();
        $input['reporting_time'] = Carbon::parse($input['reporting_time']);
        $input['user_id'] = Auth::id();
        $this->daily_report->fill($input)->save();
        return redirect()->to('daily_report');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daily_report = $this->daily_report->find($id);
        return view('user.daily_report.show', compact('daily_report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $daily_report = $this->daily_report->find($id);
        return view('user.daily_report.edit', compact('daily_report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DailyReportRequest $request, $id)
    {
        $input = $request->all();
        $input['reporting_time'] = Carbon::parse($input['reporting_time']);
        $this->daily_report->find($id)->fill($input)->save();
        return redirect()->to('daily_report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->daily_report->find($id)->delete();
        return redirect()->to('daily_report');
    }

    public function search(Request $request)
    {
        $search = $request->input('search-month');
        $daily_reports = $this->daily_report->where('reporting_time', 'like', '%'.$search.'%')->get();
        return view('user.daily_report.index', compact('daily_reports'));
    }
}
