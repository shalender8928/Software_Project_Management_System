<!DOCTYPE html>
<html lang="en">
<head>
    @include('seniorManager.css')
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
                            <h6 class="card-title">View Project Details and Project Plan For <span style="color: aqua; font-weight:bolder">{{$projectPlan->name}}</span> Project Plan</h6>
                            @if($projectPlan)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Project Plan</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Plan</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('view_project_plan', $projectPlan->id)}}" data-viewed="false">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Objective</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('view_objective_of_project_plan', $projectPlan->id)}}" data-viewed="false">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Scope</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('view_project_plan_scope', $projectPlan->id)}}" data-viewed="false">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Deliverable</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('view_project_deliverable', $projectPlan->id)}}" data-viewed="false">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Dependency</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('view_project_dependency', $projectPlan->id)}}" data-viewed="false">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Milestone</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('view_project_milestone', $projectPlan->id)}}" data-viewed="false">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Resource</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('view_project_resource', $projectPlan->id)}}" data-viewed="false">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                            <div class="d-flex justify-content-center">
                                            <a href="{{ route('seniorManager.approve_project', ['id' => $projectPlan->id]) }}" class="btn btn-success" style="margin-right: 10px;">Approve Project</a>

                                            <a href="{{ route('seniorManager.reject_project', ['id' => $projectPlan->id]) }}" class="btn btn-danger" style="margin-right: 10px;">Reject Project</a>

                                            <a href="{{ route('seniorManager.dashboard') }}" class="btn btn-secondary" style="margin-left: 10px;">Back to Dashboard</a>
                                             
                                            </div>



                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <p>No project plan found. Please create a project plan first.</p>
                            @endif
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
