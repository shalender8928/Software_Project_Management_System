<!DOCTYPE html>
<html lang="en">
  @include('projectManager.css')

<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('projectManager.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('projectManager.header')  


         <div class="page-content"  style="margin-left:100px">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th class="pt-0">S. NO</th>
                      <th class="pt-0">Project Name</th>
                      <th class="pt-0">Category</th>
                      <th class="pt-0">Description</th>
                      <th class="pt-0">Start Date</th>
                      <th class="pt-0">Deadline</th>
                      <th class="pt-0">Status</th>
                      <th class="pt-0">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $count = 0;
                    @endphp
                    @foreach($project as $datas)
                    @php
                        $count++;
                    @endphp
                    <tr>
                      <td>{{$count}}</td>
                      <td>{{$datas->name}}</td>
                      <td>{{$datas->category->cat_name}}</td>
                      <td>{!! Str::limit($datas->description,20)!!}</td>
                      <td>{{$datas->start_date}}</td>
                      <td>{{$datas->deadline}}</td>
                      <td>{{$datas->status}}</td>

                      <td>
                        <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_project_post',$datas->id)}}">Delete</a>
                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
         </div>
         
			<!-- partial:partials/_footer.html -->
		@include('projectManager.footer')  
			<!-- partial -->
		</div>
	</div>

	<!-- core:js -->
	@include('projectManager.js')

    <script>
		function confirmation(ev) {
			ev.preventDefault();
			var urlToRedirect = ev.currentTarget.getAttribute('href');
			console.log(urlToRedirect);
		
			swal({
				title: "Are you sure you want to delete this Project ?",
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

