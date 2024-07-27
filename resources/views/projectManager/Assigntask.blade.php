<!DOCTYPE html>
<html lang="en">
  
@include('projectManager.css')
     
<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('projectManager.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
	@include('projectManager.header')

         
         
            
	<div class="page-content" style="margin-left:100px">
        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-9 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Create Tasks</h6>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <form class="forms-sample" method="POST" action="{{ route('ProjectManager.storeTask') }}" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Project Name -->
                                    <div class="mb-3">
    <label for="project_name" class="form-label">Project Name</label>
    <select class="form-control" id="project_name" name="project_name" required>
        @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
        @endforeach
    </select>
    @error('project_name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

                                    <!-- Task Description -->
                                    <div class="mb-3">
                                        <label for="task_description" class="form-label">Task Description</label>
                                        <textarea rows="4" class="form-control" id="task_description" name="task_description" required></textarea>
                                        @error('task_description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Priority -->
                                    <div class="mb-3">
                                        <label for="priority" class="form-label">Priority</label>
                                        <input type="text" class="form-control" id="priority" name="priority" required>
                                        @error('priority')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Project ID -->
                            

                                    <!-- Assign To -->
                                    <div class="mb-3">
                                        <label for="assign_to" class="form-label">Assign To</label>
                                        <input type="text" class="form-control" id="assign_to" name="assign_to" required>
                                        @error('assign_to')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Deadline -->
                                    <div class="mb-3">
                                        <label for="deadline" class="form-label">Deadline</label>
                                        <input type="date" class="form-control" id="deadline" name="deadline" required>
                                        @error('deadline')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Start Date -->
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                        @error('start_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- End Date -->
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                        @error('end_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2">Create Task</button>
                                    <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <div class="d-none d-xl-block col-xl-3">
                <div class="row">
                    <!-- Right wrapper content if any -->
                </div>
            </div>
            <!-- right wrapper end -->
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
