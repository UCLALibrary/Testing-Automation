@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Services
            <a class="btn btn-success pull-right" href="{{ route('services.index')  }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center alert alert-info">Empty!</h3>
        </div>
    </div>

@endsection
