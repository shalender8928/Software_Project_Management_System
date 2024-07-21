<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <title>NobleUI - HTML Bootstrap 5 Admin Dashboard Template</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo2/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
=======
@include('developer.css')
>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee
</head>
<body>
<div class="main-wrapper">

<<<<<<< HEAD
    <!-- Sidebar -->
    @include('developer.sidebar')
    <!-- End Sidebar -->

    <div class="page-wrapper">

        <!-- Navbar -->
        @include('developer.header')
        <!-- End Navbar -->

        <div class="page-content" style="margin-left: 100px;">
            <div class="row profile-body">

                <!-- Middle Wrapper -->
                <div class="col-md-8 col-xl-9 middle-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <h6 class="card-title">Update Profile</h6>

                                    <form class="forms-sample" method="POST" action="{{ url('update_profile', $data->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

=======
<!-- partial:partials/_sidebar.html -->
   @include('developer.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('developer.header')  


         <div class="page-content"  style="margin-left:100px">
            <div class="row profile-body">
                
                <!-- left wrapper end -->
                <!-- middle wrapper start -->
                <div class="col-md-8 col-xl-9 middle-wrapper">
                  <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
      
                                      <h6 class="card-title">Update Profile</h6>
      
                                      <form class="forms-sample" method="POST" action="{{ url('update_profile', $data->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                            
>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee
                                        <!-- First Name -->
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $data->firstname }}" required>
                                            @error('firstname')
<<<<<<< HEAD
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

=======
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee
                                        <!-- Last Name -->
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $data->lastname }}" required>
                                            @error('lastname')
<<<<<<< HEAD
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

=======
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee
                                        <!-- Phone -->
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}" required>
                                            @error('phone')
<<<<<<< HEAD
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

=======
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee
                                        <!-- Gender -->
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender</label>
                                            <input type="text" class="form-control" id="gender" name="gender" value="{{ $data->gender }}" required>
                                            @error('gender')
<<<<<<< HEAD
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

=======
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee
                                        <!-- Age -->
                                        <div class="mb-3">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" value="{{ $data->age }}" required>
                                            @error('age')
<<<<<<< HEAD
                                            <div class="text-danger">{{ $message }}</div>
=======
                                                <div class="text-danger">{{ $message }}</div>
>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee
                                            @enderror
                                        </div>

                                        <div class="mb-3">
<<<<<<< HEAD
                                            <label for="img">Current Image :</label>
                                            <img class="wd-150 ht-150 rounded-circle" src="{{ asset('images/' . $data->image) }}" alt="Current Image">
                                        </div>

                                        <!-- New Image -->
=======
                                          <label for="img">Current Image :</label>
                                          <img class="wd-150 ht-150 rounded-circle"  src="/images/{{$data->image}}"  alt="image not available">
                                      </div>
                            
                                        <!--New Image -->
>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee
                                        <div class="mb-3">
                                            <label for="image" class="form-label">New Profile Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            @error('image')
<<<<<<< HEAD
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <a href="{{ route('developer.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Middle Wrapper -->

                <!-- Right Wrapper -->
                <div class="d-none d-xl-block col-xl-3">
                    <div class="row">
                        <!-- Optional Content for Right Sidebar -->
                    </div>
                </div>
                <!-- End Right Wrapper -->

            </div>
        </div>

        <!-- Footer -->
        @include('developer.footer')
        <!-- End Footer -->

    </div>
</div>

<!-- core:js -->
@include('developer.js')
<!-- End core:js -->

</body>
</html>
=======
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                            
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <a href="{{ route('developer.dashboard') }}" class="btn btn-secondary">Cancel</a>
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
		@include('developer.footer')  
			<!-- partial -->
		</div>
	</div>

	<!-- core:js -->
	@include('developer.js')

</body>
</html>    

>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee
