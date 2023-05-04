<!DOCTYPE html>
<html lang="en">
@include('sweetalert::alert')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>S-Kepuharjo</title>
    <link rel="stylesheet" href="{{ asset('template/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('template/images/logo.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h4>Login S-Kepuharjo </h4>
                            <h6 class="font-weight-light">Sign in untuk melanjutkan</h6>

                            <form action="{{ url('login/auth') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid
                                    @enderror"
                                        value="{{ old('username') }}" placeholder="Username">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid

                                    @enderror"
                                        value="{{ old('password') }}" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3  row d-flex justify-content-center align-content-center">
                                    <button class="btn btn-secondary .btn-{color} d-grid gap-2 col-6 mx-auto"
                                        type="submit" style="background:#102286; color:white;">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('template/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('template/js/off-canvas.js') }}"></script>
    <script src="{{ asset('template/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('template/js/template.js') }}"></script>
</body>

</html>


{{-- toast cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- jquery cdn --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
