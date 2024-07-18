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


         <div class="page-content"  style="margin-left:100px">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th class="pt-0">S. NO</th>
                        <th class="pt-0">Category Name</th>
                        <th class="pt-0">Description</th>
                        <th class="pt-0">Created By</th>
                        <th class="pt-0">Updated By</th>
                        <th class="pt-0">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $count = 0;
                      @endphp
                      @foreach($data as $datas)
                      @php
                          $count++;
                      @endphp
                      <tr>
                        <td>{{$count}}</td>
                        <td>{{$datas->cat_name}}</td>
                        <td>{!! Str::limit($datas->description,30)!!}</td>
                        <td>{{ $datas->creator ? $datas->creator->firstname : 'N/A' }}</td>
                        <td>{{ $datas->updater ? $datas->updater->firstname : 'N/A'}}</td>
                        <td>
                            <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_pro_category',$datas->id)}}">Delete</a>
                          
  
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
         </div>
         
			<!-- partial:partials/_footer.html -->
		@include('admin.footer')  
			<!-- partial -->
		</div>
	</div>

	<!-- core:js -->
	@include('admin.js')
    <script>
		function confirmation(ev) {
			ev.preventDefault();
			var urlToRedirect = ev.currentTarget.getAttribute('href');
			console.log(urlToRedirect);
		
			swal({
				title: "Are you sure you want to delete this Employee ?",
				text: "This action will be permanent.",
				icon: "error",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location.href = urlToRedirect;
				}
			});
		}
		</script>

</body>
</html>    

