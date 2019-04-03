 $(document).ready(function() {
      $('#supplierId').hide();
      $('#agencyName').hide();
      

        $('select[name="supplier_type"]').on('change', function(){
            var distType = $(this).val();
            if(distType == 1) {
              $('#agencyName').hide();
              $('#supplierId').hide();    
            }else if(distType == 2){
              $('#supplierId').hide();
              $('#agencyName').show();
              $('select[name="supplier_id"]').prop('readonly', false);
            }else if(distType == 3){
              $('#agencyName').hide();
              $('#supplierId').show();
                $.ajax({
                    url: '/pr/dist/get/',
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        
                      $.each(data, function(key, value){
                        $('select[name="supplier_id"]').append('<option value="'+ value['id'] +'">' + value['distributor_name'] + '</option>');

                      });
                    },
                    
                });
            }else{
              $('#agencyName').prop('readonly', true);
              $('#agencyName').hide();
              $('#supplierId').hide();
            }

        });
       
    });