
$(document).ready(function () {
  $('#btn_submit').on('click', function (e) {
    e.preventDefault();
    displayBekkel(e);
  });
  // var bekkel = $("name=[item_schedule[0]]");

  // $("#itemQty").on("blur", function(){
  //   var bekkel = $("#itemQty").val();
  //   console.log("Hello, this thing is running." + bekkel + "is item quantity");
  // });

  function displayBekkel (e) {
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
    // console.log(schedule_total + "is the schedule_total " + i);
    }
    if ($("[name=item_code] option:selected").attr('name') == 1) {
<<<<<<< HEAD
      if (itemqtyCount != itemqtyGoal) {
        console.log($("[name=item_code] option:selected").attr('name'));
        console.log("incomplete entries, please distribute scheduled items properly.");
        // return false;
      } else {
        console.log('blyat');
        $("#needs-validation").submit();
        // return true;
=======
      if (itemqtyCount < itemqtyGoal) {
        console.log($("[name=item_code] option:selected").attr('name'));
        console.log("incomplete entries, please distribute scheduled items properly.");
        return false
      }else {
        return true
>>>>>>> 1fe20fc8521c20e038dcea78271ff4dc8f910dd1
      }
    } else {
      console.log($("[name=item_code] option:selected").attr('name'));
      console.log(itemqtyCount + " total");
<<<<<<< HEAD
      $("#needs-validation").submit();
      // return true;
=======
      return true
>>>>>>> 1fe20fc8521c20e038dcea78271ff4dc8f910dd1
    }
  }

});
