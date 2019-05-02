$(document).ready(function() {
    $("#userRole option[value='Admin']").hide();
    $("#supervisorCheck").hide();
    console.log($("input[name='is_supervisor']").val());
    
    $("input[name='check_supervisor']").click(function() {
        if($("input[name='check_supervisor']"). prop("checked") == true){
            $("input[name='is_supervisor']").val(1);
            console.log($("input[name='is_supervisor']").val());
        }else{
            $("input[name='is_supervisor']").val(0);
             console.log($("input[name='is_supervisor']").val());
        }
    });
    
    $("#officeInput").change(function() {
       var val = $("option:selected", this).attr('data-office-code');
    //    var role = $("#select_option option:selected").val();

       if(val === "ICT") {
           $("#userRole option[value='Admin']").show();
       }
       else{
           $("#userRole option[value='Admin']").hide();
       }

       if(val === "GSO"){
            $("#supervisorCheck").show();
       }else{
        $("#supervisorCheck").hide();
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
