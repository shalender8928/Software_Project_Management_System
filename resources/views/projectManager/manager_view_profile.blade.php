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

            <div class="page-content">
                <div class="row profile-body">
                    <!-- left wrapper start -->
                    <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                        <div class="card rounded">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                    <div class="mb-2">
                                        <img class="wd-250 ht-250 rounded-circle" src="{{ asset('images/' . $user->image) }}" alt="" >
                                    </div>
                                    <div class="text-center">
                                        <p class="tx-16 fw-bolder">{{ $user->firstname }}</p>
                                        <p class="tx-12 text-muted">{{ $user->email }}</p>
                                        <br>
                                        <p class="tx-14 fw-bolder">Profile Details</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- left wrapper end -->
                    <!-- middle wrapper start -->
                    <div class="col-md-8 col-xl-8 middle-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="forms-sample">
                                            <!-- First Name -->
                                            <div class="mb-2">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="{{ $user->firstname }}" readonly>
                                            </div>
                                            <!-- Last Name -->
                                            <div class="mb-2">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" value="{{ $user->lastname }}" readonly>
                                            </div>
                                            <!-- Phone -->
                                            <div class="mb-2">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" value="{{ $user->phone }}" readonly>
                                            </div>
                                            <!-- Email -->
                                            <div class="mb-2">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                                            </div>
                                            <!-- Gender -->
                                            <div class="mb-2">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" value="{{ $user->gender }}" readonly>
                                            </div>
                                            <!-- Age -->
                                            <div class="mb-2">
                                                <label class="form-label">Age</label>
                                                <input type="number" class="form-control" value="{{ $user->age }}" readonly>
                                            </div>
                                            <a class="btn btn-primary" href="{{ route('manager_edit_profile') }}">Edit Profile</a>
                                            <a class="btn btn-secondary" href="{{ route('projectManager.dashboard') }}">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- middle wrapper end -->
                </div>
            </div>

            <!-- partial:partials/_footer.html -->
            @include('projectManager.footer')

        </div>
    </div>

    <!-- core:js -->
    @include('projectManager.js')

</body>
</html>
