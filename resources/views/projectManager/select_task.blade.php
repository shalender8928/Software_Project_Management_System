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
              <th class="pt-0">S. NO</th>
              <th class="pt-0">Task Name</th>
              <th class="pt-0">Project Name</th>
              <th class="pt-0">Category</th>
              <th class="pt-0">Task Status</th>
              <th class="pt-0">Developer Name</th>
              <th class="pt-0">Select Task</th>
            </tr>
          </thead>
          <tbody>
            @php
              $count = 0;
            @endphp
            @foreach($tasks as $task)
            @php
              $count++;
            @endphp
            <tr>
              <td>{{ $count }}</td>
              <td>{{$task->name}}</td>
              <td>{{ $task->project->name }}</td>
              <td>{{ $task->project->category->cat_name }}</td>
              <td>{{ $task->status }}</td>
              <td>{{ $task->developerHasTasks->first()->user->firstname }} {{ $task->developerHasTasks->first()->user->lastname }}</td>
              <td>
                <a class="btn btn-success" href="{{ url('select_assigned_user', $task->id) }}">Select</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
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
