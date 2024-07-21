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
             
                 
             <div class="page-content" style="margin-left:100px">
         
                <div class="row profile-body">
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
                                                <label class="form-label">Category Name</label>
                                                <input type="text" class="form-control" value="{{ $data->cat_name }}" readonly>
                                            </div>
                                            <!-- Last Name -->
                                            <div class="mb-2">
                                                <label class="form-label">Description</label>
                                                <textarea rows="4" class="form-control" readonly>{{ $data->description }}</textarea>

                                            </div>

                                            <!-- Created By -->
                                            <div class="mb-2">
                                                <label class="form-label">Created By</label>
                                                <input type="text" class="form-control" value="{{ $data->creator->firstname }}" readonly>
                                            </div>

                                            <!-- Updated By -->

                                            <div class="mb-2">
                                                <label class="form-label">Updated By</label>
                                                <input type="text" class="form-control" value="{{ $data->updater->firstname }}" readonly>
                                            </div>
                                            
                                            <a  class="btn btn-primary" href="{{url('update_category',$data->id)}}">Edit</a>
                                             <a class="btn btn-secondary" href="{{ route('admin.view_category_list') }}">Back</a>
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

