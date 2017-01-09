@extends('semantic')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
<h1><i class="icon edit"></i> Tests / Edit #{{$test->id}}</h1>
@endsection

@section('content')
    @include('error')

    <div class="ui piled segment">
        <div class="ui form">

            <form action="{{ route('tests.update', $test->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="field @if($errors->has('name')) error @endif">
                       <label for="name-field">Name</label>
                        <input type="text" id="name-field" name="name" class="form-control" value="{{ $test->name }}"/>
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                </div>

                <div class="field @if($errors->has('location')) error @endif">
                    <label for="name-field">File</label>
                    <textarea id="name-field" name="location" class="form-control">{!! str_replace(" ", "&nbsp;", file_get_contents($test->location))   !!}</textarea>
                    @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("location") }}</span>
                    @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="ui green button">Save</button>
                    <a class="ui grey button" href="{{ route('tests.index') }}"><i class="reply icon"></i>  Back</a>
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
