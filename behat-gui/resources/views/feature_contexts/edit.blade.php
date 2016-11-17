@extends('semantic')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
<h1><i class="edit icon"></i> Edit Feature Contexts</h1>
@endsection

@section('content')
@include('error')
<div class="ui piled segment">
    <div class="ui form">
        <form action="{{ route('feature_contexts.update', 1)  }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="field">
                <textarea name="feature_context" class="form-control">{{ $feature_context  }}</textarea>
            </div>

            <div class="well well-sm">
                <button type="submit" class="ui green button">Save</button>
                <a class="ui grey button" href="{{ route('feature_contexts.index') }}"><i class="reply icon"></i>  Back</a>
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
