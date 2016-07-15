@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Variables
            <a class="btn btn-success pull-right" href="{{ route('variables.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($variables->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>KEY</th>
                            <th>VALUE</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($variables as $variable)
                            <tr>
                                <td>{{$variable->key}}</td>
                                <td><ul>@foreach(json_decode($variable->value) as $k => $v) <li>@if(json_decode($variable->sets)[$k] == 0) <b>Default:</b> @else  <b>{{ \App\Set::where('id', '=', json_decode($variable->sets)[$k])->first()->name  }}:</b> @endif {{ substr($v, 0, 50)  }}... @if(json_decode($variable->sets)[$k] != 0) - <a href="{{ route('variables.deleteValue', [$variable->id, $k])  }}">Delete</a> @endif</li> @endforeach</ul></td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('variables.show', $variable->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('variables.edit', $variable->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('variables.destroy', $variable->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $variables->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection