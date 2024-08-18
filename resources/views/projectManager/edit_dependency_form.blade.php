<!DOCTYPE html>
<html lang="en">
<head>
    @include('projectManager.css')
    <script>
        // JavaScript function to update the dependent task options based on the selected preceding task
        function updateTaskOptions() {
            let precedingTaskId = document.getElementById("preceding_task_id").value;
            let dependentTaskSelect = document.getElementById("dependent_task_id");
            let tasks = @json($tasks);

            // Clear the dependent task options
            dependentTaskSelect.innerHTML = '';

            // Add new options excluding the selected preceding task
            tasks.forEach(task => {
                if (task.id != precedingTaskId) {
                    let option = document.createElement("option");
                    option.value = task.id;
                    option.text = task.name;
                    dependentTaskSelect.add(option);
                }
            });
        }

        // JavaScript function to update the preceding task options based on the selected dependent task
        function updatePrecedingTaskOptions() {
            let dependentTaskId = document.getElementById("dependent_task_id").value;
            let precedingTaskSelect = document.getElementById("preceding_task_id");
            let tasks = @json($tasks);

            // Clear the preceding task options
            precedingTaskSelect.innerHTML = '';

            // Add new options excluding the selected dependent task
            tasks.forEach(task => {
                if (task.id != dependentTaskId) {
                    let option = document.createElement("option");
                    option.value = task.id;
                    option.text = task.name;
                    precedingTaskSelect.add(option);
                }
            });
        }
    </script>
</head>
<body>
<div class="main-wrapper">

    <!-- Include sidebar -->
    @include('projectManager.sidebar')

    <div class="page-wrapper">
        <!-- Include header -->
        @include('projectManager.header')

        <div class="page-content" style="margin-left:100px">
            <div class="col-md-8 col-xl-9 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Edit Project Dependency</h6>

                                <form class="forms-sample" method="POST" action="{{ url('update_project_dependency', $dependency->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <!-- Project Plan Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Project Plan Name</label>
                                        <input type="text" class="form-control" value="{{ $projectPlan->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Preceding Task</label>
                                        <select class="form-control" id="preceding_task_id" name="preceding_task_id" onchange="updateTaskOptions()" required>
                                            <option value="">Select Preceding Task</option>
                                            @foreach($tasks as $task)
                                                <option value="{{ $task->id }}" {{ $task->id == $dependency->preceding_task_id ? 'selected' : '' }}>{{ $task->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Dependent Task</label>
                                        <select class="form-control" id="dependent_task_id" name="dependent_task_id" onchange="updatePrecedingTaskOptions()" required>
                                            <option value="">Select Dependent Task</option>
                                            @foreach($tasks as $task)
                                                <option value="{{ $task->id }}" {{ $task->id == $dependency->dependent_task_id ? 'selected' : '' }}>{{ $task->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Dependency Type</label>
                                        <select class="form-control" name="dependency_type" required>
                                            <option value="start_to_start" {{ $dependency->dependency_type == 'start_to_start' ? 'selected' : '' }}>Start to Start</option>
                                            <option value="finished_to_start" {{ $dependency->dependency_type == 'finished_to_start' ? 'selected' : '' }}>Finished to Start</option>
                                            <option value="start_to_finish" {{ $dependency->dependency_type == 'start_to_finish' ? 'selected' : '' }}>Start to Finish</option>
                                            <option value="finished_to_finish" {{ $dependency->dependency_type == 'finished_to_finish' ? 'selected' : '' }}>Finished to Finish</option>
                                        </select>
                                    </div>

                                    <!-- Submit and Cancel buttons -->
                                    <button type="submit" class="btn btn-primary me-2">Update Dependency</button>
                                    <a href="{{ url('select_project_plan', $projectPlan->id) }}" class="btn btn-secondary">Cancel</a>
                                    <a href="{{ url('select_project_plan',$project->id ) }}" class="btn btn-success">Go Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include footer -->
        @include('projectManager.footer')
    </div>
</div>

<!-- Include JS files -->
@include('projectManager.js')

</body>
</html>
