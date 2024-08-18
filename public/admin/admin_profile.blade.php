 @extends('admin.admin_dashboard')

<!-- partial -->
@section('admin')




		<!-- partial -->
	
		
	<div class="page-content">

        <div class="row">
          
        </div>
        <div class="row profile-body">
          <!-- left wrapper start -->
          <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
            <div class="card rounded">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <h6 class="card-title mb-0">About</h6>
                  
                </div>
                <p>Hi! I'm Amiah the Senior UI Designer at NobleUI. We hope you enjoy the design and quality of Social.</p>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined:</label>
                  <p class="text-muted">November 15, 2015</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Lives:</label>
                  <p class="text-muted">New York, USA</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                  <p class="text-muted">me@nobleui.com</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
                  <p class="text-muted">www.nobleui.com</p>
                </div>
                <div class="mt-3 d-flex social-links">
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <i data-feather="github"></i>
                  </a>
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <i data-feather="twitter"></i>
                  </a>
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <i data-feather="instagram"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- left wrapper end -->
          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-9 middle-wrapper">
            <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">

								<h6 class="card-title">Update Profile</h6>

								<form class="forms-sample">
									<div class="mb-3">
										<label for="exampleInputUsername1" class="form-label">Username</label>
										<input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
									</div>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Email address</label>
										<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
									</div>
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Password</label>
										<input type="password" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Password">
									</div>
									<div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
										
									</div>
									<button type="submit" class="btn btn-primary me-2">Submit</button>
									<button class="btn btn-secondary">Cancel</button>
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
		@endsection