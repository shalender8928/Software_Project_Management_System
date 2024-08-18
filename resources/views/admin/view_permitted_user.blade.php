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
                            <th class="pt-0">Permission Name</th>
                            <th class="pt-0">First Name</th>
                            <th class="pt-0">Last Name</th>
                            <th class="pt-0">Email</th>
                            <th class="pt-0">Phone</th>
                            <th class="pt-0">Update/Assign Permission</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 0;
                        @endphp
                        @foreach($users as $user)
                        @php
                            $count++;
                        @endphp
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $user->getRoleNames()->first() }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>


                            <td>
                                <a class="btn btn-success" href="{{url('assign_permission_for_selected_user',$user->id)}}">Update</a>
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

