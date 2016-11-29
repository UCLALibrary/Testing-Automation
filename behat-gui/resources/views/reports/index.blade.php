@extends('semantic')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
<h1><i class="line chart icon"></i> Reports</h1>
@endsection


@section('content')
@include('error')
<div class="ui one column double stackable grid container">
    @foreach($results as $r)
    <div class="column">
        <div class="ui two column double stackable grid container">
            <div class="column">
                <div class="ui piled segment">
                    {!! str_replace("class=\"list-group\"","class=\"list-group\" style=\"overflow-y:scroll;\"", str_replace('data-toggle="collapse" data-parent="#accordion" href="#scenario-1-1" aria-expanded="true" aria-controls="scenario-1-1"', "", str_replace("col-sm-8", "col-sm-12", $r->result))) !!}
                </div>
            </div>
            <div class="column">
                <div class="ui two row double stackable grid container">
                    <div class="row">
                        <div class="ui card">
                            <div class="content">
                                <div class="heading">Test</div>
                            </div>
                            <div class="content">
                                @if($test = \App\Test::where('id', '=', $r->test_id)->withTrashed()->first())
                                Name: <a href="{{ route('tests.show', $test->id)  }}">{{ $test->name  }}</a><br />
                                <b>Result Info:</b><br />
                                @if($r->user_id != 0)
                                User: <a href="mailto:{{  \App\User::where('id', '=', $r->user_id)->first()->email }}">{{  \App\User::where('id', '=', $r->user_id)->first()->email }}</a><br />
                                @elseif($r->user_id == 0)
                                User: System<br />
                                @endif
                                Created: {{ $r->created_at  }}<br />
                                Updated: {{ $r->updated_at  }}
                                @if($r->jira_key)
                                <br />JIRA: <a target="_blank" href="{{ config('jira.ticket')  }}{{ $r->jira_key  }}">Ticket</a>
                                @endif
                                @endif
                            </div>
                        </div>
                        <!--div class="ui card">
                            <div class="content">
                                <div class="heading">Behat Color Key</div>
                            </div>
                            <div class="content">
                                <span class="label label-success">Green</span>: Successfully executed.<br />
                                <span class="label label-primary">Blue</span>: Skipped over.<br />
                                <span class="label label-warning">Yellow</span>: Skipped over due to syntax error.<br />
                                <span class="label label-danger">Red</span> Executed, returned with error.<br />
                            </div>
                        </div-->
                    </div>
                    @if($r->comment_complete == 1)
                    @if($r->comment != null)
                    <div class="row">
                        <div class="ui card">
                            <div class="content">
                                <div class="heading">Analysis of Message</div>
                            </div>
                            <div class="content">
                                <small>This area will give you some check points for failure.
                                    They will not include any issues that might be on the website you are testing.
                                </small><br /><br />
                                <ul>
                                    @foreach(explode("\n", $r->comment) as $e)<li>{!!  $e  !!}</li>@endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
        <hr />
    </div>
    @endforeach    
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script>
$('.date-picker').datepicker({
});
</script>
@endsection
