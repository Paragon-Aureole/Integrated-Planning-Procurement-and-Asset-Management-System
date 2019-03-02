  function multiply(){
    var totalBudget=parseFloat($('#itemQty').val())*parseFloat($('#itemCost').val());
    $("#itemBudget").val(totalBudget);
  }