@extends('semantic')
@section('header')
<div class="page-header">
        <h1>Variables / Show #{{$variable->id}}</h1>
        <form action="{{ route('variables.destroy', $variable->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('variables.edit', $variable->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                     <label for="key">KEY</label>
                     <p class="form-control-static">{{$variable->key}}</p>
                </div>
                    <div class="form-group">
                     <label for="value">VALUE</label>
                     <p class="form-control-static">
                        <ul>@foreach(json_decode($variable->value) as $k => $v) <li>@if(json_decode($variable->sets)[$k] == 0) <b>Default:</b> @else <b>{{ \App\Set::where('id', '=', json_decode($variable->sets)[$k])->first()->name  }}:</b> @endif{{ wordwrap($v, 50, "\n")  }}</li> @endforeach</ul>
                     </p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('variables.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection