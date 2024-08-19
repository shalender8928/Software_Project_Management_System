<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>NobleUI - HTML Bootstrap 5 Admin Dashboard Template</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo2/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-6 col-xl-8 mx-auto">
						<div class="card">
							<div class="row">
                <div class="col-md-2 pe-md-0">
                
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">SPMS<span></span></a>
                    <h5 class="text-muted fw-normal mb-4">Create a free account.</h5>
                  

                    <form method="POST" action="{{ route('register') }}">
                                            @csrf

                                            <!-- First Name -->
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                                                @error('firstname')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Last Name -->
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                                                @error('lastname')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Email -->
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                                @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Password -->
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                                @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                                @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Phone -->
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" required>
                                                @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Gender -->
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <input type="text" class="form-control" id="gender" name="gender" required>
                                                @error('gender')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Age -->
                                            <div class="mb-3">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="number" class="form-control" id="age" name="age" required>
                                                @error('age')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Street -->
                                            <div class="mb-3">
                                                <label for="street" class="form-label">Street</label>
                                                <input type="text" class="form-control" id="street" name="street">
                                                @error('street')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- City -->
                                            <div class="mb-3">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city" name="city">
                                                @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- State -->
                                            <div class="mb-3">
                                                <label for="state" class="form-label">State</label>
                                                <input type="text" class="form-control" id="state" name="state">
                                                @error('state')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Zip Code -->
                                            <div class="mb-3">
                                                <label for="zip_code" class="form-label">Zip Code</label>
                                                <input type="text" class="form-control" id="zip_code" name="zip_code">
                                                @error('zip_code')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Country -->
                                            <div class="mb-3">
                                                <label for="country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="country" name="country">
                                                @error('country')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>


                  </div>
                </div>
              </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

 <!-- core:js -->
 <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

</body>
</html>