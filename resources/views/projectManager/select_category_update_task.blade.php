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
                      <th class="pt-0">Category Name</th>
                      <th class="pt-0">Description</th>
                      <th class="pt-0">Select Project Category</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $count = 0;
                    @endphp
                    @foreach($category as $datas)
                    @php
                        $count++;
                    @endphp
                    <tr>
                      <td>{{$count}}</td>
                      <td>{{$datas->cat_name}}</td>
                      <td>{!! Str::limit($datas->description,30)!!}</td>
                      <td>
                        <a class="btn btn-primary" href="{{url('select_project_to_update_assigned_task',$datas->id)}}">Select</a>
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

</body>
</html>    

