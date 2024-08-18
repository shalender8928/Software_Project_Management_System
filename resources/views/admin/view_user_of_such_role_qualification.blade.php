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
                            <th class="pt-0">Role Name</th>
                            <th class="pt-0">First Name</th>
                            <th class="pt-0">Last Name</th>
                            <th class="pt-0">Email</th>
                            <th class="pt-0">Phone</th>
                            <th class="pt-0">Assign Qualification</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 0;
                        @endphp
                        @foreach($employees as $employee)
                        @php
                            $count++;
                        @endphp
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $employee->firstname }}</td>
                            <td>{{ $employee->lastname }}</td>

                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>


                            <td>
                                <a class="btn btn-success" href="{{url('assign_qualifiaction_for_selected_user',$employee->id)}}">Assign</a>
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

