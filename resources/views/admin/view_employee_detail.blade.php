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
                                <img class="wd-250 ht-250 rounded-circle" src="/images/{{$data->image}}" alt="">
                            </div>
                            <div class="text-center">
                                <p class="tx-16 fw-bolder">{{$data->firstname}}</p>
                                <p class="tx-12 text-muted">{{$data->email}}</p>
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
                                                <input type="text" class="form-control" value="{{ $data->firstname }}" readonly>
                                            </div>
                                            <!-- Last Name -->
                                            <div class="mb-2">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control"  value="{{ $data->lastname }}" readonly>
                                            </div>
                                            <!-- Phone -->
                                            <div class="mb-2">
                                                <label  class="form-label">Phone</label>
                                                <input type="text" class="form-control" value="{{ $data->phone }}" readonly>
                                            </div>

                                            <!-- Email -->

                                            <div class="mb-2">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control"  value="{{ $data->email }}" readonly>
                                            </div>
                                
                                            <!-- Gender -->
                                            <div class="mb-2">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control"  value="{{ $data->gender }}" readonly>
                                            </div>
                                
                                            <!-- Age -->
                                            <div class="mb-2">
                                                <label  class="form-label">Age</label>
                                                <input type="number" class="form-control"  value="{{ $data->age }}" readonly>
                                            </div>
                                            <a  class="btn btn-primary" href="{{url('update_employee',$data->id)}}">Edit</a>
                                             <a class="btn btn-secondary" href="{{ route('admin.view_employee_list') }}">Back</a>
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

