<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Behat</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dist/semantic.css')  }}">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.css" />
    <style>
        body {
            padding: 1em;
        }
        .ui.menu {
            margin: 3em 0em;
        }
        .ui.menu:last-child {
            margin-bottom: 110px;
        }

        .sticky {
            position: absolute;
            bottom: 0;
        }

        .sticky:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
<div class="ui inverted menu">
    <div class="header item">Welcome!</div>
</div>

@yield('header')
@yield('content')

<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/dist/semantic.min.js')  }}"></script>
<script type="text/javascript" src="{{ asset('autosize.min.js')  }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.js"></script>


<script type="application/javascript">

    @if ($errors->has())
        @foreach ($errors->all() as $error)
            $.jGrowl("{{ $error  }}", { header: 'Error', position: 'bottom-right', life: 10000 });
    @endforeach
@endif
@if (session('message'))
    $.jGrowl("{{ session('message')  }}", { header: 'Alert', position: 'bottom-right', life: 10000 });
    @endif
</script>

<script type="text/javascript">
    autosize($('textarea'));
    $(document).ready(function() {
        $.ajax({
            type: "get",
            url: '/ajax/kill_notifications',
            dataType: 'json',
        });
        $('.code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });
    setInterval(function(){
        $.ajax({
            type: "get",
            url: '/ajax/notifications',
            dataType: 'json',
            success: function(request){
                $.each(request, function(k,v){
                    $.jGrowl(v, { header: 'Alert', position: 'bottom-left', life: 10000 });
                    $.ajax({
                        type: "get",
                        url: '/ajax/kill_notifications/'+k,
                        dataType: 'json',
                    });
                });
            }
        });
    }, 1000);

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.ui.menu .ui.dropdown').dropdown({
            on: 'hover'
        });
        $('.ui.dropdown').dropdown({
            on: 'click'
        });
        $('.ui.sticky')
                .sticky({
                    context: '#body'
                })
        ;
        $('.ui.menu a.item')
                .on('click', function() {
                    $(this)
                            .addClass('active')
                            .siblings()
                            .removeClass('active');
                });

    });
</script>

@yield('scripts')

</body>
</html>