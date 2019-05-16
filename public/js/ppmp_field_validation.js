$(document).ready(function () {
  $('.money').number( true, 2 );
  $('.qty').number( true);


  
  $('#btn_submit').on('click', function (e) {
    e.preventDefault();
    displayBekkel(e);
  });

  function displayBekkel(e) {
    var itemqtyCount = 0;
    var itemqtyGoal = $("#itemQty").val();
    for (var i = 0; i < 12; i++) {
      var schedule_total = parseInt($("[name='item_schedule[" + i + "]']").val());
      if (isNaN(schedule_total)) {
        schedule_total = 0;
        itemqtyCount += schedule_total;
      } else {
        itemqtyCount += schedule_total;
      }
    }
    if ($("[name=item_code] option:selected").attr('name') == 1) {
      if (itemqtyCount != itemqtyGoal) {
        for (let index = 0; index < 12; index++) {
          $("[name='item_schedule[" + index + "]']").addClass("is-invalid");
          $("#schedFeedback" + index).html("");
        }
        $("#feedback").show();
        $("#qtyFeedback").html("");
        $("#itemQty").addClass("is-invalid");
        
      } else {
          if($("#itemQty").val() < 1){
            $("#qtyFeedback").html("Quantity should be greater than zero.");
            $("#itemQty").addClass("is-invalid");
            e.preventDefault();
          }else if($("#itemCost").val() < 1){
            $("#itemCost-Feedback").html("Cost per Unit should be greater than zero.");
            $("#itemCost").addClass("is-invalid");
            e.preventDefault();
          }else if($("#itemBudget").val() < 1){
            $("#itemBudget-Feedback").html("Cost per Unit should be greater than zero.");
            $("#itemBudget").addClass("is-invalid");
            e.preventDefault();
          }else{
            submitForm();
          }
      }
    } else {
      if($("#itemQty").val() < 1){
        $("#qtyFeedback").html("Quantity should be greater than zero.");
        $("#itemQty").addClass("is-invalid");
        e.preventDefault();
      }else if($("#itemCost").val() < 1){
        $("#itemCost-Feedback").html("Cost per Unit should be greater than zero.");
        $("#itemCost").addClass("is-invalid");
        e.preventDefault();
      }else if($("#itemBudget").val() < 1){
        $("#itemBudget-Feedback").html("Cost per Unit should be greater than zero.");
        $("#itemBudget").addClass("is-invalid");
        e.preventDefault();
      }else{
        submitForm();
      }
      
    }
  }

  function submitForm(){
    $("[name='ppmp_form']").submit();
  }





});