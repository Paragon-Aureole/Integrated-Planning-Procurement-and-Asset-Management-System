$(document).ready(function () {
    $('.money').number( true, 2 );
    $('.qty').number( true);

    $("button[name='update_supplier']").click(function() {
    var supplier_id = $(this).attr('data-supplierid');
    console.log(supplier_id);
    
        $.get("http://ipams.test/supplier/"+supplier_id+"/edit", function(data, status){

            console.log(supplier_id);
            $( "input[name='supplier_name2']" ).val(data[0]['supplier_name']);
            $( "input[name='supplier_address2']" ).val(data[0]['supplier_address']);
            $( "input[name='canvasser_name2']" ).val(data[0]['canvasser_name']);
            
            var items = data[1];
            var markup ='';
            $('table[name="edit_table"] tbody tr').remove();
                items.forEach(function(entry, index) {
                    markup += '<tr> <td><input type="hidden" name="item_id[]" value="'+entry['id']+'" required> '+entry['pr_item']['ppmp_item']['item_description']+'</td> <td><input class="qty form-control form-control-sm" id="itemQty2'+index+'" name="item_quantity2[]" value="'+entry['pr_item']['item_quantity']+'" readonly></td> <td>'+entry['pr_item']['ppmp_item']['measurement_unit']['unit_code']+'</td> <td><input oninput="multiply3('+index+');" name="unit_price2[]" id="itemCost2'+index+'" value="'+entry['final_cpu']+'" class="money form-control form-control-sm" required></td> <td><input name="item_price2[]" id="itemBudget2'+index+'" value="'+entry['final_cpi']+'" class="money form-control form-control-sm" readonly></td> </tr>';
                });
                $(markup).appendTo('table[name="edit_table"] tbody');
                
            });

        $( "form[name='s_update']" ).attr("action", "http://ipams.test/supplier/"+supplier_id+"");
    });

    $("button[name='delete_supplier']").click(function() {
        var supplier_id = $(this).attr('data-supplierid');
        var supplier_name = $(this).attr('data-suppliername');
        // console.log(user_id);
        $("[name='sId']").val(supplier_id);
        $("[name='sName']").val(supplier_name);
        $("form[name='deactivation_reason']").attr('action', 'http://ipams.test/supplier/delete/'+supplier_id);
    });
});