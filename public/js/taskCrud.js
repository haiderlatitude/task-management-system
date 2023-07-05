$(document).ready(function(){
    $.fn.addTask = function(token){
        let html = '<div style="width: 450px;">\
                    <input type="text" style="width: 300px; margin: 3px;" class="rounded-lg" name="name" id="name" placeholder="Enter the name of task"><br>\
                    <input type="text" style="width: 300px; margin: 3px;" class="rounded-lg" name="description" id="description" placeholder="Enter description"><br>\
                    <input type="date" style="width: 300px; margin: 3px;" class="rounded-lg" name="due-date" id="due-date" placeholder="Due Date">\
                    </div>';

        Swal.fire({
            title: 'Add Task',
            html: html,
            confirmButtonText: 'Add',
            confirmButtonColor: '#3b82f6',
            showCancelButton: true,
            cancelButtonColor: '#ef4444',

            preConfirm: () => {
                let name = $('#name').val(), description = $('#description').val(), date = $('#due-date').val();
                if(name && description && date){
                    $.ajax({
                        url: '/admin/add-task',
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': token,
                        },
                        data: {
                            name: name,
                            description: description,
                            date: date,
                        },

                        success: (response) => {
                            Swal.fire({
                                icon: response.icon,
                                title: response.message,
                            });
                        },

                        error: () => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Some error occured. Please try again later!',
                            });
                        }
                    });
                }

                else{
                    Swal.showValidationMessage('Please fill out all fields!');
                }
            }
        });
    }

    $('form#assignTask').submit(function(e){
        e.preventDefault();
        let taskid, userid, token;
        taskid = $('#task').val();
        userid = $('#user').val();
        token = $('#token').val();
        if(taskid == 'select-task'){
            Swal.fire({
                icon: 'info',
                title: 'Please select a task!',
                confirmButtonColor: '#3b82f6',
            });
        }

        else if(userid == 'select-user'){
            Swal.fire({
                icon: 'info',
                title: 'Please select a user!',
                confirmButtonColor: '#3b82f6',
            });
        }

        else{
            $.ajax({
                url: '/admin/assign-task',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token,
                },

                data: {
                    taskid: taskid,
                    userid: userid,
                },

                success: function(response){
                    Swal.fire({
                        icon: response.icon,
                        title: response.message,
                        confirmButtonColor: '#3b82f6',
                        preConfirm: ()=>{
                            window.location.href = '/admin/tasks';
                        },
                    });
                },

                error: function(){
                    Swal.fire({
                        icon: 'error',
                        title: 'Some error occured. Please try again later!',
                    });
                },
            });
        }

    });
});