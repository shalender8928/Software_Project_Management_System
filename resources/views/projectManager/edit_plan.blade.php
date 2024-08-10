<!DOCTYPE html>
<html lang="en">
<head>
    @include('projectManager.css') <!-- Include your CSS files -->
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
                                <h6 class="card-title">Edit Project Plan</h6>
                                <form class="forms-sample" id="project-plan-form" method="POST" action="{{ url('update_project_plan', $projectPlan->id) }}">
                                    @csrf
                                    @method('PATCH') <!-- Use PUT method for updating -->

                                    <div class="mb-3">
                                        <label class="form-label">Project Name</label>
                                        <input type="text" class="form-control" value="{{ $project->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Plan Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $projectPlan->name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" rows="8">{{ $projectPlan->description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" value="{{ $projectPlan->start_date }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deadline</label>
                                        <input type="date" class="form-control" name="deadline" value="{{ $projectPlan->deadline }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2">Update Plan</button>
                                    <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                    <a href="{{ url('select_project_plan',$project->id ) }}" class="btn btn-success">Go Back</a>

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
