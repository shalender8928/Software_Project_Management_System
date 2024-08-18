<!DOCTYPE html>
<html lang="en">
<head>
@include('projectManager.css')
</head>
<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('projectManager.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('projectManager.header')  
         
         
         @include('projectManager.index')
			<!-- partial:partials/_footer.html -->
		@include('projectManager.footer')  
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	@include('projectManager.js')

</body>
</html>    

