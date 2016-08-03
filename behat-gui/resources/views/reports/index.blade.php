@extends('layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-align-justify"></i> Reports</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            @foreach($results as $r)
                <div class="row">
                    <div class="col-sm-8">{!! str_replace("class=\"list-group\"","class=\"list-group\" style=\"overflow-y:scroll;\"", str_replace('data-toggle="collapse" data-parent="#accordion" href="#scenario-1-1" aria-expanded="true" aria-controls="scenario-1-1"', "", str_replace("col-sm-8", "col-sm-12", $r->result))) !!}</div>
                    <div class="col-sm-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Test</div>
                            <div class="panel-body">
                                @if($test = \App\Test::where('id', '=', $r->test_id)->withTrashed()->first())
                                    Name: <a href="{{ route('tests.show', $test->id)  }}">{{ $test->name  }}</a><br />
                                    <b>Result Info:</b><br />
                                    Created: {{ $r->created_at  }}<br />
                                    Updated: {{ $r->updated_at  }}
                                    @if($r->jira_key)
                                        <br />JIRA: <a target="_blank" href="{{ config('jira.ticket')  }}{{ $r->jira_key  }}">Ticket</a>
                                    @endif
                                @endif
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
                    </div>
                </div>
                <hr />
            @endforeach

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
