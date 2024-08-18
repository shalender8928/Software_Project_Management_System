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
         

         <!-- partial -->
             
                 
             <div class="page-content">
         
                 <div class="row">
                   
                 </div>
                 <div class="row profile-body">
                   <!-- left wrapper start -->
                   <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                     <div class="card rounded">
                       <div class="card-body">
                        <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                            <div class="mb-2">
                            <a href="{{ url('admin_image_edit') }}">
                          <img id="profile-image" class="wd-250 ht-250 rounded-circle" src="{{ asset('images/' . Auth::user()->image) }}" alt="">
                           </a>
                            </div>
                            <div class="text-center">
                                <p class="tx-16 fw-bolder">{{(Auth::user() -> firstname)}}</p>
                                <p class="tx-12 text-muted">{{(Auth::user() -> email)}}</p>
                                <br>
                                <p class="tx-14 fw-bolder">Profile Details</p>
                            </div>
                        </div>
                       </div>
                     </div>
                   </div>
                   <!-- left wrapper end -->
                   <!-- middle wrapper start -->
                   <div class="col-md-8 col-xl-8 middle-wrapper">
                     <div class="row">
                     <div class="col-md-12 grid-margin stretch-card">
                     <div class="card">
                       <div class="card-body">
         
         
                                          <!-- Start of Change Password Form -->
                <div class="container">
                    <h2>Change Password</h2>
                    
                    <form method="POST" action="{{ url('update_changee_password_admin') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                            @if($errors->has('current_password'))
                                <span class="text-danger">{{ $errors->first('current_password') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            @if($errors->has('new_password'))
                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; font-size: 16px; border-radius: 5px; cursor: pointer; margin-top: 20px; display: block; margin-left: auto; margin-right: auto;">Change Password</button>


                        
                    </form>
                </div>
                <!-- End of Change Password Form -->
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

