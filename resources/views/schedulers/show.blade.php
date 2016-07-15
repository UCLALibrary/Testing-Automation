@extends('layout')
@section('header')
<div class="page-header">
        <h1>Schedulers / Show #{{$scheduler->id}}</h1>
        <form action="{{ route('schedulers.destroy', $scheduler->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('schedulers.edit', $scheduler->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static"></p>
                </div>
                <div class="form-group">
                     <label for="command">COMMAND</label>
                     <p class="form-control-static">{{$scheduler->command}}</p>
                </div>
                    <div class="form-group">
                     <label for="parameters">PARAMETERS</label>
                     <p class="form-control-static">{{$scheduler->parameters}}</p>
                </div>
                    <div class="form-group">
                     <label for="frequency">FREQUENCY</label>
                     <p class="form-control-static">{{$scheduler->frequency}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('schedulers.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection