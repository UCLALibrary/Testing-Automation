@extends('layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Edit Jira Configs</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Current Settings</h4>
            @if($project != null && $assign != null && $label != null)
            <p>When a test is run create a jira ticket in the project: <b>{{ $project->value  }}</b>, assign it to <b>{{ $assign->value  }}</b> and then apply the labels: <b>@if(json_decode($label->value, true)) @foreach(json_decode($label->value, true) as $label) {{ $label  }}  @endforeach @endif</b></p>
            @endif
            <hr />
            <form action="{{ route('triggers.jira_save')  }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <div class="form-group">
                        <label for="assign">Jira User to Assign To.</label>
                        <input type="text" name="assign" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="labels">Jira Labels</label>
                        <textarea name="labels" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="assign">Jira Project</label>
                        <input type="text" name="project" class="form-control" />
                    </div>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('roles.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
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
