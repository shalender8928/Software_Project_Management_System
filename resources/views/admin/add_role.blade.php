<!DOCTYPE html>
<html lang="en">

@include('admin.css')
<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('admin.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('admin.header')  
         
		 <div class="page-content"  style="margin-left:100px">
            <div class="row profile-body">
                
                <!-- left wrapper end -->
                <!-- middle wrapper start -->
                <div class="col-md-8 col-xl-9 middle-wrapper">
                  <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
      
                                      <h6 class="card-title">Add New Role</h6>
      
                                      <form class="forms-sample" method="POST" action="{{url('create_role')}}">
										@csrf
									
										<!-- Role  Name -->
										<div class="mb-3">
											<label for="name" class="form-label">Role Name</label>
											<input type="text" class="form-control" id="name" name="name" required>
											@error('name')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
										<button type="submit" class="btn btn-primary me-2">Create</button>
										<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
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
            
                 </div> 
                </div>
                <!-- right wrapper end -->
              </div>
         </div>
     

		@include('admin.footer')  
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	@include('admin.js')

</body>
</html>    

