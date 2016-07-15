@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Tests
            <a class="btn btn-success pull-right" href="{{ route('tests.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    @if($tests->count())
    <div class="row">

        <div class="form-group">
            <a href="#" id="runbycategory" class="btn btn-primary form-control">Run by Category</a>
        </div>
        <form action="{{ route('tests.executeCategory')  }}" method="POST" id="runbycategoryform" class="hidden">
            {!! csrf_field() !!}
            <div class="col-sm-6 ">
                    <div class="form-group">
                        <label for=categories">Categories</label>
                        <select name="categories[]" id="categories" multiple class="form-control">
                        @foreach($items as $h => $i)
                            <optgroup label="{{ $h }}">
                                @foreach($i as  $j)
                                    <option value="{{ \App\CategoryItem::where('header', '=', $h)->where('value', '=', $j)->first()->id }}">{{ $j }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                        </select>
                    </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="set">Variable Set</label>
                    <select name="set" id="set" class="form-control">
                        <option value="0">Default</option>
                    @foreach($sets as $s)
                        <option value="{{ $s->id  }}">{{ $s->name  }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Execute" />
                </div>
            </div>
        </form>

    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            @if($tests->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>FILE</th>
                            <th>LAST STATUS</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tests as $test)
                            <tr>
                                <td>{{$test->name}}<br />@if(isset($tags[$test->id])) <ul> @foreach($tags[$test->id] as $t) <li>{{ $t  }}</li>  @endforeach </ul> @endif</td>
                                <td class="code gherkin">{!! str_replace("\n", "<br />", str_replace(" ", "&nbsp;", file_get_contents($test->location)))   !!}</td>
                                <td>
                                    @if(isset($status[$test->id]['success']))
                                        @if($status[$test->id]['success'] == 0)
                                            <span class="label label-danger">Failed</span>
                                        @elseif($status[$test->id]['success'] == 1)
                                            <span class="label label-success">Success</span>
                                        @endif
                                    @else
                                        <span class="label label-primary">Not yet run</span>
                                    @endif
                                    @if(isset($status[$test->id]['timestamp']))
                                        @if($status[$test->id]['timestamp'] != null)
                                                <br /> <span class="label label-primary">{{ $status[$test->id]['timestamp']->diffInMonths(\Carbon\Carbon::now()) >= 1 ? $status[$test->id]['timestamp']->format('j M Y , g:ia') : $status[$test->id]['timestamp']->diffForHumans() }}</span>
                                        @endif
                                    @endif
                                    </td>
                                <td class="text-right">
                                    <!--- href="{{ route('tests.execute', $test->id) }}" -->

                                    <div class=btn-group>
                                      <button class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-refresh"></i> Execute</button>
                                      <ul class="dropdown-menu">
                                          <li class="dropdown-header">Variable Sets</li>
                                          <li>
                                              <a href="{{ route('tests.execute', ['tests' => $test->id, 'set' => 0])  }}">Default</a>
                                          </li>
                                        @foreach(\App\Set::all() as $s)
                                        <li>
                                          <a href="{{ route('tests.execute', ['tests' => $test->id, 'set' => $s->id]) }}">{{ $s->name }}</a>
                                        </li>
                                        @endforeach
                                      </ul>
                                    </div>

                                    <a class="btn btn-xs btn-info" href="{{ route('tests.category', $test->id) }}"><i class="glyphicon glyphicon-folder-open"></i> Add Category</a>
                                    <a class="btn btn-xs btn-primary" href="{{ route('tests.show', $test->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a><br /><br />
                                    <a class="btn btn-xs btn-warning" href="{{ route('tests.edit', $test->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('tests.destroy', $test->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @if(isset($categories[$test->id]) && $categories[$test->id] != null)
                            <tr>
                                <td colspan="4" style="border-top:0; border-bottom: 1px solid black;">
                                    <div class="row">
                                        <div class="col-lg-2"><b>Categories:</b></div>
                                        <div class="col-lg-10">
                                            @foreach($categories[$test->id] as $c)
                                                {{ \App\CategoryItem::where('id', '=', $c)->first()->header  }}:  {{ \App\CategoryItem::where('id', '=', $c)->first()->value  }} - <a href="{{ route('tests.deleteCategory', $c)  }}">Delete</a><br />
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {!! $tests->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $("#runbycategory").on('click', function(){
            $("#runbycategoryform").toggleClass('hidden');
        });
    </script>
@endsection