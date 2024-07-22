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

<link rel="shortcut icon" href="{{asset('./assets/images/favicon.png.')}}" />
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
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-9 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Create New Project</h6>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <form class="forms-sample" method="POST" action="{{ route('projectmanager.add_new_project') }}">
                                    @csrf
                                    <!-- project Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Project Name</label>
                                        <input type="text" class="form-control" id="project_name" name="project_name" required>
                                        @error('project_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- status -->
                                    <div class="mb-3">
                                        <label for="status">Status:</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="pending">Pending</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- deadline -->
                                    <div class="mb-3">
                                        <label for="deadline" class="form-label">Deadline</label>
                                        <input type="date" class="form-control" id="deadline" name="deadline" required>
                                        @error('deadline')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- start_date -->
                                    <div class="mb-3">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                        @error('start_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- end_date -->
                                    <div class="mb-3">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                        @error('end_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- category_id -->
                                    <div class="mb-3">
                                    <label for="category_id">Category</label>
    <select class="form-control" id="category_id" name="category_id" required>
        <option value="" disabled selected>Select a category</option>
        <option value="website">Website</option>
        <option value="mobile_app">Mobile App</option>
        <option value="graphics_design">Graphics Design</option>
        <option value="java">Java</option>
        <option value="ai">AI</option>
    </select>
    @error('category_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
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
