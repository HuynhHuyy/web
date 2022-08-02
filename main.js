'use strict'
let id_room;
let id_form_leader;
let id_form;
//check pass and usename
$(document).ready(() => {
    $('#submit').click((evt) => {
        if ($('#username').val() == '') {

            evt.preventDefault();
            $('.errorMessage').text('Vui lòng điền tên đăng nhập');
            $('#username').focus();

        } else if (!$('#username').val().match(/^[A-Za-z0-9_\.]{6,32}$/)) {

            evt.preventDefault();
            $('.errorMessage').text('Tên đăng nhập không hợp lệ');
            $('#username').focus();

        } else if ($('#pwd').val() == '' || $('#pwd').val() == null) {

            evt.preventDefault();
            $('.errorMessage').text('Vui lòng nhập password');
            $('#pwd').focus();

        } else if (checkPassword($('#pwd').val()) == false) {

            evt.preventDefault();
            $('.errorMessage').text('Mật khẩu có ít nhất 6 ký tự');
            $('#pwd').focus();

        }
    });
    $('#pwd').click(() => {
        $('.errorMessage').text('');
    });
    $('#username').click(() => {
        $('.errorMessage').text('');
    });
    $('#pwd-confirm').click(() => {
        $('.errorMessage').text('');
    });
});

function checkPassword(pwd) {
    if (pwd.length < 6) {
        return false;
    } else {
        return true;
    }
}

//auto fade alert
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 2000);

$(function() {
    $('#delete-staff').on("show.bs.modal", function(evt) {
        var staffId = $(evt.relatedTarget).attr('data-id');
        $('#staffId').val(staffId)
    });
});

/*delete department*/
$(document).ready(function(){
    $('.delete_btn').click(function(e){
        e.preventDefault();

        var department_id= $(this).closest('tr').find('.department_id').text();
        // console.log(department_id);
        $('#delete_id').val(department_id);

        $('#delete-department').modal('show');
    
    });

    /*edit department*/
    $('.edit_btn').click(function(e){
        e.preventDefault();
        var department_id= $(this).closest('tr').find('.department_id').text();
        id_room = $(e.target.parentNode.parentNode).attr('room');
        $.ajax({
            type: "GET",
            url: "/admin/get_staff_to_id_department.php",
            data:{
                'id_staff_department': id_room,
            },
            success: function(response){
                var temp = JSON.parse(response);
                $('#list_leader').empty();
                $('#list_leader').append("<option>Chọn trưởng phòng</option>");
                    if(temp.code == 0){
                        temp.list.forEach(($staff)=> {
                                if($staff.level == 1){
                                    $('#list_leader').append(" <option selected value = '"+$staff.Id+"'> "+$staff.name+" </option>")
                                }else{
                                    $('#list_leader').append(" <option value = '"+$staff.Id+"'> "+$staff.name+" </option>")
                                }
                            
                        }); 
                    }
            }
        }); 

        $.ajax({
            type: "POST",
            url: "/admin/edit_department_process.php",
            data:{
                'checking_edit_btn':true,
                'department_id': department_id,
                'id_leader': $('#list_leader').val()
            },
            success: function(response){
                $.each(response,function(key,value){
                    $('#edit_id').val(value['id']);
                    $('#edit_nameRoom').val(value['nameRoom']);
                    $('#edit_numberRoom').val(value['numberRoom']);
                    $('#edit_description').val(value['description']);

                });
                $('#editdepartment').modal('show');
            }
        });

    });
    
    /*view deparment*/
    $('.view_btn').click(function(e){
        e.preventDefault();
        var department_id= $(this).closest('tr').find('.department_id').text();
        // console.log(department_id);
        $.ajax({
            type: "POST",
            url: "/admin/view_department_process.php",
            data:{
                'checking_viewbtn':true,
                'department_id': department_id,
            },
            success: function(response){
                $('.department_viewing_data').html(response);
                $('#view-department').modal('show');

            }
        });
    });
});
       
/*view staff*/
$(document).ready(function(){
    $('.staffview_btn').click(function(e){
        e.preventDefault();
       var viewstaffusername= $(this).closest('tr').find('.viewstaffusername').text();
        // console.log(viewdepartmentname);
        $.ajax({
            type: "POST",
            url: "/admin/view_staff_process.php",
            data:{
                'checking_staffviewbtn':true,
                'staffusername': viewstaffusername,
            },
            success: function(response){
                $('.staff_viewing_data').html(response);
                $('#view-staff').modal('show');

            }
        });
    });
});

//leader_view_form
 $('.view_departmentform').click(function(e){
    e.preventDefault();
     id_form_leader= $(this).closest('tr').find('.form_id').text();
        // console.log(id_form_leader);
    $.ajax({
        type: "POST",
        url: "/admin/leader_statusform_process.php",
        data:{
            'checking_leaderformbtn':true,
            'form_id': id_form_leader,
        },
        success: function(response){
            $('.leaderform_viewing_data').html(response);
            $('#view_leaderform').modal('show');
    }

});
});

//download jquery
$(document).ready(function () {
    $("#link_download").click(function (e) {
        e.preventDefault();
        $.ajax({    
            url: "/admin/get_file.php",
            type: "GET",       
            data:{

                'file_id': id_form_leader,
            },          
            success: function(data){   
                
                window.location.href = "../file_upload/" + data;
            }
        });
    });
});





