<!DOCTYPE html>
<!-- saved from url=(0079)https://www.einfosoft.com/templates/admin/otika/source/light/auth-register.html -->
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register - Task Management System</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('register_files/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('register_files/selectric.css')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('register_files/style.css')}}">
    <link rel="stylesheet" href="{{asset('register_files/components.css')}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset('register_files/custom.css')}}">
<style type="text/css">
@font-face {
  font-weight: 400;
  font-style:  normal;
  font-family: circular;

  src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Book.woff2') format('woff2');
}

@font-face {
  font-weight: 700;
  font-style:  normal;
  font-family: circular;

  src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Bold.woff2') format('woff2');
}</style></head>

<body class="light theme-white light-sidebar">
  <div class="loader" style="display: none;"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('register') }}"> @csrf
                  <div class="row">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input id="name" type="text" class="form-control" name="name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password_confirmation" class="d-block">Password Confirmation</label>
                      <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">
                Already Registered? <a href="/loginForm">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset('register_files/app.min.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{asset('register_files/jquery.pwstrength.min.js')}}"></script>
  <script src="{{asset('register_files/jquery.selectric.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('register_files/auth-register.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{asset('register_files/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{asset('register_files/custom.js')}}"></script>
</body></html>