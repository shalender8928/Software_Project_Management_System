<!DOCTYPE html>
<html lang="en">
<head>
    @include('seniorManager.css') <!-- Include your CSS files -->
</head>
<body>
<div class="main-wrapper">
    @include('seniorManager.sidebar') <!-- Include sidebar -->

    <div class="page-wrapper">
        @include('seniorManager.header') <!-- Include header -->

        <div class="page-content" style="margin-left:100px">
            <div class="col-md-8 col-xl-9 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Edit Project Plan</h6>
                                <form class="forms-sample" id="project-plan-form" method="POST">
                                    @csrf
                                    @method('PATCH') <!-- Use PUT method for updating -->

                                    <div class="mb-3">
                                        <label class="form-label">Project Name</label>
                                        <input type="text" class="form-control" value="{{ $project->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Plan Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $projectPlan->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" rows="8" readonly>{{ $projectPlan->description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" value="{{ $projectPlan->start_date }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deadline</label>
                                        <input type="date" class="form-control" name="deadline" value="{{ $projectPlan->deadline }}" readonly>
                                    </div>
                                    <a href="{{ url('View_project_Details_with_project_plan',$project->id ) }}" class="btn btn-success">Go Back</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('seniorManager.footer') <!-- Include footer -->
    </div>
</div>

@include('seniorManager.js') <!-- Include your JS files -->
</body>
</html>
