<!DOCTYPE html>
<html lang="en">
<head>
@include('developer.css')
</head>
<body>
<div class="main-wrapper">

<!-- partial:partials/_sidebar.html -->
   @include('developer.sidebar')

<!-- partial -->

<div class="page-wrapper">
            
    <!-- partial:partials/_navbar.html -->
    
         @include('developer.header')  


         <div class="page-content"  style="margin-left:100px">
            <!-- feedback start      -->
         
            <div class="container">
        <h1>Feedback List</h1>
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="pt-0">S. NO</th>
                    <th class="pt-0">Customer</th>
                    <th class="pt-0">Project</th>
                    <th class="pt-0">Feedback</th>
                    <th class="pt-0">Rating</th>
                    <th class="pt-0">Created At</th>
                    <th class="pt-0">View Detail</th>
                </tr>
            </thead>
            <tbody>
            @php
            $count = 0;
            @endphp
                @foreach ($feedbacks as $feedback)
                @php
                        $count++;
                @endphp
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{ $feedback->customer->name }}</td> <!-- Assuming you have a 'name' attribute -->
                        <td>{{ $feedback->project->name }}</td> <!-- Assuming you have a 'name' attribute -->
                        <td>{{ $feedback->feedbackText }}</td>
                        <td>{{ $feedback->rating }}</td>
                        <td>{{ $feedback->created_at }}</td>

                        <td>
                        <a class="btn btn-secondary" href="{{url('view_feedback_details',$datas->id)}}">View</a>
                      </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


         
     <!-- feedback End      -->

         </div>
         <!-- partial:partials/_footer.html -->

    @include('developer.footer') 

      <!-- partial -->
    </div>

  </div>

  <!-- core:js -->
  @include('developer.js')

</body>
</html>