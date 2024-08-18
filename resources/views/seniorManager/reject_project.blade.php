<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD

@include('seniorManager.css')

<body>
<div class="main-wrapper">

    <!-- partial:partials/_sidebar.html -->
    @include('seniorManager.sidebar')

    <!-- partial -->

    <div class="page-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('seniorManager.header')

        <div class="page-content">
            <div class="table-responsive">
                <table class="table table-hover mb-1">
                    <thead>
                        <tr>
                            <th class="pt-0">S. NO</th>
                            <th class="pt-0">Project Name</th>
                            <th class="pt-0">Description</th>
                            <th class="pt-0">Status</th>
                            <th class="pt-0">Start Date</th>
                            <th class="pt-0">Deadline</th>
                            <th class="pt-0">Creator</th>
                            <th class="pt-0">Actions</th>
                            <th class="pt-0">Approve</th>
                            <th class="pt-0">Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if($projects)
                            @php
                                $count++;
                            @endphp
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $projects->project_name }}</td>
                                <td>{!! Str::limit($projects->description, 30) !!}</td>
                                <td>{{ $projects->status }}</td>
                                <td>{{ $projects->start_date }}</td>
                                <td>{{ $projects->deadline }}</td>
                                <td>{{ $projects->creator ? $projects->creator->firstname : 'N/A' }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('view_project_details', $projects->id) }}">Details</a>
                                </td>
                                <td>
                                <a class="btn btn-success"  href="{{ route('seniorManager.approve_project', $projects->id) }}">Approve</a>
                                </td>
                                <td>
                                    @if($projects->status != 'Rejected')
                                        <a class="btn btn-danger" href="{{ route('seniorManager.reject_project', $projects->id) }}"><span class="text-danger">❌</span></a>
                                    @else
                         
                                    @endif
                                </td>
                            </tr>
                        @else
                            <p>No approved project found.</p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- partial:partials/_footer.html -->
        @include('seniorManager.footer')
        <!-- partial -->
    </div>
</div>

<!-- core:js -->
@include('seniorManager.js')

</body>
</html>
=======
<head>
    @include('seniorManager.css')
    <style>
        /* Form label styling */
        label {
            font-size: 16px;
            font-weight: 600;
            color: #555555;
            margin-bottom: 10px;
            display: block;
        }

        /* Form textarea styling */
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #cccccc;
            transition: border-color 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
            
        }

        /* Button styling */
        .btn-danger {
            background-color: #d9534f;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }
    </style>
    
</head>
<body>
    <div class="main-wrapper">
        @include('seniorManager.sidebar')

        <div class="page-wrapper">
            @include('seniorManager.header')

            <div class="page-content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                        <h6 class="card-title">Rejection Form for the <span style="color: aqua; font-weight:bolder">{{$projectPlan->name}}</span> Project Plan</h6>
                 <form action="{{ route('seniorManager.reject', $projectPlan->id) }}" method="POST">
                                 @csrf
                            <div class="form-group">
                              <label for="rejection_reason" style="font-weight: bold; font-size: 1.1rem; color: #333;">Rejection Reason</label>
                              <textarea name="rejection_reason" id="rejection_reason" class="form-control" required></textarea>
                          </div>
                   <div class="text-center" style="margin-top: 20px;">
                   <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                 </form>
                        </div>
                    </div>
                </div>
            </div>

            @include('seniorManager.footer')
        </div>
    </div>

    @include('seniorManager.js')
</body>
</html>
>>>>>>> b260690166f437c962fb8f5a07530bce5cae6fac
