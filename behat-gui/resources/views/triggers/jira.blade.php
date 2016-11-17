@extends('semantic')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('header')
<h1><i class="edit icon"></i> Edit Jira Configs</h1>

@endsection


@section('content')
@include('error')
<div class="ui piled segment">
    <div class="ui form">
        <h4>Current Settings</h4>
        @if($project != null && $assign != null && $label != null)
        <p>When a test is run create a jira ticket in the project: <b>{{ $project->value  }}</b>, assign it to <b>{{ $assign->value  }}</b> and then apply the labels: <b>@if(json_decode($label->value, true)) @foreach(json_decode($label->value, true) as $label) {{ $label  }}  @endforeach @endif</b></p>
        @else
        <span style="color:red;"><p>There are no JIRA settings configured for this user.</p></span>
        @endif
        <hr />
        <form action="{{ route('triggers.jira_save')  }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="field">
                <div class="field">
                    <label for="assign">Jira User to Assign To.</label>
                    <input type="text" name="assign" class="form-control" />
                </div>
                <div class="field">
                    <label for="labels">Jira Labels</label>
                    <textarea name="labels" class="form-control"></textarea>
                </div>
                <div class="field">
                    <label for="assign">Jira Project</label>
                    <input type="text" name="project" class="form-control" />
                </div>
            </div>


            <button type="submit" class="ui green button">Save</button>
            <a class="ui grey button" href="{{ route('roles.index') }}"><i class="reply icon"></i>  Back</a>

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
