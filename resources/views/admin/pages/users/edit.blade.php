@section('admin_title','Edit Admin')
@extends('admin.layouts.master')
@section('style')
@endsection
@section('main-content')
    <!-- Main Content -->


    <!--End Main Section -->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            let selectedValue = $('#role_id option:selected').val();
            $.ajax({
                url: '/admin/user/get/permissions/with/' + selectedValue,
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    var myArray = data[1];
                    var toRemove = data[0];

                    for (var i = myArray.length - 1; i >= 0; i--) {
                        for (var j = 0; j < toRemove.length; j++) {
                            if (myArray[i] && (myArray[i].name === toRemove[j].name)) {
                                myArray.splice(i, 1);
                            }
                        }
                    }
                    $('.remove_display').show();
                    $('.remove_display_1').show();

                    $('.user_permissions').empty();
                    $('.permissions').empty();
                    $.each(data[0], function (value, key) {
                        $(".permissions").append(`<div class="col-md-3" > <input type="checkbox" name="permissions[]"
                         value="${key.id}"
                        class="m-1 checkbox_permissions" checked disabled>
                        <span class="checkbox">${key.name}</span></div>`);
                    })

                    console.log('my array=>',myArray);
                    $.each(myArray, function (value, key) {
                        $('.user_permissions').append(`<div class="col-md-3" >
                                        <input type="checkbox" name="user_permissions[]"
                                             value="${key.id}" ${myArray.find((el) => el.id === key.id) ? 'checked':'' }
                                             class="m-1 checkbox" > <span
                                             class="checkbox">${key.name}</span></div>`);
                    })
                    let array = [];
                    var checkboxes = document.querySelectorAll(`.checkbox_permissions`);
                    console.log(checkboxes);
                    $.each(checkboxes, function (key, value) {
                        array.push(value.value);
                    })


                }
            });

        });

    </script>
@endsection
