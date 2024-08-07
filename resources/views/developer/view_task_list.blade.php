<!DOCTYPE html>
<html lang="en">

@include('developer.css')

<body>
<div class="main-wrapper">

    <!-- partial:partials/_sidebar.html -->
    @include('developer.sidebar')
    <!-- partial -->

    <div class="page-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('developer.header')
        <div class="page-content" style="margin-left:100px">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="pt-0">S. NO</th>
                        <th class="pt-0">Project Name</th>
                        <th class="pt-0">Description</th>
                        <th class="pt-0">Priority</th>
                        <th class="pt-0">Assign To</th>
                        <th class="pt-0">Deadline</th>
                        <th class="pt-0">Start Date</th>
                        <th class="pt-0">End Date</th>
                        <th class="pt-0">Actions</th>
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
            <td>{!!Str::limit($task->task_description,50)!!}</td>
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
        @include('developer.footer')
        <!-- partial -->
    </div>
</div>

<!-- core:js -->
@include('developer.js')

</body>
</html>
