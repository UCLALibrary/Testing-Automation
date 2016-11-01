@extends('semantic')

@section('content')
    <div class="ui two column doubling grid">
        <div class="column">
            <div class="ui piled segment">
                <h1>Recent</h1>
                <div class="ui feed">
                    @if(!$groups->isEmpty())
                        @foreach($groups as $group)
                            <div class="event">
                                <div class="label">
                                    @if($group->status == 0)
                                        <i class="thumbs outline down icon red"></i>
                                    @elseif($group->status == 1)
                                        <i class="thumbs outline up icon green"></i>
                                    @endif
                                </div>
                                <div class="content">
                                    <div class="summary">
                                        You executed tests click <a
                                                href="{{ route('tests.groups.show', $group->id)  }}">here</a> to view
                                        results.
                                        <div class="date">{{ $group->updated_at->diffInMonths(\Carbon\Carbon::now()) >= 1 ? $group->updated_at->format('j M Y , g:ia') : $group->updated_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
        <div class="column">
            <div class="ui piled segment">
                <h1>Statistics</h1>
                <div class="ui statistics">
                    <div class="statistic">
                        <div class="value">
                            {{ \App\Test::all()->count()  }}
                        </div>
                        <div class="label">
                            Tests
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ \Illuminate\Support\Facades\DB::table('jobs')->count()  }}
                        </div>
                        <div class="label">
                            Queued Jobs
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ \App\TestResult::all()->count()  }}
                        </div>
                        <div class="label">
                            Results
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ \App\User::all()->count()  }}
                        </div>
                        <div class="label">
                            Users
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ \App\Scheduler::all()->count()  }}
                        </div>
                        <div class="label">
                            Scheduled Tasks
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ \App\TestResult::where('jira_url' , '<>' , '')->count()  }}
                        </div>
                        <div class="label">
                            Tickets
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ui block header sticky">
        <div class="ui fitted right floated checkbox" style="margin-top:11px">
            <input type="checkbox" id="check-all">
            <label></label>
            <div class="ui fitted" style="padding-left:30px;margin-top:-11px;">
                <button class="ui red button left floated disabled" id="delete">Delete</button>
                <button class="ui blue button left floated disabled" id="add-category">Add Category</button>
            </div>
        </div>

        <div class="ui fitted" style="margin-top:-40px">
            <button class="ui orange button right floated" id="create">Create</button>
            <button class="ui green button right floated" id="runbycategory">Run by Category</button>
        </div>
    </div>

    <div id="body" class="ui one column doubling grid" style="margin-left:10px;margin-right:10px;">
        <div class="column">
            @if($tests->count())
                <table class="ui celled table">
                    <thead>
                    <tr>
                        <th width="10%">
                            <div class="ui ribbon label">Status</div>
                        </th>
                        <th width="20%">Name</th>
                        <th width="40%">Categories</th>
                        <th width="30%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tests as $test)
                        @if(!$test->trashed())
                            <tr>
                                <td>
                                    @if(isset($status[$test->id]['success']))
                                        @if($status[$test->id]['success'] == 0)
                                            <div class="ui red ribbon label">Failed</div>
                                        @elseif($status[$test->id]['success'] == 1)
                                            <div class="ui green ribbon label">Passed</div>
                                        @endif
                                    @else
                                        <div class="ui gray ribbon label">None</div>
                                    @endif
                                    <div class="ui checkbox">
                                        <input type="checkbox" class="{{ $test->id  }}"/>
                                        <label></label>
                                    </div>
                                </td>
                                <td>{{ $test->name  }}</td>
                                <td>
                                    <div class="ui tag labels">
                                        @if(isset($categories[$test->id]) && $categories[$test->id] != null)
                                            @foreach($categories[$test->id] as $k => $c)
                                                <div class="ui tag label">{{ \App\CategoryItem::where('id', '=', $c)->first()->header  }}
                                                    - {{ \App\CategoryItem::where('id', '=', $c)->first()->value  }} <a
                                                            href="{{ route('tests.category.delete', $k)  }}"><i
                                                                class="remove icon"></i></a></div>
                                            @endforeach
                                        @else
                                            None
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="ui two buttons">
                                        <a href="{{ route('tests.show', $test->id) }}" class="ui basic black button">View</a>
                                        <div class="ui dropdown basic black button">
                                            Actions
                                            <i class="dropdown icon"></i>
                                            <div class="menu">
                                                <div class="ui dropdown item">
                                                    Run
                                                    <i class="left dropdown icon"></i>
                                                    <div class="left menu">
                                                        <div class="header">
                                                            Variable Sets
                                                        </div>
                                                        <a class="item"
                                                           href="{{ route('tests.execute', ['tests' => $test->id, 'set' => 0])  }}">Default</a>
                                                        @foreach(\App\Set::all() as $s)
                                                            <a class="item"
                                                               href="{{ route('tests.execute', ['tests' => $test->id, 'set' => $s->id]) }}">{{ $s->name  }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="ui dropdown item">
                                                    Download
                                                    <i class="left dropdown icon"></i>
                                                    <div class="left menu">
                                                        <div class="header">
                                                            Variable Sets
                                                        </div>
                                                        <a class="item"
                                                           href="{{ route('tests.compiled', ['tests' => $test->id, 'set' => 0])  }}">Default</a>
                                                        @foreach(\App\Set::all() as $s)
                                                            <a class="item"
                                                               href="{{ route('tests.compiled', ['tests' => $test->id, 'set' => $s->id]) }}">{{ $s->name  }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="item">Edit</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4">
                            <div class="ui right floated pagination menu">
                                <a class="icon item">
                                    <i class="left chevron icon"></i>
                                </a>
                                <a class="item">1</a>
                                <a class="item">2</a>
                                <a class="item">3</a>
                                <a class="item">4</a>
                                <a class="icon item">
                                    <i class="right chevron icon"></i>
                                </a>
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            @else

            @endif
        </div>
    </div>
    <div id="runbycategory_prompt" class="ui modal">
        <div class="header">
            Run By Category
        </div>
        <div class="image content">
            <div class="description">
                <div class="ui form">
                    <div class="field">
                        <label>Categories</label>
                        <select multiple="multiple" name="categories[]" id="categories_dropdown" class="ui dropdown">
                            <option value="">Select Categories</option>
                            @foreach($items as $h => $i)
                                <optgroup label="{{ $h }}">
                                    @foreach($i as  $j)
                                        <option value="{{ \App\CategoryItem::where('header', '=', $h)->where('value', '=', $j)->first()->id }}">{{ $h }}
                                            - {{ $j }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label>Set</label>
                        <select name="set" id="set_dropdown" class="ui dropdown">
                            <option value="0">Default</option>
                            @if(!$sets->isEmpty())
                                @foreach($sets as $s)
                                    <option value="{{ $s->id  }}">{{ $s->name  }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui deny black button">Close</div>
            <div class="ui positive submit right labeled icon button">
                Run
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>

    <div id="create_prompt" class="ui modal">
        <div class="header">
            Create
        </div>
        <div class="image content">
            <form action="{{ route('tests.store') }}" method="POST" enctype="multipart/form-data" class="description">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        <label for="name-field">Name</label>
                        <input type="text" id="name-field" name="name" class="form-control" value="{{ old("name") }}"/>
                        @if($errors->has("name"))
                            <span class="help-block">{{ $errors->first("name") }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('location')) has-error @endif">
                        <label for="location-field">Location</label>
                        <input id="location-field" type="file" name="location" class="form-control"/>
                        @if($errors->has("location"))
                            <span class="help-block">{{ $errors->first("location") }}</span>
                        @endif
                    </div>
                <div class="actions">
                    <div class="ui deny black button">Close</div>
                    <input class="ui positive submit right labeled icon button" type="submit">
                </div>
            </form>
        </div>
    </div>

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.positive.submit.button').on('click', function () {
                submitForm();
            });

            function submitForm() {
                var categories = $('#categories_dropdown').dropdown('get value');
                var formData = {
                    categories: categories.splice(-1, 1),
                    set: $('#set_dropdown').dropdown('get value'),
                    _token: '{{ csrf_token() }}',
                };

                $.ajax({
                    type: 'POST',
                    url: '{{ route('tests.executeCategory')  }}',
                    data: formData,
                    success: function (response) {
                        if (response == "done") {
                            $.jGrowl("Executed all tests relating to those categories", {
                                header: 'Alert',
                                position: 'bottom-right',
                                life: 10000
                            });
                        }
                    }
                });
            }

            $("#runbycategory").on('click', function () {
                $('#runbycategory_prompt')
                        .modal('show')
                ;
            });

            $("#create").on('click', function () {
                $('#create_prompt').modal('show');
            });

            $("#this").on('click', function () {
                alert("boop");
            });

            var check_count = 0;
            $("input:checkbox").change(function () {
                if (this.id == "check-all") {
                    if (this.checked) {
                        $(":checkbox:not(#check-all)").each(function () {
                            this.checked = true;
                        });
                    } else {
                        $(":checkbox:not(#check-all)").each(function () {
                            this.checked = false;
                        });
                    }
                }

                var check_count = $("[type='checkbox']:checked").length;

                if (check_count > 0) {
                    $("#delete").removeClass("disabled");
                    $("#add-category").removeClass("disabled");
                } else {
                    $("#delete").addClass("disabled");
                    $("#add-category").addClass("disabled");
                }

                //window.alert(check_count);
            });

            $("#delete").click(function () {
                var selected = [];
                $("input:checked").each(function () {
                    if ($(this).attr('class') != undefined) {
                        selected.push($(this).attr('class'));
                    }
                });

                window.location.replace("/tests/multiple/" + selected.join(","));
            });

            $("#add-category").click(function () {
                var selected = [];
                $("input:checked").each(function () {
                    if ($(this).attr('class') != undefined) {
                        selected.push($(this).attr('class'));
                    }
                });

                window.location.replace("/tests/category/" + selected.join(","));
            });
        });
    </script>
@endsection