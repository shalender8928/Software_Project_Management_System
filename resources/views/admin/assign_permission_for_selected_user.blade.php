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


         <div class="page-content" style="margin-left:100px">
            
            <h4 class="card-title">Assign Permission to <span style="color: aqua">{{$user->firstname}} {{$user->lastname}}</span></h4>
            <form action="{{ url('update_permissions_for_selected_user', $user->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="col-md-4 mb-3">

                        <label for="role">Role</label>
                        <input type="text" id="role" class="form-control" value="{{ $user->roles->first() ? $user->roles->first()->name : 'No role assigned' }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 mb-3">

                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" value="{{ $user->firstname . ' ' . $user->lastname }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 mb-3">
                        <label for="permissions">Select Permissions to Assign</label>
                    </div>
                    
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-4 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}"
                                        {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $permission->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Assign Permissions</button>
            </form>

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
