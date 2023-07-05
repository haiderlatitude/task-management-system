<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Pakistan Railway Advisory & Consultancy Services - Super Admin Login</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/bundles/bootstrap-social/bootstrap-social.css')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/components.css')}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/custom.css')}}">
    <link rel='shortcut icon' type='image/x-icon' href='{{asset('frontend/assets/img/favicon.ico')}}' />
</head>

<body>
<div class="loader"></div>
<div id="app">
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img alt="" src="{{asset('frontend/assets/img/pracs_site_logo_name.png')}}" class="header-logo mt-5" style="margin-bottom: 10px;"/>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container mt-3">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
                    <div class="card card-primary">

                        <div class="card-body">
                            @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    {{Session::get('error')}}
                                </div>
                            @endif
                            <form method="POST" action="{{route('super_admin.login')}}" class="needs-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>

                                </div>
                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                        <div class="float-right">
                                            <a href="auth-forgot-password.html" class="text-small">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                    <div class="invalid-feedback">
                                        please fill in your password
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- General JS Scripts -->
<script src="{{asset('frontend/assets/js/app.min.js')}}"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="{{asset('frontend/assets/js/scripts.js')}}"></script>
<!-- Custom JS File -->
<script src="{{asset('frontend/assets/js/custom.js')}}"></script>
<script>
    setTimeout(function () {
        document.querySelector('.alert').remove();
    }, 5000);
</script>
</body>
</html>
