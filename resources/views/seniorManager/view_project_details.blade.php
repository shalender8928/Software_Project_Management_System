<!DOCTYPE html>
<html lang="en">

@include('seniorManager.css')

<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
@include('seniorManager.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('seniorManager.header')  


         <div class="page-content"  style="margin-left:100px">
           
         <div class="row profile-body">
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-9 middle-wrapper">
                <div class="row"> 
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">View Project Details</h6>
                             
                                    <!-- Display project details -->
                                    
                                    

                                    <div class="mb-3">
                                        <label class="form-label">Project Name</label>
                                        <input type="text" class="form-control" id="project_name" name="project_name" value="{{ $project->project_name }}" required>
                                      
                                    </div>
                                    <!-- description -->
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description">{{ $project->description }}</textarea>
</div>
<!-- status -->
<div class="mb-3">
    <label for="status">Status:</label>
    <input type="text" class="form-control" id="status" name="status" value="{{ $project->status }}" required>
</div>
<!-- deadline -->
<div class="mb-3">
    <label for="deadline" class="form-label">Deadline</label>
    <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $project->deadline }}" required>
</div>
<!-- start_date -->
<div class="mb-3">
    <label for="start_date">Start Date:</label>
    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $project->start_date }}" required>
</div>
<!-- end_date -->
<div class="mb-3">
    <label for="end_date">End Date:</label>
    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}" required>
</div>
<!-- category_id -->
<div class="mb-3">
    <label for="category_id">Category</label>
    <input type="text" class="form-control" id="category_id" name="category_id" value="{{ $project->category_id }}" required>
</div>

        
                                <a class="btn btn-secondary" href="{{ route('seniorManager.view_project_list') }}">Back</a>

                                
                                
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <div class="d-none d-xl-block col-xl-3">
                <div class="row">
                </div> 
            </div>
            <!-- right wrapper end -->
        </div>




         
         </div>
         



      
         <!-- partial:partials/_footer.html -->

    @include('seniorManager.footer') 

      <!-- partial -->
    </div>

  </div>

  <!-- core:js -->
  @include('seniorManager.js')

</body>
</html>