@extends('semantic')

@section('header')
<h1>
    <i class="calendar icon"></i> Schedulers
    <a class="ui green button" href="{{ route('schedulers.create') }}"><i class="plus icon"></i> Create</a>
</h1>
@endsection


@section('content')
<div class="ui piled segment">
    <div>
        @if($schedulers->count())
        <table class="ui celled padded table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>COMMAND</th>
                  <th>PARAMETERS</th>
                  <th>FREQUENCY</th>
                  <th>STATUS</th>
                  <th class="text-right">OPTIONS</th>
              </tr>
          </thead>

          <tbody>
            @foreach($schedulers as $scheduler)
            <tr>
                <td>{{$scheduler->id}}</td>
                <td>{{$scheduler->command}}</td>
                <td>{{$scheduler->parameters}}</td>
                <td>{{$scheduler->frequency}}</td>
                <td>
                  @if($scheduler->disabled == 0)
                  <span class="ui green circular label">Active</span>
                  @elseif($scheduler->disabled == 1)
                  <span class="ui red circular label">Disabled</span>
                  @endif
              </td>
              <td class="text-right">
                <a class="ui blue button" href="{{ route('schedulers.show', $scheduler->id) }}"><i class="ui eye icon"></i> View</a>
                <a class="ui yellow button" href="{{ route('schedulers.edit', $scheduler->id) }}"><i class="ui edit icon"></i> Edit</a>
                <form action="{{ route('schedulers.destroy', $scheduler->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="ui red button"><i class="ui trash icon"></i> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $schedulers->render() !!}
@else
<h3 style="color:red;"><p>There are no Scheduler settings configured for this user.</p></span>
    @endif

</div>
</div>

@endsection
