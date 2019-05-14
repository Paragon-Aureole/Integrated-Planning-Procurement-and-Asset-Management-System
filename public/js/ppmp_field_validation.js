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
        console.log('Ok for submimssion');
       submitForm();
      }
    } else {
      submitForm();
    }
  }

  function submitForm(){
    $("[name='ppmp_form']").submit();
  }

  $('input[name="item_quantity"]').inputFilter(function(value) {
    var test_val = /^\d*$/.test(value);
    return test_val;
  });



});