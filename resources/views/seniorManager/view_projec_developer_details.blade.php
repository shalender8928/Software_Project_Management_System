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
                                <img class="wd-250 ht-250 rounded-circle" src="/images/{{$developer->image}}" alt="">
                            </div>
                            <div class="text-center">
                                <p class="tx-16 fw-bolder">{{$developer->firstname}}</p>
                                <p class="tx-12 text-muted">{{$developer->email}}</p>
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
         
         
                                         <form class="forms-sample">
                                            
                                
                                            <!-- First Name -->
                                            <div class="mb-2">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="{{ $developer->firstname }} "readonly>
                                            </div>
                                            <!-- Last Name -->
                                            <div class="mb-2">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control"  value="{{ $developer->lastname }}" readonly>
                                            </div>
                                            <!-- Phone -->
                                            <div class="mb-2">
                                                <label  class="form-label">Phone</label>
                                                <input type="text" class="form-control" value="{{ $developer->phone }}" readonly>
                                            </div>

                                            <!-- Email -->

                                            <div class="mb-2">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control"  value="{{ $developer->email }}" readonly>
                                            </div>
                                
                                            <!-- Gender -->
                                            <div class="mb-2">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control"  value="{{ $developer->gender }}" readonly>
                                            </div>
                                
                                            <!-- Age -->
                                            <div class="mb-2">
                                                <label  class="form-label">Age</label>
                                                <input type="number" class="form-control"  value="{{ $developer ->age }}" readonly>
                                            </div>

                                            
                                        <!-- street -->
                                        @if($address)
                                        <div class="mb-2">
                                            <label class="form-label">Street</label>
                                            <input type="text" class="form-control" value="{{ $address->street }}" readonly>
                                        </div>

                                        <!-- city -->
                                        <div class="mb-2">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" value="{{ $address->city }}" readonly>
                                        </div>

                                        <!-- state -->
                                        <div class="mb-2">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" value="{{ $address->state }}" readonly>
                                        </div>

                                        <!-- zip_code -->
                                        <div class="mb-2">
                                            <label class="form-label">Zip code</label>
                                            <input type="number" class="form-control" value="{{ $address->zip_code }}" readonly>
                                        </div>

                                        <!-- country -->
                                        <div class="mb-2">
                                            <label class="form-label">Country</label>
                                            <input type="number" class="form-control" value="{{ $address->country }}" readonly>
                                        </div>
                                        @else
                                        <p class="text-danger">Address not available</p>
                                        @endif
 
                         <a class="btn btn-secondary" href="{{ route('seniorManager.view_list_developere') }}">Back</a>

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
		@include('seniorManager.footer')  
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	@include('seniorManager.js')

</body>
</html>    

