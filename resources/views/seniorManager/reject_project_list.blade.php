<!DOCTYPE html>
<html lang="en">

@include('seniorManager.css')

<body>
<div class="main-wrapper">
    @include('seniorManager.sidebar')

    <div class="page-wrapper">
        @include('seniorManager.header')

        <div class="page-content">
         
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Rejected Projects</h6>
                                    @if ($rejectedProjects->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="pt-0">S. NO</th>
                                                        <th class="pt-0">Project Name</th>
                                                        <th class="pt-0">Category Name</th>
                                                        <th class="pt-0">Project Plan Name</th>
                                                        <th class="pt-0">Created By</th>
                                                        <th class="pt-0">Rejected By</th>
                                                        <th class="pt-0">Rejected At</th>
                                                        <th class="pt-0">Rejected Reason</th>
                                                        <th class="pt-0">Reapproved</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $count = 0;
                                                    @endphp
                                                    @foreach($rejectedProjects as $projectPlan)
                                                        @php
                                                            $count++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td>{{ $projectPlan->project->name }}</td>
                                                            <td>{{ $projectPlan->project->category->cat_name }}</td>
                                                            <td>{{ $projectPlan->name }}</td>
                                                            <td>{{ $projectPlan->project->creator->firstname ?? 'N/A' }}</td>
                                                            <td>{{ $projectPlan->rejectedBy->firstname ?? 'N/A' }}</td>
                                                            <td>
                                                                {{ $projectPlan->rejected_on ? (new \DateTime($projectPlan->rejected_on))->format('Y-m-d H:i:s') : 'N/A' }}
                                                            </td>
                                                            <td>
                                                              {!! Str::limit($projectPlan->rejection_reason, 25) !!}
                                                            </td>
                                                            <td>
                                                            <a href="{{ route('seniorManager.approved_reject_project', ['id' => $projectPlan->id]) }}" class="btn btn-success" style="margin-right: 10px;">Approve Project</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p>There are no Rejected projects available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @include('seniorManager.footer')
                    </div>
                </div>
                <div class="d-none d-xl-block col-xl-3">
                    <div class="row"></div>
                </div>
            </div>
        </div>
      
    </div>
</div>
@include('seniorManager.js')
</body>
</html>
