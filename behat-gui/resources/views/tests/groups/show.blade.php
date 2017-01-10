@extends('semantic')

@section('content')
       <div id="body" class="ui one column doubling grid" style="margin-left:10px;margin-right:10px;">
        <div class="column">
                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th width="10%">Status</th>
                            <th width="10%">User</th>
                            <th width="10%">JIRA</th>
                            <th width="40%">Output</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                <tbody>
                    @if(!empty($group->results))
                        @foreach($group->results as $result)
                            @if($result = \App\TestResult::where('id','=', $result)->first())
                            <tr>
                                <td><div class="ui @if($result->success == 0) red @elseif($result->success == 1) green @endif ribbon label">@if($result->success == 0) Failed @elseif($result->success == 1) Passed @endif</div></td>
                                <td><img class="ui avatar image" src="{{ \App\User::where('id','=',$group->user_id)->first()->avatar }}">{{ \App\User::where('id','=',$group->user_id)->first()->name }}</td>
                                <td>@if($result->jira_url != null)<i class="tasks icon"></i><a href="{{ $result->jira_url  }}">Ticket</a>@else None @endif</td>
                                <td>{!! $output[$result->id] !!}</td>
                            </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4">
                        <div class="ui right floated pagination menu">
                            <a class="icon item">
                                <i class="left chevron icon"></i>
                            </a>
                            <a class="item">1</a>
                            <a class="item">2</a>
                            <a class="item">3</a>
                            <a class="item">4</a>
                            <a class="icon item">
                                <i class="right chevron icon"></i>
                            </a>
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.accordion')
                .accordion({
                    selector: {
                        trigger: '.title'
                    }
                })
        ;
    </script>
@endsection