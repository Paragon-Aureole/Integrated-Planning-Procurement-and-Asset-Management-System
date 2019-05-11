
function multiply(){
    var a = $("#itemCost").val().replace(/\,/g,'');

    var totalBudget=parseFloat($('#itemQty').val())*parseFloat(a);
    if (isNaN(totalBudget) ) {
      $("#itemBudget").val('0.00');
    }else{
      $("#itemBudget").val(totalBudget).simpleMoneyFormat();
    }
    
}

multiply2 = function(id) {
  var totalPrice=parseFloat($('#itemQty'+ id).val())*parseFloat($('#itemCost' + id).val());
  if (isNaN(totalPrice) ) {
    $("#itemBudget" + id).val('0.00');
  }else{
    $("#itemBudget" + id).val(totalPrice.toFixed(2));
  }
  
}

function divide(){
    var b = $("#itemBudget").val().replace(/\,/g,'');
    var bpercost=parseFloat(b)/parseFloat($('#itemQty').val());
    $("#itemCost").val(bpercost).simpleMoneyFormat();
}



