@extends('welcome')

@section('content')
<div class="ui centered segment">
    <div class="ui one column centered grid">
        <div class="one column centered row">
            <!-- <div class="panel panel-default"> -->
                <h1 class="header">Login</h1>
                <div class="content">
                    <a href="auth/github"><img src="{{ asset('github.png') }}" /></a>
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>
@endsection
