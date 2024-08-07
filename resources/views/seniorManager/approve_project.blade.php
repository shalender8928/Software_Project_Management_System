<!DOCTYPE html>
<html lang="en">

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
                                <td>{{ $projects->project_name}}</td>
                                <td>{!! Str::limit($projects->description, 30) !!}</td>
                                <td>{{ $projects->status }}</td>
                                <td>{{ $projects->start_date }}</td>
                                <td>{{ $projects->deadline }}</td>
                                <td>{{ $projects->creator ? $projects->creator->firstname : 'N/A' }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('view_project_details', $projects->id) }}">Details</a>
                                </td>
                                <td>
                                    @if($projects->status != 'Approved')
                                        <a class="btn btn-success" href="{{ route('seniorManager.approve_project', $projects->id) }}"><span class="text-success">✅</span></a>
                                    @else
                                        
                                    @endif
                                </td>
                                @if($projects->status != 'Approved')
                                <td>
                                <a class="btn btn-danger" href="{{ route('seniorManager.reject_project', $projects->id) }}">Reject</a>
                                </td>
                                @else
                                    <td>
                                        <i class="fas fa-check-circle text-success"></i>
                                    </td>
                                @endif
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
