@section('admin_title','Add Admin')
@extends('admin.layouts.master')
@section('style')
@endsection
@section('main-content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Add Admin</h4>
                        </div>
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                </div>
                            @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{Session::get('error')}}
                                    </div>
                                @endif
                            <form action="{{route('user-save')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name">First Name:</label>
                                        <input id="name" type="text" class="form-control" name="first_name"
                                               autofocus=""
                                               required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="last_name">Last Name:</label>
                                        <input id="address" type="text" class="form-control"
                                               name="last_name" required>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="last_name">Address:</label>
                                        <input id="address" type="text" class="form-control"
                                               name="user_address"
                                               required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="last_name">phone:</label>
                                        <input id="user_phone" type="text" class="form-control"
                                               name="user_phone"
                                               required>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="last_name">Email:</label>
                                        <input id="email" type="email" class="form-control" name="email"
                                               required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="user_nic">NIC#</label>
                                        <input id="user_nic" type="text" class="form-control"
                                               name="user_nic" required>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="city">Status:</label>
                                        <select class="form-control" name="status">
                                            <option class="form-group">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="last_name">User Name</label>
                                        <input id="user_status" type="text" class="form-control"
                                               name="username"
                                               required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="start_time">Start Time:</label>
                                        <input id="start_time" type="time" class="form-control"
                                               name="start_time"
                                               required>

                                    </div>
                                    <div class="form-group col-6">
                                        <label for="end_time">End time</label>
                                        <input id="end_time" type="time" class="form-control"
                                               name="end_time" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password:</label>
                                        <input id="password" type="password" class="form-control"
                                               data-indicator="pwindicator" name="password">
                                        <div id="pwindicator" class="pwindicator" required>
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2" class="d-block">Password
                                            Confirmation:</label>
                                        <input id="password2" type="password" class="form-control"
                                               name="password_confirm" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-11">
                                        <label for="city">User City:</label>
                                        <select class="form-control" name="user_city"
                                                id="user_city">
                                            <option value="0">Select City</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-1 m-auto">
                                        <button type="button"
                                                class="btn button btn-primary add-one-more-city">
                                            Add
                                        </button>
                                    </div>
                                </div>
                                <div class="row add-one" id="add-one">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class=" control-label">City Name</label>
                                            <input type="text" class="form-control" id="city_name"
                                                   placeholder="City Name" name="city_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">City Code</label>
                                            <input type="text" class="form-control" id="city_code"
                                                   placeholder="City Code" data-skip-name="true"
                                                   name="city_code">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="form-group col-11">
                                        <label for="city">Office:</label>
                                        <select class="form-control" name="office_id"
                                                id="group">
                                            <option value="0">Select Office</option>
                                            @foreach($offices as $office)
                                                <option
                                                    value="{{$office->id}}">{{$office->office_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-auto col-1">
                                        <button type="button"
                                                class="btn button btn-primary add-one-more-office">
                                            Add
                                        </button>
                                    </div>
                                </div>
                                <div class="row add-one-office" id="add-one-office">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="col-form-label"><b>Office
                                                    Code</b></label>
                                            <input type="text" value="{{old('office_code')}}"
                                                   class="form-control"
                                                   name="office_code" placeholder="Enter Office Code">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group mb-4">
                                            <label class="col-form-label "><b>Office
                                                    Name</b></label>
                                            <input type="text" value="{{old('office_name')}}"
                                                   class="form-control"
                                                   name="office_name" placeholder="Enter Office Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group  mb-4">
                                            <label class="col-form-label"><b>Office
                                                    Address</b></label>
                                            <input type="text" value="{{old('office_address')}}"
                                                   class="form-control"
                                                   name="office_address" placeholder="Enter Office Address">
                                        </div>
                                    </div>

                                    <div class="col-md-6 ">
                                        <div class="form-group  mb-4">
                                            <label class="col-form-label "><b>Office
                                                    City</b></label>
                                            <select class="form-control selectric" name="office_city_id"
                                                    id="office_city_id">
                                                <option value="0">Select City</option>
                                                @foreach($cities as $city)
                                                    <option
                                                        value="{{$city->id}}">{{$city->city_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group  mb-4">
                                            <label class="col-form-label"><b>Office
                                                    Phone
                                                    No.</b></label>
                                            <input type="number" value="{{old('office_phone')}}"
                                                   class="form-control"
                                                   name="office_phone" placeholder="Enter Office Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group  mb-4">
                                            <label class="col-form-label "><b>Office Fax
                                                    No.</b></label>
                                            <input type="text" value="{{old('office_fax')}}"
                                                   class="form-control"
                                                   name="office_fax" placeholder="Enter Office Fax">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group  mb-4">
                                            <label class="col-form-label"><b>Office
                                                    E-mail</b></label>
                                            <input type="email" value="{{old('office_email')}}"
                                                   class="form-control"
                                                   name="office_email" placeholder="Enter Office E-mail">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group  mb-4">
                                            <label class="col-form-label"><b>Office
                                                    Start Time</b></label>
                                            <input type="time" value="{{old('start_time')}}"
                                                   class="form-control timepicker" name="office_start_time"
                                                   placeholder="Enter Office Start-Time">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group  mb-4">
                                            <label class="col-form-label"><b> Office
                                                    End-Time</b></label>
                                            <input type="time" value="{{old('end_time')}}"
                                                   class="form-control timepicker" name="office_end_time"
                                                   placeholder="Enter Office End Time">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="city">Select Role:</label>
                                        <select class="form-control role_id" id="role_id" name="role_id"
                                                style="width: 100%;" tabindex="-1"
                                                aria-hidden="true">
                                            <option value="null">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row permissions" id="permissions">

                                </div>
                                <hr class="remove_display" id="remove_display">
                                <h5 class="remove_display_1" id="remove_display_1">Additonal
                                    Permissions</h5>
                                <div class="row user_permissions" id="user_permissions">

                                </div>
                                <div class="form-group col-md-2" style="float: right">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Add Admin
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Main Section -->
@endsection
@section('script')

    <script src="{{asset("frontend/assets/js/jquery.repeater.min.js")}}"></script>
    <script src="{{asset("frontend/assets/js/form-repeater.js")}}"></script>
@endsection
