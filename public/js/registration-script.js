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

} );
