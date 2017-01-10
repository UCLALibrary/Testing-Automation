@extends('semantic')


@section('header')
<h1>
 <i class="block layout icon"></i>Sets
 <a class="ui green button" href="{{ route('sets.create') }}"><i class="plus icon"></i> Create</a>
</h1>
@endsection

@section('content')
<div class="ui piled segment">
    @if($sets->count())
    <table class="ui celled padded table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>USER</th>
                <th class="text-right">OPTIONS</th>
            </tr>
        </thead>

        <tbody>
            @foreach($sets as $set)
            <tr>
                <td>{{$set->id}}</td>
                <td>{{$set->name}}</td>
                <td>{{$set->description}}</td>
                <td><img class="ui avatar image" src="{{ \App\User::where('id','=',$set->user_id)->first()->avatar }}">{{ \App\User::where('id','=',$set->user_id)->first()->name }}</td>
                <td class="text-right">
                    <a class="ui blue button" href="{{ route('sets.show', $set->id) }}"><i class="eye icon"></i> View</a>
                    <a class="ui yellow button" href="{{ route('sets.edit', $set->id) }}"><i class="edit icon"></i> Edit</a>
                    <form action="{{ route('sets.destroy', $set->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="ui red button"><i class="trash icon"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $sets->render() !!}
    @else
    <h3 class="text-center alert alert-info">Empty!</h3>
    @endif
</div>
@endsection