@extends('semantic')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
        <h1><i class="icon edit"></i> Variables / Edit #{{$variable->id}}</h1>
@endsection

@section('content')
    @include('error')

    <div class="ui piled segment">
        <div class="ui form">
            <input type="hidden" name="_method" value="PUT">

            <div class="field @if($errors->has('key')) error @endif">
                   <label for="key-field">Key</label>
                <input type="text" id="default-key" name="key" class="form-control" value="{{ $variable->key }}"/>
                   @if($errors->has("key"))
                    <span class="help-block">{{ $errors->first("key") }}</span>
                   @endif
                </div>
                <div class="field @if($errors->has('value')) error @endif">
                   <label for="value-field">Value</label>
                <input type="text" id="default-value" name="value" class="form-control" value="{{ json_decode($variable->value, true)[0] }}"/>
                   @if($errors->has("value"))
                    <span class="help-block">{{ $errors->first("value") }}</span>
                   @endif
                </div>
                <hr />
                <a id="add_set" class="ui blue button">Add Variable Set</a><br/><br />
                @foreach(json_decode($variable->value, true) as $k => $v)
                @if($k != 0)
                <div class="field">
                    <label for="value-field-{{ $k-1  }}">Value {{ $k-1  }}</label>
                    <input type="text" id="value-field-{{ $k-1  }}" name="value_{{ $k-1  }}" class="form-control" value="{{ $v  }}">
                </div>
                <div class="field">
                    <label for="set-field-{{ $k-1  }}">Set {{ $k-1  }}</label>
                    <select id="set-field-{{ $k-1  }}" name="set_{{ $k-1  }}" class="form-control">
                        @foreach(\App\Set::all() as $s)
                            <option value='{{ $s->id  }}' @if(json_decode($variable->sets)[$k] == $s->id) selected @endif>{{ $s->name  }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                @endforeach
                <div id="set_area"></div>
                
                    <button class="ui green button" id="set_create">Create</button>
                    <a class="ui grey button" href="{{ route('variables.index') }}"><i class="reply icon"></i> Back</a>
                
        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });

    var num = {{ count(json_decode($variable->value, true)) -1  }};
    $("#add_set").on("click", function(){
        $("#set_area").append("<div class='form-group'><label for='value-field-"+num+"'>Value "+num+"</label><input type='text' id='value-field-"+num+"' name='value_"+num+"' class='form-control' value=''/></div> <div class='form-group'> <label for='set-field-"+num+"'>Set "+num+"</label><select id='set-field-"+num+"' name='set_"+num+"' id class='form-control'>@foreach(\App\Set::all() as $s) <option value='{{ $s->id  }}'>{{ $s->name  }}</option> @endforeach</select></div>");
        num += 1;
    });

    $("#set_create").on("click", function(){
        var final = {};
        var main = {};
        var set_ids = $('select').filter(function() { return this.id.match(/set-field-([0-9]+)/); });
        $(set_ids).each(function(n, i){
            var id = "#"+i.id;
            var num = id.split('-');

            final[num[num.length-1]] = {};
            final[num[num.length-1]].select = $(id).val();

        });

        var input_ids = $('input').filter(function() { return this.id.match(/value-field-([0-9]+)/); });
        $(input_ids).each(function(n, i){
            var id = "#"+i.id;
            var num = id.split('-');

            final[num[num.length-1]].input = $(id).val();

        });
        main['key'] = $("#default-key").val();
        main['value'] = $("#default-value").val();
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' } });


        $.ajax({
            url: '{{ route('variables.update', $variable->id) }}',
            method: 'POST',
            data: "_method=PUT&data="+JSON.stringify(final)+"&main="+JSON.stringify(main),
            complete: function(r){
                $("body").html(r.responseText);
            }
        });

    });
  </script>
@endsection
