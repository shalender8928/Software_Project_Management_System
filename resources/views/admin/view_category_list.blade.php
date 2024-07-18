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
                      <th class="pt-0">View Detail</th>
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
                      <td>{{ $datas->creator ? $datas->creator->firstname : 'N/A' }}</td>
                      <td>{{ $datas->updater ? $datas->updater->firstname : 'N/A'}}</td>

                      <td>
                        <a class="btn btn-secondary" href="{{url('view_category_detail',$datas->id)}}">View</a>
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

