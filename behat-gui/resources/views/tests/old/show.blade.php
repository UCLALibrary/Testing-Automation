@extends('layout')
@section('header')
<div class="page-header">
        <h1>Tests / Show #{{$test->id}}</h1>
        <form action="{{ route('tests.destroy', $test->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('tests.edit', $test->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$test->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="location">FILE</label><br />
                     <a href="#" id="code_{{ $test->id  }}" class="btn btn-xs btn-default">Show/Hide Test Code</a><br /><br />
                     <p class="form-control-static code gherkin hidden" id="toggle_{{ $test->id  }}">{!! str_replace("\n", "<br />", str_replace(" ", "&nbsp;", file_get_contents($test->location)))   !!}</p>
                </div>
            </form>

        </div>
    </div>
    <div class="row">
        <label>Results in execution order</label>
        @foreach($results as $r)
            <div class="row">
                @if($pattern = "/<div class=\"tags pull-right\">([a-zA-Z\"\/\<\> \n=]+)<\/div>/")
                <div class="col-sm-8">{!! preg_replace($pattern, "", str_replace("class=\"list-group\"","class=\"list-group\" style=\"overflow-y:scroll;\"", str_replace('data-toggle="collapse" data-parent="#accordion" href="#scenario-1-1" aria-expanded="true" aria-controls="scenario-1-1"', "", str_replace("col-sm-8", "col-sm-12", $r->result)))) !!}</div>
                @endif
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Behat Color Key</div>
                        <div class="panel-body">
                            <span class="label label-success">Green</span>: Successfully executed.<br />
                            <span class="label label-primary">Blue</span>: Skipped over.<br />
                            <span class="label label-warning">Yellow</span>: Skipped over due to syntax error.<br />
                            <span class="label label-danger">Red</span> Executed, returned with error.<br />
                        </div>
                    </div>
                    @if($r->comment_complete == 1)
                        @if($r->comment != null)
                    <div class="panel panel-default">
                        <div class="panel-heading">Analysis of Message</div>
                        <div class="panel-body">
                            <small>This area will give you some check points for failure.
                                They will not include any issues that might be on the website you are testing.</small><br /><br />
                            <ul>
                            @foreach(explode("\n", $r->comment) as $e)<li>{!!  $e  !!}</li>@endforeach
                            </ul>
                        </div>
                    </div>
                        @endif
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">More Info</div>
                        <div class="panel-body">
                            @if($r->user_id != 0)
                                User: <a href="mailto:{{  \App\User::where('id', '=', $r->user_id)->first()->email }}">{{  \App\User::where('id', '=', $r->user_id)->first()->email }}</a><br />
                            @elseif($r->user_id == 0)
                                User: System<br />
                            @endif
                            Created: {{ $r->created_at  }}<br />
                            Updated: {{ $r->updated_at  }}
                        </div>
                    </div>
                </div>
            </div>
            <hr />
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">

            <a class="btn btn-link" href="{{ route('tests.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
    $("#code_{{ $test->id  }}").on('click', function(){
        $("#toggle_{{ $test->id  }}").toggleClass('hidden');
    });
    </script>
@endsection