<!DOCTYPE html>
<html lang="en">
<head>
    @include('projectManager.css')
</head>
<body>
    <div class="main-wrapper">
        @include('projectManager.sidebar')

        <div class="page-wrapper">
            @include('projectManager.header')

            <div class="page-content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Project Plan For <span style="color: aqua; font-weight:bolder">{{$projectPlan->name}}</span> Project Plan</h6>
                            @if($projectPlan)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Project Plan</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Plan</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('edit_plan',$projectPlan->id)}}">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Objective </td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('edit_objective',$projectPlan->id)}}">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Scope </td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('edit_scope',$projectPlan->id)}}">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td> Deliverable</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('edit_deliverable',$projectPlan->id)}}">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td> Dependency </td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('edit_dependency',$projectPlan->id)}}">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td> Milestone </td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('edit_milestone',$projectPlan->id)}}">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td> Resource</td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('edit_resource',$projectPlan->id)}}">Edit</a>
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

            @include('projectManager.footer')
        </div>
    </div>

    @include('projectManager.js')
</body>
</html>
