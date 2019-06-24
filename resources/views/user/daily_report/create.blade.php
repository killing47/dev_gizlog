@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作戝</h2>
<div class="main-wrap">
  <div class="container">
		{!! Form::open(['route' => 'daily_report.store']) !!}
  　　<div class="form-group form-size-small?">
        {!! Form::input('text', 'reporting_time', date('Y/m/d'), ['readonly', 'class' => 'form-control']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group?{{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::input('text', 'title', old('title'), ['autofocus', 'class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class=" help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => 'Content', 'cols' => '50', 'rows' => '10']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::submit('Add', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

