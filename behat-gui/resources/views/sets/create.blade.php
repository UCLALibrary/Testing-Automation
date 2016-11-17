@extends('semantic')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
<!--
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Sets / Create </h1>
    </div>
@endsection
-->

@section('content')
@include('error')

<h1><i class="plus icon"></i> Sets / Create </h1>

<div class="ui piled segment">
  <div class="ui form">

    <form action="{{ route('sets.store') }}" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="field @if($errors->has('name')) error @endif">
       <label for="name-field">Name</label>
       <input type="text" id="name-field" name="name" class="form-control" value="{{ old("name") }}"/>
       @if($errors->has("name"))
       <span class="help-block">{{ $errors->first("name") }}</span>
       @endif
     </div>
     <div class="field @if($errors->has('description')) error @endif">
       <label for="description-field">Description</label>
       <textarea class="form-control" id="description-field" rows="3" name="description">{{ old("description") }}</textarea>
       @if($errors->has("description"))
       <span class="ui segment">{{ $errors->first("description") }}</span>
       @endif
     </div>
     
     <button type="submit" class="ui green button">Create</button>
     <a class="ui grey button" href="{{ route('sets.index') }}"><i class="reply icon"></i> Back</a>
     
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
