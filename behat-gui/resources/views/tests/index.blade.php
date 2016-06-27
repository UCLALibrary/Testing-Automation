@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Tests
            <a class="btn btn-success pull-right" href="{{ route('tests.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($tests->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>FILE</th>
                            <th>LAST STATUS</th>
                            <th>TAGS</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tests as $test)
                            <tr>
                                <td>{{$test->name}}</td>
                                <td class="code gherkin">{!! str_replace("\n", "<br />", str_replace(" ", "&nbsp;", file_get_contents($test->location)))   !!}</td>
                                <td>@if(isset($status[$test->id])) @if($status[$test->id] == 0) <span class="label label-danger">Failed</span> @elseif($status[$test->id] == 1) <span class="label label-success">Success</span> @endif @else <span class="label label-primary">Not yet run</span> @endif</td>
                                <td>@if(isset($tags[$test->id])) <ul> @foreach($tags[$test->id] as $t) <li>{{ $t  }}</li>  @endforeach </ul> @endif</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-success" href="{{ route('tests.execute', $test->id) }}"> Execute</a>
                                    <a class="btn btn-xs btn-primary" href="{{ route('tests.show', $test->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('tests.edit', $test->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('tests.destroy', $test->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $tests->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection