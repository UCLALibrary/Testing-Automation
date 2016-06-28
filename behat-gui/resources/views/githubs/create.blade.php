@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Githubs / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('githubs.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('headers')) has-error @endif">
                       <label for="headers-field">Headers</label>
                    <textarea class="form-control" id="headers-field" rows="3" name="headers">{{ old("headers") }}</textarea>
                       @if($errors->has("headers"))
                        <span class="help-block">{{ $errors->first("headers") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('payload')) has-error @endif">
                       <label for="payload-field">Payload</label>
                    <textarea class="form-control" id="payload-field" rows="3" name="payload">{{ old("payload") }}</textarea>
                       @if($errors->has("payload"))
                        <span class="help-block">{{ $errors->first("payload") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('githubs.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
