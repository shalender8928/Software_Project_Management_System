<!DOCTYPE html>
<html lang="en">
<head>
@include('customer.css')
</head>
<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('customer.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('customer.header')  
         
         
         @include('customer.index')
			<!-- partial:partials/_footer.html -->
		@include('customer.footer')  
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	@include('customer.js')

</body>
</html>    

