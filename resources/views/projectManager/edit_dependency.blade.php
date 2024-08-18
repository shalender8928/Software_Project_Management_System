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
                      <th class="pt-0">Preceding Task</th>
                      <th class="pt-0">Dependent Task</th>
                      <th class="pt-0">Dependency Type</th>
                      <th class="pt-0">Plan Name</th>
                      <th class="pt-0">Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $count = 0;
                    @endphp
                    @foreach($dependencies as $datas)
                    @php
                        $count++;
                    @endphp
                    <tr>
                      <td>{{$count}}</td>
                      <td>{{$datas->precedingTask->name}}</td>
                      <td>{{$datas->dependentTask->name}}</td>
                      <td>{{$datas->dependency_type}}</td>
                      <td>{{$projectPlan->name}}</td>
                      <td>
                        <a class="btn btn-primary" href="{{url('edit_dependency_form', $datas->id)}}">Edit</a>
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
