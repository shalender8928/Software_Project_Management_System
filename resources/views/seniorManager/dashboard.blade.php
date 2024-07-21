<!DOCTYPE html>
<html lang="en">
<head>
 @include('seniorManager.css')
</head>
<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('seniorManager.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('seniorManager.header')  
         
         
         @include('seniorManager.index')
			<!-- partial:partials/_footer.html -->
		@include('seniorManager.footer')  
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	@include('seniorManager.js')

</body>
</html>    

