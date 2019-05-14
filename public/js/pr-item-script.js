$(document).ready(function() {

		 $('#itemDesc').on('change', function(){
            $('select[name="item_quantity"]').empty()
            var itemId = $(this).val();
            if(itemId) {
                $.ajax({
                    url: 'http://ipams.test/pr/item/get/'+itemId,
                    type:"GET",
                    dataType:"json",
                   

                    success:function(data) {
                    	for (var i = 1; i <= data[0]['item_stock']; i++) {
                    		$('select[name="item_quantity"]').append('<option value="'+ i +'">' + i + '</option>');
                    	}
                    	$('#itemUnit').val(data[1]);
                    	$('input[name="item_unit"]').val(data[0]['measurement_unit_id']);
                    	$('input[name="item_cpu"]').val(data[0]['item_cost']).number(true, 2);
                    	var budget = $('input[name="item_cpu"]').val().replace(/\,/g,'') * $('select[name="item_quantity"]').val();
                    	$('input[name="item_cpi"]').val(budget).number(true, 2);
                    },
                   
                });
            } else {
                $('select[name="item_quantity"]').empty();
                $('#itemUnit').val("");
                $('input[name="item_unit"]').val("");
                $('input[name="item_cpu"]').val("");
                $('input[name="item_cpi"]').val("");
            }
        });

       
   
        var table = document.getElementsByName('items_dt')[0],
            rows = table.getElementsByTagName('tr'),
            text = 'innerText';
        for (var i = 0, len = rows.length; i < len; i++){
            rows[i].children[0][text] = i+1;
        }

    });

