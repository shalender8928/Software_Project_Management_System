<!DOCTYPE html>
<html lang="en">
<head>
    @include('seniorManager.css')
</head>
<body>
<div class="main-wrapper">

    <!-- Include sidebar -->
    @include('seniorManager.sidebar')

    <div class="page-wrapper">
        <!-- Include header -->
        @include('seniorManager.header')

        <div class="page-content" style="margin-left:100px">
            <div class="col-md-8 col-xl-9 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">View Project Scope</h6>

                                <form class="forms-sample" method="POST" action="{{ url('update_project_scope', $scope->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <!-- Project Plan Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Project Plan Name</label>
                                        <input type="text" class="form-control" value="{{ $projectPlan->name }}" readonly>
                                    </div>


                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" rows="8" readonly>{{ $scope->description }}</textarea>
                                    </div>

                                    <a href="{{ url('View_project_Details_with_project_plan',$project->id ) }}" class="btn btn-success">Go Back</a>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include footer -->
        @include('seniorManager.footer')
    </div>
</div>

<!-- Include JS files -->
@include('seniorManager.js')

</body>
</html>
