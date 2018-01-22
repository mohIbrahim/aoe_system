$( document ).ready(function() {
    $("#datepicker").datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+0",
        dateFormat: "yy-mm-dd",
	});

	$( "#datepicker2" ).datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+5",
        dateFormat: "yy-mm-dd",
	});

	$( "#datepicker3" ).datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+5",
        dateFormat: "yy-mm-dd",
	});

	$( "#datepicker4" ).datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+5",
        dateFormat: "yy-mm-dd",
	});

	$( "#datepicker5" ).datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+5",
        dateFormat: "yy-mm-dd",
	});
	$( "#datepicker6" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-38:+1",
        showButtonPanel: true,
        dateFormat: 'yy',
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
	});
});
