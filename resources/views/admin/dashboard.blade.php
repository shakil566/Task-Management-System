@extends('layouts.admin.master')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@lang('english.DASHBOARD')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li> --}}
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            
            @if(Auth::user()->user_group_id != 2)
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">@lang('english.USER')</span>
                            <span class="info-box-number">
                                {{ Auth::user()->count() }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->


                <!-- fix for small devices only -->
                <!-- <div class="clearfix hidden-md-up"></div> -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Teammates</span>
                            <span class="info-box-number">{{ !empty($teammatesCount) ? $teammatesCount : 0}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-award"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Projects</span>
                            <span class="info-box-number">{{ !empty($projectCount) ? $projectCount : 0}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-list-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tasks</span>
                            <span class="info-box-number">{{ !empty($taskCount) ? $taskCount : 0}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            @endif
            <!-- /.row -->
            @if(Auth::user()->user_group_id == 2)
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-list-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Task</span>
                            <span class="info-box-number">
                                {{ !empty($totalTaskC) ? $totalTaskC : 0 }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->


                <!-- fix for small devices only -->
                <!-- <div class="clearfix hidden-md-up"></div> -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-clock"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pending Task</span>
                            <span class="info-box-number">{{ !empty($pendingTaskC) ? $pendingTaskC : 0}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-spinner"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Working Task</span>
                            <span class="info-box-number">{{ !empty($workingTaskC) ? $workingTaskC : 0}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Task Done</span>
                            <span class="info-box-number">{{ !empty($taskDoneC) ? $taskDoneC : 0}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            @endif

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection