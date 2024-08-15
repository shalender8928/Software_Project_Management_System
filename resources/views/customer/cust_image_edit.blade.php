<!DOCTYPE html>
<html lang="en">

  @include('customer.css')

<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('customer.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('customer.header')  


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
      
                                      <form class="forms-sample" method="POST" action="{{ url('update_developer_image', $data->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                          <img class="wd-150 ht-150 rounded-circle"  src="/images/{{$data->image}}"  alt="image not available">
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
                                        <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">Cancel</a>
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
		@include('customer.footer')  
			<!-- partial -->
		</div>
	</div>

	<!-- core:js -->
	@include('customer.js')

</body>
</html>    

