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
      
                                      <h6 class="card-title">Update Employee Profile</h6>
      
                                      <form class="forms-sample" method="POST" action="{{ url('update_employee_profile', $data->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                            
                                        <!-- First Name -->
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $data->firstname }}" required>
                                            @error('firstname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
                                        <!-- Last Name -->
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $data->lastname }}" required>
                                            @error('lastname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" required>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Phone -->
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}" required>
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
                                        <!-- Gender -->
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender</label>
                                            <input type="text" class="form-control" id="gender" name="gender" value="{{ $data->gender }}" required>
                                            @error('gender')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
                                        <!-- Age -->
                                        <div class="mb-3">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" value="{{ $data->age }}" required>
                                            @error('age')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                          <label for="img">Current Image :</label>
                                          <img class="wd-200 ht-200 rounded-circle"  src="/images/{{$data->image}}"  alt="image not available">
                                      </div>
                            
                                        <!--New Image -->
                                        <div class="mb-3">
                                            <label for="image" class="form-label">New Profile Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
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
         
			<!-- partial:partials/_footer.html -->
		@include('admin.footer')  
			<!-- partial -->
		</div>
	</div>

	<!-- core:js -->
	@include('admin.js')

</body>
</html>    

