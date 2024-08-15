<!DOCTYPE html>
<html lang="en">

@include('seniorManager.css')

<body>
<div class="main-wrapper">
    @include('seniorManager.sidebar')

    <div class="page-wrapper">
        @include('seniorManager.header')

        <div class="page-content" style="margin-left:50px">
         
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Approved Projects</h6>
                                    @if ($approvedProjects->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="pt-0">S. NO</th>
                                                        <th class="pt-0">Project Name</th>
                                                        <th class="pt-0">Category Name</th>
                                                        <th class="pt-0">Project Plan Name</th>
                                                        <th class="pt-0">Created By</th>
                                                        <th class="pt-0">Approved By</th>
                                                        <th class="pt-0">Approved At</th>
                                                        <th class="pt-0">Rereject</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $count = 0;
                                                    @endphp
                                                    @foreach($approvedProjects as $projectPlan)
                                                        @php
                                                            $count++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td>{{ $projectPlan->project->name }}</td>
                                                            <td>{{ $projectPlan->project->category->cat_name }}</td>
                                                            <td>{{ $projectPlan->name }}</td>
                                                            <td>{{ $projectPlan->project->creator->firstname ?? 'N/A' }}</td>
                                                            <td>{{ $projectPlan->approvedBy->firstname ?? 'N/A' }}</td>
                                                            <td>
                                                                {{ $projectPlan->approved_on ? (new \DateTime($projectPlan->approved_on))->format('Y-m-d H:i:s') : 'N/A' }}
                                                            </td>
                                                            <td>
                                                            <a href="{{ route('seniorManager.reject_approved_project', ['id' => $projectPlan->id]) }}" class="btn btn-danger" style="margin-right: 10px;">Reject Project</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p>There are no approved projects available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @include('seniorManager.footer')
                    </div>
                </div>
@include('seniorManager.js')
</body>
</html>
