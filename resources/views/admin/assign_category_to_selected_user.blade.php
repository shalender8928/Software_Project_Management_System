<!DOCTYPE html>
<html lang="en">

@include('admin.css')

<style>
    .combo-box {
    appearance: none; /* For modern browsers */
    -webkit-appearance: none; /* For Safari and Chrome */
    -moz-appearance: none; /* For Firefox */
    color: #fff; /* Ensure the background is white */
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMiAxMCIgd2lkdGg9IjEyIiBoZWlnaHQ9IjEwIj4gPHBhdGggZD0iTTEwLjE1LDIuNjZsLTQuNTQsNC41NGMtMC4yNywwLjI3LTAuNzEsMC4yNy0xLDAsMCwwLDAsMC0uMDAxLS4wMDFMLDEuNjdDNC41NCwyLjM5LDQuOTgsMi4zOSw1LjI1LDIuNjZsNC41NCw0LjU0QzEwLjQyLDIuMzksMTAuODUsMi4zOSwxMC4xNSwyLjY2eiIgZmlsbD0id2hpdGUiIC8+IDwvc3ZnPg==');
    background-repeat: no-repeat;
    background-position: right 10px center;
    padding-right: 20px; /* To ensure the text does not overlap with the arrow */
}

</style>
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
      
                                      <h6 class="card-title">Assign Category to user: <span style="color: aqua">{{$user->firstname}} {{$user->lastname}}</span></h6>
      
                                      <form method="POST" action="{{ url('assign_category_post', $user->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstname" value="{{ $user->firstname }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" value="{{ $user->email }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <input type="text" class="form-control" id="role" value="{{ $user->getRoleNames()->first() }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Select Category</label>
                                            <select class="form-control combo-box" id="category" name="category" required>
                                                <option value="" disabled selected>Select Category by clicking here </option>
                                                @foreach($category as $categories)
                                                    <option value="{{ $categories->id }}">{{ $categories->cat_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Assign Category</button>
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

