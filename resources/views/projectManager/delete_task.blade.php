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
            <a class="btn btn-danger" onclick="confirmation(event)"  href="{{ url('delete_pro_assigntask', ['id' => $task->id]) }}">delete</a>

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

<script>
		function confirmation(ev) {
			ev.preventDefault();
			var urlToRedirect = ev.currentTarget.getAttribute('href');
			console.log(urlToRedirect);
		
			swal({
				title: "Are you sure you want to delete this Employee ?",
				text: "This action will be permanent.",
				icon: "error",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location.href = urlToRedirect;
				}
			});
		}
		</script>

</body>
</html>
