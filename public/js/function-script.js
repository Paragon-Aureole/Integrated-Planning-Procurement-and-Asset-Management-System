function multiply(){
    var totalBudget=parseFloat($('#itemQty').val())*parseFloat($('#itemCost').val());
    if (isNaN(totalBudget) ) {
      $("#itemBudget").val('0.00');
    }else{
      $("#itemBudget").val(totalBudget.toFixed(2));
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
    var bpercost=parseFloat($('#itemBudget').val())/parseFloat($('#itemQty').val());
    $("#itemCost").val(bpercost.toFixed(2));
}



function addCommas(nStr){
          nStr += '';
          x = nStr.split('.');
          x1 = x[0];
          x2 = x.length > 1 ? '.' + x[1] : '';
          var rgx = /(\d+)(\d{3})/;
          while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
          }
          return x1 + x2;
}

