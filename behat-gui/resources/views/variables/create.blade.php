@extends('layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Variables / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group @if($errors->has('key')) has-error @endif">
                <label for="key-field">Key</label>
                <input type="text" id="default-key" name="key" class="form-control" value="{{ old("key") }}"/>
                @if($errors->has("key"))
                    <span class="help-block">{{ $errors->first("key") }}</span>
                @endif
            </div>
            <div class="form-group @if($errors->has('value')) has-error @endif">
                <label for="value-field">Default Value</label>
                <input type="text" id="default-value" name="default-value" class="form-control" value="{{ old("value") }}"/>
                @if($errors->has("value"))
                    <span class="help-block">{{ $errors->first("value") }}</span>
                @endif
            </div>
            <hr />
            <a id="add_set" class="btn btn-primary">Add Variable Set</a><br/><br />
            <div id="set_area"></div>
            <div class="well well-sm">
                <button class="btn btn-primary" id="set_create">Create</button>
                <a class="btn btn-link pull-right" href="{{ route('variables.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.date-picker').datepicker({
        });


        var num = 0;
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
            var key = $("#default-key").val();

            main['key'] = key.replace("&", "&amp;");
            main['value'] = $("#default-value").val();

            console.log(main);

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' } });


            $.ajax({
                url: '{{ route('variables.store') }}',
                method: 'POST',
                data: "data="+JSON.stringify(final)+"&main="+JSON.stringify(main),
                complete: function(r){
                    $("body").html(r.responseText);
                }
            });

        });

    </script>
@endsection
