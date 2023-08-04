<head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
      <title> @yield('admin_title') - Task Management System </title>
      <link href="{{asset('admin/assets/img/pracs_site_logo.png')}}" rel="icon"
            style="min-height: 10px; max-height: 10px; max-width:10px; ">
      <!-- General CSS Files -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <link rel="stylesheet" href="{{asset('admin/assets/css/app.min.css')}}">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('admin/assets/bundles/datatables/datatables.min.css')}}">
      <link rel="stylesheet"
            href="{{asset('admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
      <!-- Template CSS -->
      <!--Railway Admin Pannel  CSS -->
      <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
      <link rel="stylesheet" href="{{asset('admin/assets/css/components.css')}}">
      <!-- Custom style CSS -->
      <link rel="stylesheet" href="{{asset('admin/assets/css/custom.css')}}">
      {{--    <link rel='shortcut icon' type='image/x-icon' href="{{url('assets/img/favicon.ico')}}"/>--}}
      <link rel="stylesheet" href="{{asset('admin/assets/bundles/izitoast/css/iziToast.min.css')}}">
      <link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css')}}" rel="stylesheet"/>

      <link rel="stylesheet" href="{{asset('admin/assets/bundles/summernote/summernote-bs4.css')}}">
      {{--    <link rel="stylesheet" href="{{url('assets/bundles/jquery-selectric/selectric.css')}}">--}}
      <link rel="stylesheet" href="{{asset('admin/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js')}}">
      {{-- Tailwind CSS --}}
      <script src="https://cdn.tailwindcss.com"></script>
      {{-- Sweet Alert 2 --}}
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      {{-- Bootstrap icons --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.1/apexcharts.min.js" integrity="sha512-Gpg0M5UOTFSHGglemXUOUzL1LyO8MT0fxmEAjGN8jNlY6oSOsLerF1/vuXrqJXKyV5QIay12trwDDhmRJHZisA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      @stack('styles')
</head>
