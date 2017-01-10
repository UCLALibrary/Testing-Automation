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
    <a href="{{ route('tests.index')  }}" class="header item">Behat</a>
    <a href="{{ route('tests.index')  }}" class="item">Tests</a>
    <a href="{{ route('reports.index')  }}" class="item">Report</a>
    <div class="ui dropdown item">
        Templating
        <i class="dropdown icon"></i>
        <div class="menu">
            <a href="{{ route('variables.index')  }}" class="item">Variables</a>
            <a href="{{ route('sets.index')  }}" class="item">Sets</a>
        </div>
    </div>
    <div class="ui dropdown item">
        Triggers
        <i class="dropdown icon"></i>
        <div class="menu">
            <a href="{{ route('triggers.github')  }}" class="item">Github</a>
            <a href="{{ route('triggers.jira')  }}" class="item">JIRA</a>
        </div>
    </div>
    <a href="{{ route('schedulers.index')  }}" class="item">Scheduler</a>
    <a href="{{ route('categories.index')  }}" class="item">Categories</a>
    <a href="{{ route('feature_contexts.index')  }}" class="item">Feature Context</a>
    <div class="right menu">
        <div class="item">
            <div class="ui transparent inverted icon input">
                <i class="search icon"></i>
                <input type="text" placeholder="Search Tests">
            </div>
        </div>
        <div class="item">
            <?php $you = "friend"; if(Auth::check()) {$you = Auth::user()->name; } ?>
            Welcome, {{ $you }}.
        </div>
        <div class="ui dropdown item">
            <?php $avatar = Auth::user()->avatar; ?>
            <img src="{{ $avatar }}"/>
            <i class="dropdown icon"></i>
            <div class="menu">
                <div class="item">
                    <a href="/logout" style="color:black;">Logout</a>
                </div>
            </div>
        </div>
    </div>
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