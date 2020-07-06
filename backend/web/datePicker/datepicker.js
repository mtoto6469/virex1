
$(document).ready(function() {
    $("#datepicker0").datepicker();

    $("#datepicker1").datepicker();
    $("#datepicker1btn").click(function(event) {
        event.preventDefault();
        $("#datepicker1").focus();
    })

    $("#datepicker2").datepicker({
        // showOtherMonths: true,
        // selectOtherMonths: true
        changeMonth: true,
        changeYear: true
    });

    $("#datepicker3").datepicker({
        numberOfMonths: 3,
        showButtonPanel: true

    });

    $("#datepicker4").datepicker({
        changeMonth: true,
        changeYear: true
    });

    $("#datepicker5").datepicker({
        minDate: 0,
        maxDate: "+14D"

    });

    $("#datepicker6").datepicker({
        isRTL: true,
        dateFormat: "d/m/yy"

    });

    $("#datepicker7").datepicker({
        changeMonth: true,
        changeYear: true

    });
    $("#datepicker8").datepicker({
        changeMonth: true,
        changeYear: true

    });



});
/**
 * Created by gholami on 11/21/2017.
 */
