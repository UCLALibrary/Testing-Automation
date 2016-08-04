@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Schedulers / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('schedulers.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('command')) has-error @endif">
                       <label for="command-field">Command</label>
                       <select name="command" class="form-control">
                           <option value="behat:execute">Execute</option>
                       </select>
                       @if($errors->has("command"))
                        <span class="help-block">{{ $errors->first("command") }}</span>
                       @endif
                    </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if($errors->has('parameters')) has-error @endif">
                            <label for="parameters-field">Test ID</label>
                            <select name="test_id" class="form-control">
                                @if(!$tests->isEmpty())
                                    @foreach($tests as $test)
                                        <option value="{{ $test->id  }}">{{ $test->name  }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has("test_id"))
                                <span class="help-block">{{ $errors->first("test_id") }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group @if($errors->has('set_id')) has-error @endif">
                            <label for="parameters-field">Set ID</label>
                            <select name="set_id" class="form-control">
                                <option value="0">Default</option>
                                @if(!$sets->isEmpty())
                                    @foreach($sets as $s)
                                        <option value="{{ $s->id  }}">{{ $s->name  }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has("set_id"))
                                <span class="help-block">{{ $errors->first("set_id") }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                    <div class="form-group @if($errors->has('frequency')) has-error @endif">
                       <label for="frequency-field">Frequency</label>
                        <select name="frequency" class="form-control">
                            <option value="everyMinute">Every Minute</option>
                            <option value="everyFiveMinutes">Every Five Minutes</option>
                            <option value="everyTenMinutes">Every Ten Minutes</option>
                            <option value="everyThirtyMinutes">Every Thirty Minutes</option>
                            <option value="hourly">Hourly</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="yearly">Yearly</option>
                            <option value="weekdays">Weekdays</option>
                            <option value="sundays">Sundays</option>
                            <option value="mondays">Mondays</option>
                            <option value="tuesdays">Tuesdays</option>
                            <option value="wednesdays">Wednesdays</option>
                            <option value="thursdays">Thursdays</option>
                            <option value="fridays">Fridays</option>
                            <option value="saturdays">Saturdays</option>
                        </select>
                       @if($errors->has("frequency"))
                        <span class="help-block">{{ $errors->first("frequency") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('disabled')) has-error @endif">
                       <label for="disabled-field">Disabled</label>
                       <input type="hidden" name="disabled" value="0" />
                       <input type="checkbox" id="disabled-field" name="disabled" class="form-control" value="{{ old("disabled") }}"/>
                       @if($errors->has("disabled"))
                        <span class="help-block">{{ $errors->first("disabled") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('schedulers.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
@endsection
