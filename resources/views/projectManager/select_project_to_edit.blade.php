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
                        <a class="btn btn-primary" href="{{url('edit_project',$datas->id)}}">Select</a>
                      </td>

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

</body>
</html>    

