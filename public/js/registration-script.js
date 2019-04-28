$(document).ready(function() {
    $("#userRole option[value='Admin']").hide();
    
    $("#officeInput").change(function() {
       var val = $(this).val();
       var role = $("#select_option option:selected").val();
       if(val === "1") {
           $("#userRole option[value='Admin']").show();
       }
       else{
           $("#userRole option[value='Admin']").hide();
       }
    });

   $("button[name='delete_user']").click(function() {
        var user_id = $(this).attr('data-userid');
        var office = $(this).attr('data-useroffice');
        // console.log(user_id);
        $("#userId").val(user_id);
        $("#userDept").val(office);
        // console.log('register/delete/'+user_id);
        $("form[name='deactivation_reason']").attr('action', 'register/delete/'+user_id);
    });

} );
