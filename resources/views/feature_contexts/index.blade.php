@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> FeatureContexts
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>FEATURE</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="code php">{!! str_replace("    ", "&emsp;", str_replace("\n", "<br />", $feature_contexts))  !!}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-warning" href="{{ route('feature_contexts.edit', 1) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

        </div>
    </div>

@endsection