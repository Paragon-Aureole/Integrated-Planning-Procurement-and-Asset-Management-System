
function multiply(){
    var a = $("#itemCost").val().replace(/\,/g,'');
    var totalBudget=parseFloat($('#itemQty').val())*parseFloat(a);
    if (isNaN(totalBudget) ) {
      $("#itemBudget").val('0.00');
    }else{
      $("#itemBudget").val(totalBudget).number( true, 2 );
    }
    
}

multiply2 = function(id) {
  var a = $("#itemCost"+ id).val().replace(/\,/g,'');
  var totalPrice=parseFloat($('#itemQty'+ id).val())*parseFloat(a);
  if (isNaN(totalPrice) ) {
    $("#itemBudget" + id).val('0.00');
  }else{
    $("#itemBudget" + id).val(totalPrice).number( true, 2 );
  }
  
}

multiply3 = function(id) {
  var a = $("#itemCost2"+ id).val().replace(/\,/g,'');
  var totalPrice=parseFloat($('#itemQty2'+ id).val())*parseFloat(a);
  if (isNaN(totalPrice) ) {
    $("#itemBudget2" + id).val('0.00');
  }else{
    $("#itemBudget2" + id).val(totalPrice).number( true, 2 );
  }
  
}

function divide(){
    var b = $("#itemBudget").val().replace(/\,/g,'');
    var bpercost=parseFloat(b)/parseFloat($('#itemQty').val());
    $("#itemCost").val(bpercost).number( true, 2 );
}



