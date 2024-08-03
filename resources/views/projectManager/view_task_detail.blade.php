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
                  
                  <h6 class="card-title">Task Details</h6>

                  <form class="forms-sample">
                    
                    <!-- Task Name -->
                    <div class="mb-3">
                      <label class="form-label">Task Name</label>
                      <input type="text" class="form-control" value="{{ $task->name }}" readonly>
                    </div>

                    <!-- Project -->
                    <div class="mb-3">
                      <label class="form-label">Project</label>
                      <input type="text" class="form-control" value="{{ $task->project ? $task->project->name : 'N/A' }}" readonly>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                      <label class="form-label">Description</label>
                      <textarea rows="4" class="form-control" readonly>{{ $task->description }}</textarea>
                    </div>

                    <!-- Start Date -->
                    <div class="mb-3">
                      <label class="form-label">Start Date</label>
                      <input type="date" class="form-control" value="{{ $task->start_date }}" readonly>
                    </div>

                    <!-- Deadline -->
                    <div class="mb-3">
                      <label class="form-label">Deadline</label>
                      <input type="date" class="form-control" value="{{ $task->deadline }}" readonly>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                      <label class="form-label">Status</label>
                      <input type="text" class="form-control" value="{{ $task->status }}" readonly>
                    </div>

                    <!-- Progress -->
                    <div class="mb-3">
                      <label class="form-label">Progress</label>
                      <input type="text" class="form-control" value="{{ $task->completion }}%" readonly>
                    </div>

                    <!-- Created By -->
                    <div class="mb-3">
                      <label class="form-label">Created By</label>
                      <input type="text" class="form-control" value="{{ $task->created_by ? $task->creator->firstname : 'N/A' }}" readonly>
                    </div>

                    <!-- Updated By -->
                    <div class="mb-3">
                      <label class="form-label">Updated By</label>
                      <input type="text" class="form-control" value="{{ $task->updated_by ? $task->updater->firstname : 'N/A' }}" readonly>
                    </div>

                    <!-- Created At -->
                    <div class="mb-3">
                      <label class="form-label">Created At</label>
                      <input type="text" class="form-control" value="{{ $task->created_at }}" readonly>
                    </div>

                    <!-- Updated At -->
                    <div class="mb-3">
                      <label class="form-label">Updated At</label>
                      <input type="text" class="form-control" value="{{ $task->updated_at }}" readonly>
                    </div>

                    <a href="{{url('update_task', $task->id)}}" class="btn btn-primary me-2">Edit</a>
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
