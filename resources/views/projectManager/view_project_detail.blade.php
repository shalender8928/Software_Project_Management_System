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

    <div class="page-content"  style="margin-left:100px">
      <div class="row profile-body">
        
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-9 middle-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                  <h6 class="card-title">Update Project</h6>

                  <form class="forms-sample">
                
                    <!-- Project Name -->
                    <div class="mb-3">
                      <label class="form-label">Project Name</label>
                      <input type="text" class="form-control" value="{{ $project->name }}" readonly>
                      @error('project_name')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                      <label class="form-label">Description</label>
                      <textarea rows="4" class="form-control" readonly>{{ $project->description }}</textarea>
                      @error('description')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                      <label class="form-label">Category</label>
                      <input type="text" class="form-control" value="{{ $project->category->cat_name }}" readonly>
                      @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Start Date -->
                    <div class="mb-3">
                      <label class="form-label">Start Date</label>
                      <input type="date" class="form-control" value="{{ $project->start_date }}" readonly>
                      @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Deadline -->
                    <div class="mb-3">
                      <label class="form-label">Deadline</label>
                      <input type="date" class="form-control" value="{{ $project->deadline }}" readonly>
                      @error('deadline')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Created By -->
                    <div class="mb-3">
                      <label class="form-label">Created By</label>
                      <input type="text" class="form-control" value="{{ $project->creator->firstname }}" readonly>
                      @error('created_by')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Updated By -->
                    <div class="mb-3">
                      <label class="form-label">Updated By</label>
                      <input type="text" class="form-control" value="{{ $project->updater->firstname }}" readonly>
                      @error('updated_by')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                      <label class="form-label">Status</label>
                      <input type="text" class="form-control" value="{{ $project->status }}" readonly>
                      @error('status')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Created At -->
                    <div class="mb-3">
                      <label class="form-label">Created At</label>
                      <input type="text" class="form-control" value="{{ $project->created_at }}" readonly>
                      @error('created_at')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Updated At -->
                    <div class="mb-3">
                      <label class="form-label">Updated At</label>
                      <input type="text" class="form-control" value="{{ $project->updated_at }}" readonly>
                      @error('updated_at')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <a href="{{url('update_project',$project->id)}}" class="btn btn-primary me-2">Edit</a>
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
