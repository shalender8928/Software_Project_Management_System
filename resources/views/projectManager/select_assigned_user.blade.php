<!DOCTYPE html>
<html lang="en">
  @include('projectManager.css')

<body>
<div class="main-wrapper">

  @include('projectManager.sidebar')

  <div class="page-wrapper">
    @include('projectManager.header')  

    <div class="page-content" style="margin-left:100px">
      <div class="col-md-8 col-xl-9 middle-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Update Task Assignment</h6>
                <form class="forms-sample" id="task-form">
                  @csrf

                  <!-- Task Details -->
                  <h6 class="card-title">Task Details</h6>

                  <div class="mb-3">
                    <label class="form-label">Task Name</label>
                    <input type="text" class="form-control" value="{{ $task->name }}" readonly>
                  </div>

                  <div class="mb3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" readonly>{{ $task->description }}</textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Project</label>
                    <input type="text" class="form-control" value="{{ $task->project ? $task->project->name : 'N/A' }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" value="{{ $task->status }}" readonly>
                  </div>

                 
                </form>
                 <!-- Submit Button -->
                 <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('assign_task_update_post', $task->id) }}">Remove Task</a>

                 <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('projectManager.footer')  
  </div>
</div>

@include('projectManager.js')
<script>
  function confirmation(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');
    console.log(urlToRedirect);
  
    swal({
      title: "Are you sure ?",
      text: "You are about to remove the task assignment from the developer.",
      icon: "warning",
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
