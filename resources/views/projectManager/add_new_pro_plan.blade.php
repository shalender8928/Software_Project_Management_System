<!DOCTYPE html>
<html lang="en">
<head>
    @include('projectManager.css')
</head>
<body>
<div class="main-wrapper">

    <!-- partial:partials/_sidebar.html -->
    @include('projectManager.sidebar')

    <!-- partial -->

    <div class="page-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('projectManager.header')  

        <div class="page-content" style="margin-left:100px">
            <div class="col-md-8 col-xl-9 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Create Project Plan</h6>
                                <form class="forms-sample" id="project-plan-form" method="POST" action="{{ url('create_project_plan') }}">
                                    @csrf

                                    <!-- Hidden Project ID -->
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">

                                    <div class="mb-3">
                                        <label class="form-label">Project Name</label>
                                        <input type="text" class="form-control" value="{{ $project->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Plan Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deadline</label>
                                        <input type="date" class="form-control" name="deadline" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Click <span style="color: brown ; font-weight:bolder">Go to Objective</span> if plan have been created before</label>
                                    </div>
                                    

                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a href="{{url('go_to_objective',$project->id)}}" class="btn btn-success">Go to Objective</a>
                                    <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- partial:partials/_footer.html -->
        @include('projectManager.footer')  
        <!-- partial -->
    </div>
</div>

<!-- core:js -->
@include('projectManager.js')

</body>
</html>
