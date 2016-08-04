@extends('layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Edit Github Configs</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Current Settings</h4>
            @if(!empty(json_decode($categories)) && $wait != null && $set != null)
                When Behat-GUI gets a github payload, it will wait <b>{{ $wait->value  }} seconds.</b> Then, the following categories will be executed with the <b>{{ \App\Set::where('id', '=', $set->value)->first()->name  }}</b> variable set.
                <ul>
                @foreach(json_decode($categories->value, true) as $category)
                    <li>{{ \App\CategoryItem::where('id', '=', $category)->first()->header  }} -  {{ \App\CategoryItem::where('id', '=', $category)->first()->value  }}</li>
                @endforeach
            </ul>
            @else
                <p>Nothing Configured</p>
            @endif

            <hr />
            <form action="{{ route('triggers.github_save')  }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <h4 class="text-center">This config area is to configure which categories get run when there is a git payload delivered to this system</h4>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <p for="wait"><u>When Behat-GUI gets a github payload it will wait (input) seconds,</u></p>
                        <input type="text" name="wait" placeholder="(number)" class="form-control" />
                    </div>
                    <div class="form-group">
                        <p for=categories"><u>then execute these</u> <b>categories</b></p>
                        <select name="categories[]" id="categories" multiple class="form-control">
                            @foreach($items as $h => $i)
                                <optgroup label="{{ $h }}">
                                    @foreach($i as  $j)
                                        <option value="{{ \App\CategoryItem::where('header', '=', $h)->where('value', '=', $j)->first()->id }}">{{ $j }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <p for="set"><u>against this variable</u> <b>set.</b></p>
                        <select name="set" id="set" class="form-control">
                            @foreach($sets as $s)
                                <option value="{{ $s->id  }}">{{ $s->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('roles.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

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
