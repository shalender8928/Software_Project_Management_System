<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>NobleUI - HTML Bootstrap 5 Admin Dashboard Template</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('../assets/vendors/core/core.css')}}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{asset('../assets/vendors/flatpickr/flatpickr.min.css')}}">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('../assets/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('../assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{asset('../assets/css/demo2/style.css')}}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{asset('./assets/images/favicon.png')}}" />
</head>
<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('projectManager.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
	@include('projectManager.header')

         
         
            
	<div class="page-content" style="margin-left:100px">
        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-9 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Create Tasks</h6>
<!-- Project Name -->
<div class="mb-3">
    <label for="project_name" class="form-label">Project Name</label>
    <input type="text" class="form-control" id="project_name" name="project_name" value="{{ $task->project_name }}" required>
    @error('project_name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Task Description -->
<div class="mb-3">
    <label for="task_description" class="form-label">Task Description</label>
    <textarea rows="4" class="form-control" id="task_description" name="task_description" required>{{ $task->task_description }}</textarea>
    @error('task_description')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Priority -->
<div class="mb-3">
    <label for="priority" class="form-label">Priority</label>
    <input type="text" class="form-control" id="priority" name="priority" value="{{ $task->priority }}" required>
    @error('priority')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Assign To -->
<div class="mb-3">
    <label for="assign_to" class="form-label">Assign To</label>
    <input type="text" class="form-control" id="assign_to" name="assign_to" value="{{ $task->assign_to }}" required>
    @error('assign_to')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Deadline -->
<div class="mb-3">
    <label for="deadline" class="form-label">Deadline</label>
    <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $task->deadline }}" required>
    @error('deadline')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Start Date -->
<div class="mb-3">
    <label for="start_date" class="form-label">Start Date</label>
    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $task->start_date }}" required>
    @error('start_date')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- End Date -->
<div class="mb-3">
    <label for="end_date" class="form-label">End Date</label>
    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $task->end_date }}" required>
    @error('end_date')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

                                    <a class="btn btn-primary" href="{{ url('update_assigntask', $task->id) }}">Edit</a>
                                    <a class="btn btn-secondary" href="{{ route('projectmanager.view_task_list') }}">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <div class="d-none d-xl-block col-xl-3">
                <div class="row">
                    <!-- Right wrapper content if any -->
                </div>
            </div>
            <!-- right wrapper end -->
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
