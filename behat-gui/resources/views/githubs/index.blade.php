@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Githubs
            <a class="btn btn-success pull-right" href="{{ route('githubs.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($githubs->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>HEADERS</th>
                        <th>PAYLOAD</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($githubs as $github)
                            <tr>
                                <td>{{$github->id}}</td>
                                <td>{{$github->headers}}</td>
                                <td id="github{{ $github->id  }}" class="github{{ $github->id  }}"></td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('githubs.show', $github->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('githubs.edit', $github->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('githubs.destroy', $github->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $githubs->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
    @foreach($githubs as $github)
        var github{{ $github->id  }} = '{!!  str_replace('\\', '\\\'', str_replace('\/', '/',str_replace('\"', '"', $github->payload)))  !!}';
        $("#github{{ $github->id  }}").jJsonViewer(github{{ $github->id  }});
    @endforeach
    </script>
@endsection