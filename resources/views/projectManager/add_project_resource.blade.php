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
                                    <h6 class="card-title">Add Project Resource</h6>
                                    <form class="forms-sample" method="POST" action="{{ url('store_project_resource') }}">
                                        @csrf

                                        <!-- Hidden field for plan_id -->
                                        <input type="hidden" name="plan_id" value="{{ $projectPlan->id }}">

                                        <div class="mb-3">
                                            <label class="form-label">Project Plan Name</label>
                                            <input class="form-control" type="text" value="{{ $projectPlan->name }}" readonly>
                                        </div>

                                        <!-- Resource Name field -->
                                        <div class="mb-3">
                                            <label class="form-label">Resource Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>

                                        <!-- Type field -->
                                        <div class="mb-3">
                                            <label class="form-label">Type</label>
                                            <select class="form-control" name="type" required>
                                                <option value="material">Select Project Resource</option>
                                                <option value="material">Material</option>
                                                <option value="labor">Labor</option>
                                                <option value="equipment">Equipment</option>
                                                <option value="consultant">Consultant</option>
                                            </select>
                                        </div>

                                        <!-- Cost per Unit field -->
                                        <div class="mb-3">
                                            <label class="form-label">Cost per Unit</label>
                                            <input type="number" class="form-control" name="cost_per_unit" step="0.01" required>
                                        </div>

                                        <!-- Availability field -->
                                        <div class="mb-3">
                                            <label class="form-label">Availability</label>
                                            <input type="number" class="form-control" name="availability" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Click <span style="color: brown; font-weight:bolder">Go to Deliverables</span> if Resources have been added before</label>
                                        </div>

                                        <!-- Submit and Cancel buttons -->
                                        <button type="submit" class="btn btn-primary me-2">Add Resource</button>
                                        <a href="{{ url('go_to_milestones', $projectPlan->id) }}" class="btn btn-success">Go to Milestones</a>
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
