<!DOCTYPE html>
<html lang="en">

@include('seniorManager.css')

<body>
<div class="main-wrapper">
    @include('seniorManager.sidebar')

    <div class="page-wrapper">
        @include('seniorManager.header')

        <div class="page-content" style="margin-left:100px">
            <div class="row profile-body">
<<<<<<< HEAD
                <div class="col-md-8 col-xl-9 middle-wrapper">
=======
                <div class="col-md-7 col-xl-9 middle-wrapper">
>>>>>>> b260690166f437c962fb8f5a07530bce5cae6fac
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">List of Project Managers</h6>
                                    @if ($count > 0)
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="pt-0">S. NO</th>
                                                    <th  class="pt-0">Name</th>
                                                    <th  class="pt-0">Email</th>
                                                    <th class="pt-0">Actions</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                              $count = 0;
                                            @endphp
                                                @foreach ($developers as $developere)
                                                @php
                                                  $count++;
                                                @endphp
                                                    <tr>
                                                        <td>{{ $count }}</td>
                                                        <td>{{ $developere->firstname }}</td>
                                                        <td>{{ $developere->email }}</td>
                                                        <td>
                                      <a class="btn btn-success"  href="{{ url('view_projec_developer_details', $developere->id) }}">View_developere_Details</a>
                                            </td>
                                     </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>There are no project managers currently available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-xl-block col-xl-3">
                    <div class="row"></div>
                </div>
            </div>
        </div>
        @include('seniorManager.footer')
    </div>
</div>
@include('seniorManager.js')
</body>
</html>
