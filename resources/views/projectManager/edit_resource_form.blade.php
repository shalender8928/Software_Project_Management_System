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
                                <h6 class="card-title">Edit Project Resource</h6>

                                <form class="forms-sample" method="POST" action="{{ url('update_project_resource', $resource->id) }}">
                                    @csrf
                                    @method('PATCH')
                                
                                    <!-- Project Plan Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Project Plan Name</label>
                                        <input type="text" class="form-control" value="{{ $projectPlan->name }}" readonly>
                                    </div>
                                
                                    <!-- Resource Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Resource Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $resource->name }}" required>
                                    </div>
                                
                                    <!-- Resource Type -->
                                    <div class="mb-3">
                                        <label class="form-label">Resource Type</label>
                                        <select class="form-control" name="type" required>
                                            <option value="material" {{ $resource->type == 'material' ? 'selected' : '' }}>Material</option>
                                            <option value="labor" {{ $resource->type == 'labor' ? 'selected' : '' }}>Labor</option>
                                            <option value="equipment" {{ $resource->type == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                            <option value="consultant" {{ $resource->type == 'consultant' ? 'selected' : '' }}>Consultant</option>
                                        </select>
                                    </div>
                                
                                    <!-- Cost Per Unit -->
                                    <div class="mb-3">
                                        <label class="form-label">Cost Per Unit</label>
                                        <input type="number" class="form-control" name="cost_per_unit" value="{{ $resource->cost_per_unit }}" required>
                                    </div>
                                
                                    <!-- Availability -->
                                    <div class="mb-3">
                                        <label class="form-label">Availability</label>
                                        <input type="number" class="form-control" name="availability" value="{{ $resource->availability }}" required>
                                    </div>
                                
                                    <!-- Submit and Cancel buttons -->
                                    <button type="submit" class="btn btn-primary me-2">Update Resource</button>
                                    <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                    <a href="{{ url('select_project_plan', $project->id) }}" class="btn btn-success">Go Back</a>
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
