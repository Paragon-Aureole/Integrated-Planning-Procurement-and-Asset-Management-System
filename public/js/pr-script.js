 $(document).ready(function() {
      $('#supplierId').hide();
      $('#agencyName').hide();
        $('select[name="pr_code"]').on('change', function(){
            var ppmpId = $(this).val();
            if(ppmpId) {
                $.ajax({
                    url: '/pr/ppmp/get/'+ppmpId,
                    type:"GET",
                    dataType:"json",
                   

                    success:function(data) {
                      // console.log(data);
                      $('#deptId').val(data[0]);
                      $('#sectionId').val(data[1]);
                      $('input[name="pr_budget"]').val(addCommas(data[2]));
                      $('input[name="pr_requestor"]').val(data[3]['id']);
                      $('#prRequestor').val(data[3]['signatory_name']);

                      if ($('input[name="pr_budget"]').val() < 1) {
                        $('#prBtn').prop('disabled', true);
                      }else{
                        $('#prBtn').prop('disabled', false);
                      }
                      
                    },
                   
                });
            } else {
                $('#deptId').val('');
                $('#sectionId').val('');
                $('input[name="pr_budget"]').val('');
                $('input[name="pr_requestor"]').val('');
                $('#prRequestor').val('');
                $('#prBtn').prop('disabled', true);
            }

        });

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