$(document).ready(function() {

		 $("#itemDesc").on('input', function(e){
            
                
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

            $('select[name="item_quantity"]').empty();
            var idddd = $('[name="item_description"]').val();


            if(idddd) {
                $.ajax({
                    url: 'http://ipams.test/pr/item/get/'+idddd,
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


    });

