@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Schedulers / Edit #{{$scheduler->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('schedulers.update', $scheduler->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('command')) has-error @endif">
                    <label for="command-field">Command</label>
                    <select name="command" class="form-control">
                        <option value="behat:execute" @if($scheduler->command == "behat:execute") selected="selected" @endif>Execute</option>
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
                                        <option value="{{ $test->id  }}" @if(explode(" ", $scheduler->parameter)[0] == $test->id) selected="selected" @endif>{{ $test->name  }}</option>
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
                                        <option value="{{ $s->id  }}" @if(explode(" ", $scheduler->parameter)[1] == $s->id) selected="selected" @endif>{{ $s->name  }}</option>
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
                        <option value="everyMinute" @if($scheduler->frequency == "everyMinute") selected="selected" @endif>Every Minute</option>
                        <option value="everyFiveMinutes" @if($scheduler->frequency == "everyFiveMinutes") selected="selected" @endif>Every Five Minutes</option>
                        <option value="everyTenMinutes" @if($scheduler->frequency == "everyTenMinutes") selected="selected" @endif>Every Ten Minutes</option>
                        <option value="everyThirtyMinutes" @if($scheduler->frequency == "everyThirtyMinutes") selected="selected" @endif>Every Thirty Minutes</option>
                        <option value="hourly" @if($scheduler->frequency == "hourly") selected="selected" @endif>Hourly</option>
                        <option value="daily" @if($scheduler->frequency == "daily") selected="selected" @endif>Daily</option>
                        <option value="weekly" @if($scheduler->frequency == "weekly") selected="selected" @endif>Weekly</option>
                        <option value="monthly" @if($scheduler->frequency == "monthly") selected="selected" @endif>Monthly</option>
                        <option value="quarterly" @if($scheduler->frequency == "quarterly") selected="selected" @endif>Quarterly</option>
                        <option value="yearly" @if($scheduler->frequency == "yearly") selected="selected" @endif>Yearly</option>
                        <option value="weekdays" @if($scheduler->frequency == "weekdays") selected="selected" @endif>Weekdays</option>
                        <option value="sundays" @if($scheduler->frequency == "sundays") selected="selected" @endif>Sundays</option>
                        <option value="mondays" @if($scheduler->frequency == "mondays") selected="selected" @endif>Mondays</option>
                        <option value="tuesdays" @if($scheduler->frequency == "tuesdays") selected="selected" @endif>Tuesdays</option>
                        <option value="wednesdays" @if($scheduler->frequency == "wednesdays") selected="selected" @endif>Wednesdays</option>
                        <option value="thursdays" @if($scheduler->frequency == "thursdays") selected="selected" @endif>Thursdays</option>
                        <option value="fridays" @if($scheduler->frequency == "fridays") selected="selected" @endif>Fridays</option>
                        <option value="saturdays" @if($scheduler->frequency == "saturdays") selected="selected" @endif>Saturdays</option>
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
