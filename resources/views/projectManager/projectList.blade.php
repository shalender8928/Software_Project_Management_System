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
        <div class="page-content" style="margin-left:100px">
        <div class="container">
    <h1>Projects with Status: {{ ucfirst($status) }}</h1>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                 
                    <th>Status</th>
                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $count = 0; @endphp
                @foreach($projects as $project)
                    @php $count++; @endphp
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $project->project_name }}</td>
                
                        <td>{{ $project->status }}</td>
                       
                        <td>
                            <a class="btn btn-success" href="{{ url('view_project_detail', ['id' => $project->id]) }}">view</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        </div>
        @include('projectManager.footer')
        <!-- partial -->
    </div>
</div>

<!-- core:js -->
@include('projectManager.js')

</body>
</html>
