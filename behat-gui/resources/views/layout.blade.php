<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.css" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Behat GUI</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.4.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.4.0/highlight.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css')  }}" />
    <link rel="stylesheet" href="{{ asset('jjsonviewer.css')  }}" />
    <!-- Custom styles for this template -->
    <!-- <link href="starter-template.css" rel="stylesheet"> -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')
</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Behat</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                @if(Auth::check())
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('tests.index')  }}">Home</a></li>
                    <li><a href="{{ route('reports.index') }}">Report</a></li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Templating <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('variables.index')  }}">Variables</a></li>
                            <li><a href="{{ route('sets.index')  }}">Sets</a></li>
                        </ul>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Triggers <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('triggers.github')  }}">Github</a></li>
                            <li><a href="{{ route('triggers.jira')   }}">JIRA</a></li>
                            <li><a href="#">Travis</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('schedulers.index')  }}">Scheduler</a></li>
                    <li><a href="{{ route('categories.index')  }}">Categories</a></li>
                    <li><a href="{{ route('feature_contexts.index')  }}">Feature Context</a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                </ul>
                @endif
                @if(!Auth::check())
                <ul class="nav navbar-nav pull-right">
                    <li><a href="{{ url('/login') }}">Login</a></li>
                </ul>
                @endif
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        @yield('header')
        @yield('content')
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    <script type="text/javascript" src="{{ asset('jjsonviewer.js')  }}"></script>
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

    @yield('scripts')



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
</body>
</html>
