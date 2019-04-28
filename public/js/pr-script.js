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

        $('select[name="pr_code"]').on('change', function(){
            var office_id = $("select[name='pr_code'] option:selected").attr('data-office-id');
            var office_name = $("select[name='pr_code'] option:selected").attr('data-office-name');
            var requestor_name = $("select[name='pr_code'] option:selected").attr('data-requestor-name');
            var requestor_id = $("select[name='pr_code'] option:selected").attr('data-requestor-id');

            $('input[name="pr_office"]').val(office_id);
            $('#deptName').val(office_name);
            $('input[name="pr_requestor"]').val(requestor_id);
            $('#requestorName').val(requestor_name);


        });
       
    });