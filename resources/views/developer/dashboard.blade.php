<!DOCTYPE html>
<html lang="en">
<head>
 @include('developer.css')
</head>
<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('developer.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('developer.header')  
         
         
         @include('developer.index')
			<!-- partial:partials/_footer.html -->
		@include('developer.footer')  
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	@include('developer.js')

</body>
</html>    

