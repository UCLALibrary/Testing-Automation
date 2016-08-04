@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <a href="/auth/github"><img src="{{ asset('github.png') }}" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
