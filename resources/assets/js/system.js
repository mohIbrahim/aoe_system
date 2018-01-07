$( document ).ready(function() {
    $("#datepicker").datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+0",
	});

    alert('abs');
	$( "#datepicker2" ).datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+5",
	});

	$( "#datepicker3" ).datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+5",
	});

	$( "#datepicker4" ).datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+5",
	});

	$( "#datepicker5" ).datepicker({
	    changeMonth: true,
	    changeYear: true ,
	    yearRange: "-115:+5",
	});
});




// add another item script

	$(document).ready(function() {
	    var max_fields      = 10; //maximum input boxes allowed
	    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	    var add_button      = $(".add_field_button"); //Add button ID

	    var x = 1; //initlal text box count
	    $(add_button).click(function(e){ //on add input button click
	        e.preventDefault();
	        if(x < max_fields){ //max input box allowed
	            x++; //text box increment
	            $(wrapper).append('<div><input type="file" name="images[]" class="form-control"/><a href="#" class="remove_field btn btn-xs btn-danger">حذف</a></div>'); //add input box
	        }
	    });

	    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); x--;
	    })
	});

// bootstrap-select




// add another item script

	$(document).ready(function() {
	    var max_fields      = 10; //maximum input boxes allowed
	    var wrapper         = $(".input_fields_wrap_1"); //Fields wrapper
	    var add_button      = $(".add_field_button_1"); //Add button ID

	    var x = 1; //initlal text box count
	    $(add_button).click(function(e){ //on add input button click
	        e.preventDefault();
	        if(x < max_fields){ //max input box allowed
	            x++; //text box increment
	            $(wrapper).append('<div class="form-group"><input type="text" name="telecom[]" class="form-control" placeholder=" إدخل رقم آخر. "/><a href="#" class="remove_field btn btn-xs btn-danger">حذف</a></div>'); //add input box
	        }
	    });

	    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); x--;
	    })
	});

// bootstrap-select

//select search
$(function(){
    $('.selectpicker').selectpicker({
    });
});
