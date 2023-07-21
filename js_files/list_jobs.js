$(".list_jobs")
  .find("td[data-id]")
  .on("click", function () {
    ////alert("Demo");
    var selected_col = $(this).attr("col-id");

    if (selected_col == "6") {
      var select_customer_id = $(this).attr("data-id");
      var dataString = "select_customer_id=" + select_customer_id;
      // alert(dataString);
      $.ajax({
        type: "POST",
        url: "post_process.php",
        data: dataString,
        success: function (data) {
          $("#jobs_modal").html(data);
          $("#jobs_modal").modal("show");
        },
      });
    }

    if (selected_col == "8") {
      var select_job_id = $(this).attr("data-id");
      var dataString = "select_job_id=" + select_job_id;
      //alert(dataString);
      $.ajax({
        type: "POST",
        url: "update_amount.php",
        data: dataString,
        success: function (data) {
          $("#drivers_modal").html(data);
          $("#drivers_modal").modal("show");
        },
      });
    }

    if (selected_col == "9") {
      var select_job_id = $(this).attr("data-id");
      var dataString = "select_job_id=" + select_job_id;
      //alert(dataString);
      $.ajax({
        type: "POST",
        url: "update_payment_status.php",
        data: dataString,
        success: function (data) {
          $("#update_job_modal").html(data);
          $("#update_job_modal").modal("show");
        },
      });
    }

    if (selected_col == "11") {
      var select_job_id = $(this).attr("data-id");
      var dataString = "select_job_id=" + select_job_id;
      //alert(dataString);
      $.ajax({
        type: "POST",
        url: "update_driver.php",
        data: dataString,
        success: function (data) {
          $("#drivers_modal").html(data);
          $("#drivers_modal").modal("show");
        },
      });
    }

    // Tipping this job now
    if (selected_col == "12") {
      //alert("Demo");

      var tip_job_id = $(this).attr("data-id");
      var dataString = "tip_job_id=" + tip_job_id;
      //alert(dataString);
      $.ajax({
        type: "POST",
        url: "load_comment.php",
        data: dataString,
        success: function (data) {
          $("#tip_job_modal").html(data);
          $("#tip_job_modal").modal("show");
        },
      });
    }

    if (selected_col == "13") {
      //alert("Demo");

      var status = $(this).attr("data-status");
      //alert(status);
      /*
			  if(status=='Job Done')
			  {
			  
			   $('#job_done').modal('show');
			  return false;
			  }
			  */
      var select_job_id = $(this).attr("data-id");
      var dataString =
        "select_job_id=" + select_job_id + "&selected_col=" + selected_col;
      //alert(dataString);
      $.ajax({
        type: "POST",
        url: "update_job.php",
        data: dataString,
        success: function (data) {
          $(this).css("backgroundColor", "#63EC62");
          $(this).html("Job Done");
          $("#update_job_modal").html(data);
          alert("Job Updated");
          window.location.href = "list_job.php";
        },
      });
    }
  });

// Delete button Request yes no

$("#confirm-delete").on("show.bs.modal", function (e) {
  $(this).find(".btn-ok").attr("href", $(e.relatedTarget).data("href"));
});

$("#filter_btn").click(function () {
  var filter_search = "filter_search";
  var job_type = $("#job_type").val();
  var job_id = $("#job_id").val();
  var paid = $("#paid").val();
  var post_code = $("#post_code").val();

  var from = $("#from").val();
  var to = $("#to").val();

  //alert(amount);
  var dataString =
    "filter_search=" +
    filter_search +
    "&job_type=" +
    job_type +
    "&paid=" +
    paid +
    "&post_code=" +
    post_code +
    "&from=" +
    from +
    "&to=" +
    to +
    "&job_id=" +
    job_id;
  //alert(dataString);

  console.log(dataString);

  //return false;
  $.ajax({
    type: "POST",
    url: "search_results.inc.php",
    data: dataString,
    success: function (data) {
      //console.log(data);
      // $('#gross').hide();
      $("#filter_results").html(data);
    },
  });
});

$("body").delegate(
  ".post_code,.name,.driver_id,.paid,.from,.to,.job_id",
  "keyup",
  function () {
    var from = $("#from").val();
    var to = $("#to").val();
    //alert(from);
    var filter_search = "filter_search";
    var post_code = $("#post_code").val();
    var name = $("#name").val();
    var driver_id = $("#driver_id").val();
    var paid = $("#paid").val();
    var search = $(this).val();
    var job_id = $("#job_id").val();

    if (search.length > 0) {
      var dataString =
        "filter_search=" +
        filter_search +
        "&from=" +
        from +
        "&post_code=" +
        post_code +
        "&name=" +
        name +
        "&driver_id=" +
        driver_id +
        "&paid=" +
        paid +
        "&to=" +
        to +
        "&job_id=" +
        job_id;
    } else {
      var dataString =
        "filter_search=" +
        filter_search +
        "&from=" +
        from +
        "&post_code=" +
        post_code +
        "&name=" +
        name +
        "&driver_id=" +
        driver_id +
        "&paid=" +
        paid +
        "&to=" +
        to +
        "&job_id=" +
        job_id;
    }
    console.log(dataString);
    $.ajax({
      type: "POST",
      url: "search_by_post_code.inc.php",
      data: dataString,
      success: function (data) {
        // console.log(data);
        // $('#gross').hide();
        $("#filter_results").html(data);
      },
    });
  }
);

//When user click on Start_date execute the filter
$(".to").datepicker({
  onSelect: function () {
    $(".to").datepicker("option", "dateFormat", "dd/mm/yy");
    var to = $("#to").val();
    $(".from").datepicker("option", "dateFormat", "dd/mm/yy");
    var from = $("#from").val();
    //alert(to);
    var filter_search = "filter_search";

    //alert(amount);
    var dataString =
      "filter_search=" + filter_search + "&to=" + to + "&from=" + from;
    //alert(dataString);
    //return false;
    $.ajax({
      type: "POST",
      url: "search_by_post_code.inc.php",
      data: dataString,
      success: function (data) {
        //console.log(data);
        // $('#gross').hide();
        $("#filter_results").html(data);
      },
    });
  },
});

$("#name").keyup(function () {});
$(".from").datepicker({
  onSelect: function () {
    $(".from").datepicker("option", "dateFormat", "dd/mm/yy");
    var from = $("#from").val();
    //alert(to);
    var filter_search = "filter_search";

    //alert(amount);
    var dataString = "filter_search=" + filter_search + "&from=" + from;
    //alert(dataString);
  },
});

//Button click code to hide or show delivery and collection jobs

$("#delivery_jobs").click(function () {
  $(".Collection").hide();
  $(".Delivery").show();
  $(".Exchange").hide();
});
$("#collection_jobs").click(function () {
  $(".Collection").show();
  $(".Delivery").hide();
  $(".Exchange").hide();
});
$("#exchange_jobs").click(function () {
  $(".Collection").hide();
  $(".Delivery").hide();
  $(".Exchange").show();
});
$("#all_jobs").click(function () {
  $(".Collection").show();
  $(".Delivery").show();
  $(".Exchange").show();
});

$(document).ready(function () {
  $("#jobs").DataTable({
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5", "print"],
  });
});
