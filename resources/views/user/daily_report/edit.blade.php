@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['daily_report.update', $dailyReport->id], 'method' => 'PUT']) !!}
      <div class="form-group form-size-small">
        {!! Form::input('date', 'reporting_time', $dailyReport->reporting_time->format('Y-m-d'), ['readonly', 'class' => 'form-control']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::input('text', 'title', $dailyReport->title, ['autofocus', 'class' => 'form-control']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
        {!! Form::textarea('content', $dailyReport->content, ['class' => 'form-control', 'placeholder' => 'Content', 'cols' => '50', 'rows' => '10']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
    {!! Form::submit('update', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

