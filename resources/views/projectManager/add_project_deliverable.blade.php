<!DOCTYPE html>
<html lang="en">
<head>
    @include('projectManager.css') <!-- Include your CSS files -->
</head>
<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        @include('projectManager.sidebar') <!-- Include sidebar -->

        <div class="page-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('projectManager.header') <!-- Include header -->

            <div class="page-content" style="margin-left:100px">
                <div class="col-md-8 col-xl-9 middle-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Add Project Deliverable</h6>
                                    <form class="forms-sample" method="POST" action="{{ url('store_project_deliverable') }}">
                                        @csrf

                                        <!-- Hidden field for plan_id -->
                                        <input type="hidden" name="plan_id" value="{{ $projectPlan->id }}">

                                        <div class="mb-3">
                                            <label class="form-label">Project Plan Name</label>
                                            <input class="form-control" type="text" value="{{ $projectPlan->name }}" readonly>
                                        </div>

                                        <!-- Deliverable Name field -->
                                        <div class="mb-3">
                                            <label class="form-label">Deliverable Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>

                                        <!-- Description field -->
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" rows="5" required></textarea>
                                        </div>

                                        <!-- Deadline field -->
                                        <div class="mb-3">
                                            <label class="form-label">Deadline</label>
                                            <input type="date" class="form-control" name="deadline" required>
                                        </div>

                                        

                                        <div class="mb-3">
                                            <label class="form-label">Click <span style="color: brown; font-weight:bolder">Go to Dependencies</span> if Deliverable has been added before</label>
                                        </div>

                                        <!-- Submit and Cancel buttons -->
                                        <button type="submit" class="btn btn-primary me-2">Add Deliverable</button>
                                        <a href="{{ url('go_to_dependencies', $projectPlan->id) }}" class="btn btn-success">Go to Dependencies</a>
                                        <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- partial:partials/_footer.html -->
            @include('projectManager.footer') <!-- Include footer -->
        </div>
    </div>

    <!-- core:js -->
    @include('projectManager.js') <!-- Include your JS files -->
</body>
</html>
