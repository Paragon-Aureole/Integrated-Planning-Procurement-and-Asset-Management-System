$(document).ready(function() {
    $("#userRole option[value='Admin']").hide();
    $("#userRole option[value='General Services']").hide();
    $("#supervisorCheck").hide();
    // console.log($("input[name='is_supervisor']").val());
    
    $("input[name='check_supervisor']").click(function() {
        if($("input[name='check_supervisor']"). prop("checked") == true){
            $("input[name='is_supervisor']").val(1);
            // console.log($("input[name='is_supervisor']").val());
        }else{
            $("input[name='is_supervisor']").val(0);
            //  console.log($("input[name='is_supervisor']").val());
        }
    });
    

    $('input[list]').on('input', function(e) {
        var $input = $(e.target),
            $options = $('#' + $input.attr('list') + ' option'),
            $hiddenInput = $('#' + $input.attr('id') + '-hidden'),
            label = $input.val();
    
        $hiddenInput.val(label);
    
        for(var i = 0; i < $options.length; i++) {
            var $option = $options.eq(i);
    
            if($option.val() === label) {
                $hiddenInput.val( $option.attr('data-value') );
                break;
            }
        }

       if(label === "ICT") {
           $("#userRole option[value='Admin']").show();
       }
       else if(label === "GSO"){
           $("#userRole option[value='General Services']").show();
           $("#supervisorCheck").show();
       }
       else{
           $("#userRole option[value='Admin']").hide();
           $("#userRole option[value='General Services']").hide();
           $("#supervisorCheck").hide();
        }
        
    });

    


   $("button[name='delete_user']").click(function() {
        var user_id = $(this).attr('data-userid');
        var office = $(this).attr('data-useroffice');
        $("#userId").val(user_id);
        $("#userDept").val(office);
        $("form[name='deactivation_reason']").attr('action', 'http://ipams.test/register/delete/'+user_id);
    });

} );




