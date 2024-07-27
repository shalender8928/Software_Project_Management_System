<!DOCTYPE html>
<html lang="en">
  
@include('projectManager.css')
     
<body>
<div class="main-wrapper">

    <!-- Sidebar -->
    @include('projectManager.sidebar')

    <div class="page-wrapper">

        <!-- Header -->
        @include('projectManager.header')

        <div class="page-content" style="margin-left: 100px">
            <div class="row profile-body">
                <!-- Middle wrapper start -->
                <div class="col-md-8 col-xl-9 middle-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Edit Task</h6>

                                    <!-- Display success or error messages -->
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif

                                    <!-- Task editing form -->
                                    <form method="POST" action="{{ route('ProjectManager.update_pro_assigntask', $task->id) }}">
                                        @csrf
                                        @method('PATCH')

                                        <!-- Project Name -->
                                        <div class="mb-3">
                                            <label for="project_name" class="form-label">Project Name</label>
                                            <input type="text" class="form-control" id="project_name" name="project_name" value="{{ old('project_name', $task->project_name) }}" required>
                                            @error('project_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Task Description -->
                                        <div class="mb-3">
                                            <label for="task_description" class="form-label">Task Description</label>
                                            <textarea rows="4" class="form-control" id="task_description" name="task_description" required>{{ old('task_description', $task->task_description) }}</textarea>
                                            @error('task_description')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Priority -->
                                        <div class="mb-3">
                                            <label for="priority" class="form-label">Priority</label>
                                            <input type="text" class="form-control" id="priority" name="priority" value="{{ old('priority', $task->priority) }}" required>
                                            @error('priority')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Assign To -->
                                        <div class="mb-3">
                                            <label for="assign_to" class="form-label">Assign To</label>
                                            <input type="text" class="form-control" id="assign_to" name="assign_to" value="{{ old('assign_to', $task->assign_to) }}" required>
                                            @error('assign_to')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Deadline -->
                                        <div class="mb-3">
                                            <label for="deadline" class="form-label">Deadline</label>
                                            <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline', $task->deadline) }}" required>
                                            @error('deadline')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Start Date -->
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $task->start_date) }}" required>
                                            @error('start_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- End Date -->
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $task->end_date) }}" required>
                                            @error('end_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary me-2">Update Task</button>
                                        <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Middle wrapper end -->

                <!-- Right wrapper start -->
                <div class="d-none d-xl-block col-xl-3">
                    <div class="row"></div> 
                </div>
                <!-- Right wrapper end -->
            </div>
        </div>

        <!-- Footer -->
        @include('projectManager.footer')

    </div>
</div>

<!-- Core JS -->
@include('projectManager.js')

</body>
</html>
