@extends('layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Variables / Upload </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('variables.upload')  }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group @if($errors->has('location')) has-error @endif">
                <label for="location-field">Location</label>
                <input id="location-field" type="file" name="location" class="form-control" />
                @if($errors->has("location"))
                    <span class="help-block">{{ $errors->first("location") }}</span>
                @endif
            </div>
            <div class="form-group @if($errors->has('set')) has-error @endif">
                <label for="key-field">Set</label>
                <select id="default-set" name="set" class="form-control">
                        <option value="0">Default</option>
                    @if(!$sets->isEmpty())
                        @foreach($sets as $set)
                            <option value="{{ $set->id  }}">{{ $set->name  }}</option>
                        @endforeach
                    @endif
                </select>
                @if($errors->has("set"))
                    <span class="help-block">{{ $errors->first("set") }}</span>
                @endif
            </div>
            <div class="well well-sm">
                <button class="btn btn-primary" id="set_create">Create</button>
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
