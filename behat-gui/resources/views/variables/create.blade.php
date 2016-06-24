@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Variables / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('variables.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('key')) has-error @endif">
                       <label for="key-field">Key</label>
                    <input type="text" id="key-field" name="key" class="form-control" value="{{ old("key") }}"/>
                       @if($errors->has("key"))
                        <span class="help-block">{{ $errors->first("key") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('value')) has-error @endif">
                       <label for="value-field">Value</label>
                    <input type="text" id="value-field" name="value" class="form-control" value="{{ old("value") }}"/>
                       @if($errors->has("value"))
                        <span class="help-block">{{ $errors->first("value") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('variables.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
