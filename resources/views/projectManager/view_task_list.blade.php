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
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                <thead>
                    <tr>
                    <th>#</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Assign To</th>
                        <th>Deadline</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
    @php
        $count = 0; // Initialize the $count variable
    @endphp
    @foreach($tasks as $task)
        @php
            $count++;
        @endphp
        <tr>
            <td>{{ $count }}</td>
            <td>{{ $task->project_name }}</td>
            <td>{{ $task->task_description }}</td>
            <td>{{ $task->priority }}</td>
            <td>{{ $task->assign_to }}</td>
            <td>{{ $task->deadline }}</td>
            <td>{{ $task->start_date }}</td>
            <td>{{ $task->end_date }}</td>
            <td>
            <a class="btn btn-success" href="{{ url('view_task_detail', ['id' => $task->id]) }}">View</a>

            </td>
        </tr>
    @endforeach
</tbody>
            </table>
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
