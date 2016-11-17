@extends('semantic')

@section('header')
<h1>
    <i class="wizard icon"></i>Variables
    <a class="ui green button" href="{{ route('variables.create') }}"><i class="plus icon"></i> Create</a>
    <a class="ui blue button" href="{{ route('variables.upload') }}"><i class="upload icon"></i> Upload</a>
</h1>
@endsection

@section('content')
<div class="ui piled segment">
    @if($variables->count())
    <table class="ui celled padded table">
        <thead>
            <tr>
                <th>KEY</th>
                <th>VALUE</th>
                <th>OPTIONS</th>
            </tr>
        </thead>

        <tbody>
            @foreach($variables as $variable)
            <tr>
                <td>{{$variable->key}}</td>
                <td><ul>@foreach(json_decode($variable->value) as $k => $v) <li>@if(json_decode($variable->sets)[$k] == 0) <b>Default:</b> @else  <b>{{ \App\Set::where('id', '=', json_decode($variable->sets)[$k])->first()->name  }}:</b> @endif {{ substr($v, 0, 50)  }}... @if(json_decode($variable->sets)[$k] != 0) - <a href="{{ route('variables.deleteValue', [$variable->id, $k])  }}">Delete</a> @endif</li> @endforeach</ul></td>
                <td class="text-right">
                    <a class="ui blue button" href="{{ route('variables.show', $variable->id) }}"><i class="eye icon"></i> View</a>
                    <a class="ui yellow button" href="{{ route('variables.edit', $variable->id) }}"><i class="edit icon"></i> Edit</a>
                    <form action="{{ route('variables.destroy', $variable->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="ui red button"><i class="trash icon"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $variables->render() !!}
    @else
    <h3 style="color:red;">Empty!</h3>
    @endif
</div>

@endsection