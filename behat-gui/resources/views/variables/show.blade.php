@extends('semantic')
@section('header')
<div class="page-header">
        <h1>Variable #{{$variable->id}}</h1>
        <div class="ui form">
        <form action="{{ route('variables.destroy', $variable->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="ui yellow button" role="group" href="{{ route('variables.edit', $variable->id) }}"><i class="edit icon"></i> Edit</a>
                <button type="submit" class="ui red button">Delete <i class="trash icon"></i></button>
            </div>
        </form>
    </div>
    </div>
@endsection

@section('content')
    <div class="ui piled segment">
        <div class="ui form">

            <form action="#">
                <div class="field">
                     <label for="key">KEY</label>
                     <p class="form-control-static">{{$variable->key}}</p>
                </div>
                    <div class="field">
                     <label for="value">VALUE</label>
                     <p class="form-control-static">
                        <ul>@foreach(json_decode($variable->value) as $k => $v) <li>@if(json_decode($variable->sets)[$k] == 0) <b>Default:</b> @else <b>{{ \App\Set::where('id', '=', json_decode($variable->sets)[$k])->first()->name  }}:</b> @endif{{ wordwrap($v, 50, "\n")  }}</li> @endforeach</ul>
                     </p>
                </div>
            </form>

            <a class="ui grey button" href="{{ route('variables.index') }}"><i class="reply icon"></i>  Back</a>

        </div>
    </div>

@endsection