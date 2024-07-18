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
      
                                      <h6 class="card-title">Register New Employee</h6>
      
                                      <form class="forms-sample" method="POST" action="{{url('register_employee')}}">
										@csrf
									
										<!-- First Name -->
										<div class="mb-3">
											<label for="firstname" class="form-label">First Name</label>
											<input type="text" class="form-control" id="firstname" name="firstname" required>
											@error('firstname')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- Last Name -->
										<div class="mb-3">
											<label for="lastname" class="form-label">Last Name</label>
											<input type="text" class="form-control" id="lastname" name="lastname" required>
											@error('lastname')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- Email -->
										<div class="mb-3">
											<label for="email" class="form-label">Email</label>
											<input type="email" class="form-control" id="email" name="email" required>
											@error('email')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- Password -->
										<div class="mb-3">
											<label for="password" class="form-label">Password</label>
											<input type="password" class="form-control" id="password" name="password" required>
											@error('password')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>

										 <!-- Confirm Password -->
										<div class="mb-3">
											<label for="password_confirmation" class="form-label">Confirm Password</label>
											<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
											@error('password_confirmation')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- Phone -->
										<div class="mb-3">
											<label for="phone" class="form-label">Phone</label>
											<input type="text" class="form-control" id="phone" name="phone" required>
											@error('phone')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- Gender -->
										<div class="mb-3">
											<label for="gender" class="form-label">Gender</label>
											<input type="text" class="form-control" id="gender" name="gender" required>
											@error('gender')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- Age -->
										<div class="mb-3">
											<label for="age" class="form-label">Age</label>
											<input type="number" class="form-control" id="age" name="age" required>
											@error('age')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- Street -->
										<div class="mb-3">
											<label for="street" class="form-label">Street</label>
											<input type="text" class="form-control" id="street" name="street" >
											@error('street')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- City -->
										<div class="mb-3">
											<label for="city" class="form-label">City</label>
											<input type="text" class="form-control" id="city" name="city" >
											@error('city')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- State -->
										<div class="mb-3">
											<label for="state" class="form-label">State</label>
											<input type="text" class="form-control" id="state" name="state" >
											@error('state')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- Zip Code -->
										<div class="mb-3">
											<label for="zip_code" class="form-label">Zip Code</label>
											<input type="text" class="form-control" id="zip_code" name="zip_code" >
											@error('zip_code')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<!-- Country -->
										<div class="mb-3">
											<label for="country" class="form-label">Country</label>
											<input type="text" class="form-control" id="country" name="country" >
											@error('country')
												<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									
										<button type="submit" class="btn btn-primary me-2">Register</button>
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

