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
                    <input type="text" id="command-field" name="command" class="form-control" value="{{ old("command") }}"/>
                       @if($errors->has("command"))
                        <span class="help-block">{{ $errors->first("command") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('parameters')) has-error @endif">
                       <label for="parameters-field">Parameters</label>
                    <input type="text" id="parameters-field" name="parameters" class="form-control" value="{{ old("parameters") }}"/>
                       @if($errors->has("parameters"))
                        <span class="help-block">{{ $errors->first("parameters") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('frequency')) has-error @endif">
                       <label for="frequency-field">Frequency</label>
                    <input type="text" id="frequency-field" name="frequency" class="form-control" value="{{ old("frequency") }}"/>
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
