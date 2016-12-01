@extends('semantic')
@section('header')

        <h1>Schedulers / Show #{{$scheduler->id}}</h1>
    <div class="ui form">
        <form action="{{ route('schedulers.destroy', $scheduler->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
                <a class="ui yellow button" role="group" href="{{ route('schedulers.edit', $scheduler->id) }}"><i class="ui edit icon"></i> Edit</a>
                <button type="submit" class="ui red button">Delete <i class="ui trash icon"></i></button>
            
        </form>
    </div>

@endsection

@section('content')
    <div class="ui piled segment">
        <div class="ui form">

            <form action="#">
                <div class="field">
                    <label for="nome">ID</label>
                    <p class="form-control-static"></p>
                </div>
                <div class="field">
                     <label for="command">COMMAND</label>
                     <p class="form-control-static">{{$scheduler->command}}</p>
                </div>
                    <div class="field">
                     <label for="parameters">PARAMETERS</label>
                     <p class="form-control-static">{{$scheduler->parameters}}</p>
                </div>
                    <div class="field">
                     <label for="frequency">FREQUENCY</label>
                     <p class="form-control-static">{{$scheduler->frequency}}</p>
                     <p>
                </div>
            </form>

            <a class="ui grey button" href="{{ route('schedulers.index') }}"><i class="ui reply icon"></i>  Back</a>

        </div>
    </div>

@endsection