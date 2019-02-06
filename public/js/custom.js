$(document).ready(function() {
    $('#datatable').DataTable({
    	responsive: true,
    	"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
    });
    
    $("#userRole option[value='Admin']").hide();

    if ( $('#sig1').is('.nav-link.active') ) {
	   //do something it does have the protected class!
	   var table = $('#datatable').DataTable();
	   var filteredData = table
	    table
            .column(3)
            .visible( false )
            .search( '1' )
            .draw();
   }

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

	if ( $('a').is('.nav-link.disabled') ) {
		var category = $("input[name=category]").val();
		var filteredData = table
		    table
	            .column(3).visible( false )
	            .search( category )
	            .draw();
	}
	else{
		$( "#sig1" ).click(function() {
		   $("input[name=category]").val('1');
		   var filteredData = table
		    table
	            .column(3).visible( false )
	            .search( '1' )
	            .draw();
		});
		$( "#sig2" ).click(function() {
		   $("input[name=category]").val('2');
		   $('#officeInput option').show();
		   $('#officeInput option[title!="CBO"]').hide();
		   var filteredData = table
		    table
	            .column(3).visible( false )
	            .search( 2 )
	            .draw();
		});
		$( "#sig3" ).click(function() {
		   $("input[name=category]").val('3');
		   $('#officeInput option').show();
		   $('#officeInput option[title!="CTO"]').hide();
		   var filteredData = table
		    table
	            .column(3).visible( false )
	            .search( 3 )
	            .draw();
		});
		$( "#sig4" ).click(function() {
		   $("input[name=category]").val('4');
		   $('#officeInput option').show();
		   var filteredData = table
		    table
	            .column(3).visible( false )
	            .search( 4 )
	            .draw();
		});
		$( "#sig5" ).click(function() {
		   $("input[name=category]").val('5');
		   $('#officeInput option').show();
		   $('#officeInput option[title!="TWG"]').hide();
		   var filteredData = table
		    table
	            .column(3).visible( false )
	            .search( 5 )
	            .draw();
		});
		$( "#sig6" ).click(function() {
		   $("input[name=category]").val('6');
		   $('#officeInput option').show();
		   $('#officeInput option[title!="GSO"]').hide();
		   var filteredData = table
		    table
	            .column(3).visible( false )
	            .search( 6 )
	            .draw();
		});
		$( "#sig7" ).click(function() {
		   $("input[name=category]").val('7');
		   $('#officeInput option').show();
		   var filteredData = table
		    table
	            .column(3).visible( false )
	            .search( 7 )
	            .draw();
		});
	}
});