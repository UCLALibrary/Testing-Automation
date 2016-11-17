@extends('semantic')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('header')
<h1><i class="plus icon"></i> Schedulers / Create </h1>
@endsection


@section('content')
@include('error')
<div class="ui piled segment">
    <div class="ui form">

        <form action="{{ route('schedulers.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="field @if($errors->has('command')) error @endif">
             <label for="command-field">Command</label>
             <select name="command" class="form-control">
                 <option value="behat:execute">Execute Tests</option>
                 <option value="behat:pull">Pull Tests</option>
             </select>
             @if($errors->has("command"))
             <span class="help-block">{{ $errors->first("command") }}</span>
             @endif
         </div>
         <div class="row">
            <div class="col-md-6">
                <div class="field @if($errors->has('parameters')) error @endif">
                    <label for="parameters-field">Test ID</label>
                    <select name="test_id" class="form-control">
                        <option value="none">None</option>
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
                <div class="field @if($errors->has('set_id')) error @endif">
                    <label for="parameters-field">Set ID</label>
                    <select name="set_id" class="form-control">
                        <option value="0">Default</option>
                        <option value="none">None</option>
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

        <div class="field @if($errors->has('frequency')) error @endif">
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
    <div class="field @if($errors->has('disabled')) error @endif">
        <div class="ui checkbox">
         <label for="disabled-field">Disabled</label>
         <input type="hidden" name="disabled" value="0" />
         <input type="checkbox" id="disabled-field" name="disabled" class="form-control" value="{{ old("disabled") }}"/>
         @if($errors->has("disabled"))
         <span class="help-block">{{ $errors->first("disabled") }}</span>
         @endif
     </div>
 </div>

 <button type="submit" class="ui green button">Create</button>
 <a class="ui grey button" href="{{ route('schedulers.index') }}"><i class="reply icon"></i> Back</a>

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
