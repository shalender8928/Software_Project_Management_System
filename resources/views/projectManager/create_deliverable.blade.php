<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Deliverable</title>
    @include('projectManager.css')
</head>
<body>
<div class="main-wrapper">
    @include('projectManager.sidebar')

    <div class="page-wrapper">
        @include('projectManager.header')

        <div class="page-content" style="margin-left:100px">
            <div class="row profile-body">
                <div class="col-md-8 col-xl-9 middle-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Create Deliverable</h6>
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form class="forms-sample" method="POST" action="{{ route('projectmanager.add_new_deliverable') }}">
                                        @csrf
                                        <div class="container">
                                            <div class="mb-3">
                                                <label class="form-label">Project Name</label>
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
                                                <label class="form-label">Deliverable Name</label>
                                                <input type="text" class="form-control" name="deliverableName" required>
                                                @error('deliverableName')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Deliverable Description</label>
                                                <textarea class="form-control" id="description" name="description"></textarea>
                                                @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="deadline">Deadline:</label>
                                                <input type="date" class="form-control" name="deadline" required>
                                                @error('deadline')
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
                
                <div class="d-none d-xl-block col-xl-3">
                    <!-- Optional Sidebar Content -->
                </div>
            </div>
        </div>
        @include('projectManager.footer')
    </div>
</div>
@include('projectManager.js')
</body>
</html>
