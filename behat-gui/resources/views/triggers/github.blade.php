@extends('semantic')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('header')
<h1><i class="edit icon"></i> Edit Github Configs</h1>
@endsection

@section('content')
@include('error')
<div class="ui piled segment">
    <div class="ui form">
        <h4>Current Settings</h4>
        @if(!empty(json_decode($categories)) && $wait != null && $set != null)
        <span style="color:green;">When Behat-GUI gets a github payload, it will wait <b><u>{{ $wait->value  }} seconds.</u></b> Then execute categry:
            <b><u>
                @foreach(json_decode($categories->value, true) as $category)
                {{ \App\CategoryItem::where('id', '=', $category)->first()->header  }} -  {{ \App\CategoryItem::where('id', '=', $category)->first()->value  }}
                @endforeach
            </u></b>,
            against the <b><u>{{ \App\Set::where('id', '=', $set->value)->first()->name  }}</u></b> variable set.</span>
            @else
            <span style="color:red;"><p>There are no Github settings configured for this user.</p></span>
            @endif

            <hr />
            <form action="{{ route('triggers.github_save')  }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="field">
                    <h4 class="text-center">Use this area to configure which categories get run when a git payload is delivered to this address. </h4>
                </div>

                <div class="field">
                    <div class="form-group">
                        <p for="wait">When Behat-GUI gets a github payload it will wait <u><b>this many</b></u> seconds,</p>
                        <input type="text" name="wait" placeholder="(number)" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <p for="categories">then execute <u><b>these categories</u></b></p>
                        <select name="categories[]" id="categories" multiple class="form-control" required>
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
                        <p for="set">against <u><b>this variable set.</u></b></p>
                        <select name="set" id="set" class="form-control" required>
                            @foreach($sets as $s)
                            <option value="{{ $s->id  }}">{{ $s->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="ui green button">Save</button>
                    
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
