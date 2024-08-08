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
      <div class="col-md-8 col-xl-9 middle-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Update Task Assignment</h6>
                <form class="forms-sample" id="task-form" method="POST" action="{{ url('assign_task_update_post', $task->id) }}">
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

                  <!-- Select Developer -->
                  

                  <button type="submit" class="btn btn-primary me-2">Update</button>
                  <a href="{{ route('projectManager.dashboard') }}" class="btn btn-secondary">Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- partial:partials/_footer.html -->
    @include('projectManager.footer')  
    <!-- partial -->
  </div>
</div>

<!-- core:js -->
@include('projectManager.js')

<script>
  document.querySelectorAll('.developer-card').forEach(card => {
    card.addEventListener('click', function() {
      const radio = this.querySelector('.developer-radio');
      const isSelected = radio.checked;

      document.querySelectorAll('.developer-card').forEach(otherCard => {
        if (otherCard !== this) {
          otherCard.querySelector('.developer-radio').checked = false;
        }
      });

      if (isSelected) {
        radio.checked = false;
      } else {
        radio.checked = true;
      }
    });
  });

  document.getElementById('task-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = this;
    const selectedRadio = form.querySelector('input[name="user_id"]:checked');
    let developerId = selectedRadio ? selectedRadio.value : null;

    if (!developerId) {
      // No developer selected, show confirmation to remove assignment
      swal({
        title: "Are you sure?",
        text: "You are about to remove the task assignment.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willRemove) => {
        if (willRemove) {
          fetch(form.action, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
              developer_id: null
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              toastr.success("Task assignment removed successfully.");
              window.location.href = '{{ route('projectManager.dashboard') }}';
            } else {
              toastr.error("An error occurred while updating the task.");
            }
          })
          .catch(error => {
            console.error('Error:', error);
            toastr.error("An error occurred while updating the task.");
          });
        }
      });
    } else {
      // Developer selected, check for reassignment confirmation
      fetch(form.action, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          developer_id: developerId
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'confirm') {
          swal({
            title: "Are you sure?",
            text: data.message,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willUpdate) => {
            if (willUpdate) {
              fetch(form.action, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                  developer_id: developerId,
                  confirm: true
                })
              })
              .then(response => response.json())
              .then(data => {
                if (data.status === 'success') {
                  toastr.success("Task reassigned successfully.");
                  window.location.href = '{{ route('projectManager.dashboard') }}';
                } else {
                  toastr.error("An error occurred while updating the task.");
                }
              })
              .catch(error => {
                console.error('Error:', error);
                toastr.error("An error occurred while updating the task.");
              });
            }
          });
        } else if (data.status === 'success') {
          toastr.success("Task reassigned successfully.");
          window.location.href = '{{ route('projectManager.dashboard') }}';
        } else {
          toastr.error("An error occurred while updating the task.");
        }
      })
      .catch(error => {
        console.error('Error:', error);
        toastr.error("An error occurred while updating the task.");
      });
    }
  });
</script>

</body>
</html>
