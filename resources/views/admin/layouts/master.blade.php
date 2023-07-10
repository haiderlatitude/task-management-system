<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.inc.head')
@show

<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
    @include('admin.layouts.inc.navbar')
    @include('admin.layouts.inc.sidebar')
    <!-- Main Content -->
    @section('main-content')
    @show
    <!-- End Main Content -->

    @include('admin.layouts.inc.footer')
    </div>
</div>

@include('admin.layouts.inc.script')
@show


</body>
</html>
