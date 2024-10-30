jQuery(document).ready(function() {
  var configuration = {
	autoApply: true,
	opens: 'left',
    locale: {
      format: "DD-MM-YYYY",
      separator: " - ",
      applyLabel: "Toepassen",
      cancelLabel: "Anulleer",
      fromLabel: "Vanaf",
      toLabel: "Tot",
      customRangeLabel: "Custom",
      weekLabel: "W",
      daysOfWeek: ["Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"],
      monthNames: [
        "Januari",
        "Februari",
        "Maart",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Augustus",
        "September",
        "October",
        "November",
        "December"
      ],
      firstDay: 1
    }
  };
  jQuery("input#bukazu-datepicker").daterangepicker(configuration);

  if (jQuery(".bukazu_search_form").length) {
    // jQuery('.bukazu_search_form input[name="datepicker"]').daterangepicker(
    //   configuration
    // );
    // jQuery('.bukazu_search_form input[name="checkin"]').daterangepicker(
    //   configuration
    // );
    // jQuery('.bukazu_search_form input[name="checkout"]').daterangepicker(
    //   configuration
    // );
  }

  jQuery("input#bukazu-datepicker").on("apply.daterangepicker", function(
    ev,
    picker
  ) {
    jQuery('.bukazu_search_form input[name="checkin"]').val(
      picker.startDate.format("YYYY-MM-DD")
    );
    jQuery('.bukazu_search_form input[name="checkout"]').val(
      picker.endDate.format("YYYY-MM-DD")
    );
  });
});
