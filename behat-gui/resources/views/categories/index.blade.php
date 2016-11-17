@extends('semantic')

@section('header')
<h1>
    <i class="cubes icon"></i> Categories
    <a class="ui green button" href="{{ route('categories.create') }}"><i class="plus icon"></i> Create</a>
</h1>
@endsection

@section('content')
<div class="ui piled segment">
    <div>
        @if($categories->count())
        <table class="ui celled padded table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>HEADER</th>
                    <th>VALUE</th>
                    <th class="text-right">OPTIONS</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->header}}</td>
                    <td>{{$category->value}}</td>
                    <td class="text-right">
                        <a class="ui blue button" href="{{ route('categories.show', $category->id) }}"><i class="eye icon"></i> View</a>
                        <a class="ui yellow button" href="{{ route('categories.edit', $category->id) }}"><i class="edit icon"></i> Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="ui red button"><i class="trash icon"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $categories->render() !!}
        @else
        <h3 class="text-center alert alert-info">Empty!</h3>
        @endif

    </div>
</div>

@endsection