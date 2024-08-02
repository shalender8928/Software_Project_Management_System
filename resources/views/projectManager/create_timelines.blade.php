<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Milestone</title>
    <!-- Include CSS -->
    @include('projectManager.css')
</head>
<body>
<div class="main-wrapper">
    <!-- Include Sidebar -->
    @include('projectManager.sidebar')

    <div class="page-wrapper">
        <!-- Include Navbar -->
        @include('projectManager.header')

        <div class="page-content" style="margin-left:100px">
            <div class="row profile-body">
                <!-- Middle Content -->
                <div class="col-md-8 col-xl-9 middle-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Create Timeline </h6>
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form class="forms-sample" method="POST" action="{{ route('projectmanager.add_new_timelines') }}">
                                        @csrf
                                        <div class="container">
                                        
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Project name</label>
                                                <select class="form-control" name="project_plan_id" required>
                                                    @foreach($projects as $project)
                                                        <option value="{{ $project->project_plan_id }}">{{ $project->project_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('project_plan_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Task Name</label>
                                                <input type="text" class="form-control" id="task_name" name="taskName" required>
                                                @error('taskName')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
    <label class="form-label">Task Date</label>
    <input type="date" class="form-control" id="task_date" name="taskDate" required>
    @error('taskDate')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>




                                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                                            <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar (Optional) -->
                <div class="d-none d-xl-block col-xl-3">
                    <!-- Content for Right Sidebar -->
                </div>
            </div>
        </div>

        <!-- Include Footer -->
        @include('projectManager.footer')
    </div>
</div>

<!-- Include JavaScript -->
@include('projectManager.js')

</body>
</html>
