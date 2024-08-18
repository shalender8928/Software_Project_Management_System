<!DOCTYPE html>
<html lang="en">
<head>
    @include('projectManager.css')
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
                                <h6 class="card-title">Edit Project Milestone</h6>

                                <form class="forms-sample" method="POST" action="{{ url('update_project_milestone', $milestone->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <!-- Project Plan Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Project Plan Name</label>
                                        <input type="text" class="form-control" value="{{ $projectPlan->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deliverable Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $milestone->name }}" required>
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" rows="8" required>{{ $milestone->description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deadline</label>
                                        <input type="date" class="form-control" name="deadline" value="{{ $milestone->deadline }}" required>
                                    </div>

                                    <!-- Submit and Cancel buttons -->
                                    <button type="submit" class="btn btn-primary me-2">Update deliverable</button>
                                    <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
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
