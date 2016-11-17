@extends('semantic')

@section('header')
<h1>
    <i class="paint brush icon"></i> FeatureContexts
    <a class="ui yellow button" href="{{ route('feature_contexts.edit', 1) }}"><i class="edit icon"></i> Edit</a>
</h1>
@endsection

@section('content')

<div class="ui inverted segment">
    <code class="ignored code">
        {!! str_replace("    ", "&emsp;", str_replace("\n", "<br />", $feature_contexts))  !!}
    </code>
</div>

@endsection