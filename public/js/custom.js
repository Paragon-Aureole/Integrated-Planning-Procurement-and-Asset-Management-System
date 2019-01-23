$(document).ready(function() {
    $('#datatable').DataTable({
    	responsive: true,
    	"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]]
    });
    
    $("#userRole option[value='Admin']").hide();
} );

$(function () {
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
});

$(function () {
	var table = $('#datatable').DataTable();

	$( "#sig1" ).click(function() {
	   $("input[name=category]").val('1');
	   var filteredData = table
	    table
            .column( 2 )
            .search( 1 )
            .draw();
	});
	$( "#sig2" ).click(function() {
	   $("input[name=category]").val('2');
	   var filteredData = table
	    table
            .column( 2 )
            .search( 2 )
            .draw();
	});
	$( "#sig3" ).click(function() {
	   $("input[name=category]").val('3');
	   var filteredData = table
	    table
            .column( 2 )
            .search( 3 )
            .draw();
	});
	$( "#sig4" ).click(function() {
	   $("input[name=category]").val('4');
	   var filteredData = table
	    table
            .column( 2 )
            .search( 4 )
            .draw();
	});
	$( "#sig5" ).click(function() {
	   $("input[name=category]").val('5');
	   var filteredData = table
	    table
            .column( 2 )
            .search( 5 )
            .draw();
	});
	$( "#sig6" ).click(function() {
	   $("input[name=category]").val('6');
	   var filteredData = table
	    table
            .column( 2 )
            .search( 6 )
            .draw();
	});
	$( "#sig7" ).click(function() {
	   $("input[name=category]").val('7');
	   var filteredData = table
	    table
            .column( 2 )
            .search( 7 )
            .draw();
	});
});