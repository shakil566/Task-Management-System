@extends('layouts.admin.master')
@section('admin_content')
<!-- BEGIN CONTENT BODY -->
<div class="content-wrapper">

    <!-- BEGIN PORTLET-->
    @include('layouts.admin.flash')
    <!-- END PORTLET-->

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('english.ASSIGNED_TASK')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">@lang('english.HOME')</a></li>
                        <li class="breadcrumb-item active">@lang('english.ASSIGNED_TASK')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('english.ASSIGNED_TASK_DETAILS')</h3>
                        </div>


                        <!-- Begin Filter-->
                        {!! Form::open(array('group' => 'form', 'url' => 'admin/assignedTask/filter','class' => 'form-horizontal')) !!}

                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="search">@lang('english.SEARCH')</label>
                                        <div class="col-md-8">
                                            {!! Form::text('search_text', Request::get('search_text'), ['class' => 'form-control tooltips', 'title' => 'Teammates Name', 'placeholder' => 'Teammates Name', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="projectId">@lang('english.PROJECT')</label>
                                        <div class="col-md-8">
                                            {!! Form::select('project_id', $projectFilterList, Request::get('project_id'), ['class' => 'form-control select2', 'id' => 'projectId']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="taskId">@lang('english.TASK') </label>
                                        <div class="col-md-9">
                                            {!! Form::select('task_id', $taskFilterList, Request::get('task_id'), ['class' => 'form-control select2', 'id' => 'taskId']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="status">@lang('english.STATUS') </label>
                                        <div class="col-md-8">
                                            {!! Form::select('status', $statusList, Request::get('status'), ['class' => 'form-control select2', 'id' => 'status']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md btn-info filter-submit margin-top-20">
                                            <i class="fa fa-search"></i> @lang('english.FILTER')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <!-- End Filter -->



                        <!-- /.card-header -->
                        <div class="card-body assigned-task">
                            <table id="dataTable" class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>@lang('english.SL_NO')</th>
                                        <th>@lang('english.TASK')</th>
                                        <th>@lang('english.TEAMMATES') @lang('english.NAME')</th>
                                        <th>@lang('english.STATUS')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (!empty($assignTaskInfo))
                                    <?php
                                    $sl = 0;
                                    $rowSpan = 1;
                                    ?>
                                    @foreach ($assignTaskInfo as $tId => $assignTaskArr)
                                    <?php
                                    if (!empty($assignTaskArr)) {
                                        $rowSpan = count($assignTaskArr) + 1;
                                    }
                                    ?>
                                    <tr class="text-center">
                                        <td rowspan="{{$rowSpan}}">{{ ++$sl }}</td>
                                        <td rowspan="{{$rowSpan}}">{{ isset( $taskList[$tId]) ? $taskList[$tId] : '' }}
                                        </td>
                                        @foreach ($assignTaskArr as $value)
                                    <tr class="text-center">
                                        <td>{{ $value->user_name ?? '' }}
                                        </td>
                                        <td>
                                            @if ($value->status == '1')
                                            <span class="badge badge-secondary">@lang('english.PENDING') &nbsp;<i class="fa fa-clock"></i></span>
                                            @elseif($value->status == '2')
                                            <span class="badge badge-info">@lang('english.WORKING') &nbsp;<i class="fa fa-spinner"></i></span>
                                            @elseif($value->status == '3')
                                            <span class="badge badge-success">@lang('english.DONE') &nbsp;<i class="fa fa-check"></i></span>
                                            @else
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="15">{{ __('english.EMPTY_DATA') }}</td>
                                    </tr>
                                    @endif

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>


<!-- END CONTENT BODY -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $(function() {
        $("#dataTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@stop