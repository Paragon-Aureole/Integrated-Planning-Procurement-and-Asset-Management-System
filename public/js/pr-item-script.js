$(document).ready(function() {

		 $('#itemDesc').on('change', function(){
            $('select[name="item_quantity"]').empty()
            var itemId = $(this).val();
            if(itemId) {
                $.ajax({
                    url: '/pr/item/get/'+itemId,
                    type:"GET",
                    dataType:"json",
                   

                    success:function(data) {
                    	for (var i = 1; i <= data[0]['item_stock']; i++) {
                    		$('select[name="item_quantity"]').append('<option value="'+ i +'">' + i + '</option>');
                    	}
                    	$('#itemUnit').val(data[1]);
                    	$('input[name="item_unit"]').val(data[0]['measurement_unit_id']);
                    	$('input[name="item_cpu"]').val(data[0]['item_cost']);
                    	var budget = $('input[name="item_cpu"]').val() * $('select[name="item_quantity"]').val();
                    	$('input[name="item_cpi"]').val(budget);
                    },
                   
                });
            } else {
                $('select[name="item_quantity"]').empty();
                $('#itemUnit').val("");
            }

        });
    });