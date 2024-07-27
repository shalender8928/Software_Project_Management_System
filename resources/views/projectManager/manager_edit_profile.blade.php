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

            <div class="page-content" style="margin-left:100px">
                <div class="row profile-body">
                    <!-- middle wrapper start -->
                    <div class="col-md-8 col-xl-9 middle-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Update Profile</h6>
                                        <form class="forms-sample" method="POST" action="{{ route('manager_update_profile', $user->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            <!-- First Name -->
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" required>
                                                @error('firstname')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Last Name -->
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}" required>
                                                @error('lastname')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Phone -->
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                                                @error('phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Gender -->
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <input type="text" class="form-control" id="gender" name="gender" value="{{ $user->gender }}" required>
                                                @error('gender')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Age -->
                                            <div class="mb-3">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}" required>
                                                @error('age')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="img">Current Image :</label>
                                                <img src="{{ asset('images/' . $user->image) }}" alt="" class="img-thumbnail" width="150"   style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover";>
                                            </div>

                                            <!-- Image -->
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Profile Image (optional)</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                                @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary me-2">Update Profile</button>
                                            <a class="btn btn-secondary" href="{{ route('manager_view_profile') }}">Cancel</a>
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
