<div class="modal-lg modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Assign Task</h4>
            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body assigntask-modal">
            <div class="row">
                <div class="col-md-4">
                    <div class="card-body task-project-info">
                        <div class="form-group">
                            <label for="project">@lang('english.PROJECT'):</label>
                            <span>{{ !empty($taskInfo) ? $taskInfo->project_name : '' }}</span>
                            {{ Form::hidden('project_id', !empty($taskInfo) ? $taskInfo->project_id : null, array('id' => 'projectId')) }}

                        </div>
                        <div class="form-group">
                            <label for="task">@lang('english.TASK'):</label>
                            <span>{{ !empty($taskInfo) ? $taskInfo->task_name : '' }}</span>
                            {{ Form::hidden('task_id', !empty($taskInfo) ? $taskInfo->id : null, array('id' => 'taskId')) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="userId">@lang('english.TEAMMATES')</label>
                            {!! Form::select(
                            'user_id[]',
                            $userList ?? [], !empty($assignedTaskInfo) ? $assignedTaskInfo : null,
                            [
                            'class' => 'form-control select2',
                            'id' => 'userId',
                            'multiple' => 'multiple',
                            'data-placeholder' => "--Select Teammates--",
                            'autocomplete' => 'off',
                            ],
                            ) !!}
                            <span class="help-block text-danger">{{ $errors->first('user_id') }}</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between bg-secondary">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary saveAssignTask">Submit</button>
        </div>
    </div>


    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>