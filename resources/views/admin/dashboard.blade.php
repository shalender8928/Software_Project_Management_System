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
         
         
         @include('admin.index')
			<!-- partial:partials/_footer.html -->
		@include('admin.footer')  
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	@include('admin.js')

</body>
</html>    

