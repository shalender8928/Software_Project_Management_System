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
                            <h6 class="card-title">Delete Project Plan For <span style="color: aqua; font-weight:bolder">{{$projectPlan->name}}</span> Project Plan</h6>
                            @if($projectPlan)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Project Plan</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Plan</td>
                                            <td>
                                                <a class="btn btn-danger"  onclick="plan_confirmation(event)" href="{{url('delete_plan',$projectPlan->id)}}">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Objective </td>
                                            <td>
                                                <a class="btn btn-danger"  onclick="objective_confirmation(event)" href="{{url('delete_objective',$projectPlan->id)}}">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Scope </td>
                                            <td>
                                                <a class="btn btn-danger" href="{{url('Delete_scope',$projectPlan->id)}}">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td> Deliverable</td>
                                            <td>
                                                <a class="btn btn-danger" href="{{url('Delete_deliverable',$projectPlan->id)}}">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td> Dependency </td>
                                            <td>
                                                <a class="btn btn-danger" href="{{url('Delete_dependency',$projectPlan->id)}}">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td> Milestone </td>
                                            <td>
                                                <a class="btn btn-danger" href="{{url('Delete_milestone',$projectPlan->id)}}">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td> Resource</td>
                                            <td>
                                                <a class="btn btn-danger" href="{{url('Delete_resource',$projectPlan->id)}}">Delete</a>
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


    <script>
        function plan_confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
        
            swal({
                title: "Are you sure you want to delete this Project Plan ?",
                text: "This action will be permanent and Delete all the component of Project Plan.",
                icon: "error",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = urlToRedirect;
                }
            });
        }

        function objective_confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
        
            swal({
                title: "Are you sure you want to delete this Project Objective ?",
                text: "This action will be permanent",
                icon: "error",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = urlToRedirect;
                }
            });
        }
        </script>
</body>
</html>
