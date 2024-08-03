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
        
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-9 middle-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                  <h6 class="card-title">Create New Task</h6>

                  <form class="forms-sample" method="POST" action="{{ url('create_task_post') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Task Name -->
                    <div class="mb-3">
                      <label for="name" class="form-label">Task Name</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                      @error('name')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                      <textarea rows="4" class="form-control" id="description" name="description" required></textarea>
                      @error('description')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Project -->
                    <div class="mb-3">
                      <label for="project_id" class="form-label">Project</label>
                      <select class="form-control" id="project_id" name="project_id" required>
                        <option value="">Select Project by clicking here</option>
                        @foreach ($projects as $project)
                          <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                      </select>
                      @error('project_id')
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

                    <!-- Deadline -->
                    <div class="mb-3">
                      <label for="deadline" class="form-label">Deadline</label>
                      <input type="date" class="form-control" id="deadline" name="deadline" required>
                      @error('deadline')
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
            <!-- Add any additional content here -->
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
