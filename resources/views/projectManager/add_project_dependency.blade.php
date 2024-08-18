<!DOCTYPE html>
<html lang="en">
<head>
    @include('projectManager.css') <!-- Include your CSS files -->
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
        @include('projectManager.sidebar') <!-- Include sidebar -->
        <div class="page-wrapper">
            @include('projectManager.header') <!-- Include header -->
            <div class="page-content" style="margin-left:100px">
                <div class="col-md-8 col-xl-9 middle-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Add Project Dependency</h6>
                                    <form class="forms-sample" method="POST" action="{{ url('store_project_dependency') }}">
                                        @csrf

                                        <!-- Hidden field for plan_id -->
                                        <input type="hidden" name="plan_id" value="{{ $projectPlan->id }}">
                                        <div class="mb-3">
                                            <label class="form-label">Project Plan Name</label>
                                            <input class="form-control" type="text" value="{{ $projectPlan->name }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Preceding Task</label>
                                            <select class="form-control" id="preceding_task_id" name="preceding_task_id" onchange="updateTaskOptions()" required>
                                                <option value="">Select Preceding Task</option>
                                                @foreach($tasks as $task)
                                                    <option value="{{ $task->id }}">{{ $task->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Dependent Task</label>
                                            <select class="form-control" id="dependent_task_id" name="dependent_task_id" onchange="updatePrecedingTaskOptions()" required>
                                                <option value="">Select Dependent Task</option>
                                                @foreach($tasks as $task)
                                                    <option value="{{ $task->id }}">{{ $task->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Dependency Type</label>
                                            <select class="form-control" name="dependency_type" required>
                                                <option value="">Select Dependency type</option>
                                                <option value="start_to_start">Start to Start</option>
                                                <option value="finished_to_start">Finished to Start</option>
                                                <option value="start_to_finish">Start to Finish</option>
                                                <option value="finished_to_finish">Finished to Finish</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Click <span style="color: brown; font-weight:bolder">Go to Resources</span> if dependency has been added</label>
                                        </div>

                                        <!-- Submit and Cancel buttons -->
                                        <button type="submit" class="btn btn-primary me-2">Add Dependency</button>
                                        <a href="{{ url('go_to_resources', $projectPlan->id) }}" class="btn btn-success">Go to Resources</a>
                                        <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('projectManager.footer') <!-- Include footer -->
        </div>
    </div>
    @include('projectManager.js') <!-- Include your JS files -->
</body>
</html>
