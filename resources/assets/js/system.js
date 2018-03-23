// add another item script telecom in cutomers form

	$(document).ready(function() {
	    var max_fields      = 10; //maximum input boxes allowed
	    var wrapper         = $(".input_fields_wrap_1"); //Fields wrapper
	    var add_button      = $(".add_field_button_1"); //Add button ID

	    var x = 1; //initlal text box count
		$('input').keypress(function(event) { //prevent enter key to submit the form and coz we was have a bug when pressing enter key inside input field another telecom input added
			if (event.keyCode == 13) {				
				event.preventDefault();
			}
		});
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

// bootstrap-select telecom in cutomers form




// Start Ajax for Contracts index view
$(document).ready(function(){
	$('#contract-search-button').on('click', function(){
		var keyword = $('#contract_search').val();
		var newResult = "";
		if (keyword) {

			$.ajax({
				type: "GET",
				url:"/contracts_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, contract) {
						if (contract.printing_machines) {
							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/contracts/"+contract.id+"'>"+contract.code+"</a></td><td>"+contract.type+"</td><td>"+contract.start+"</td><td>"+contract.end+"</td><td>"+contract.status+"</td><td>"+contract.payment_system+"</td><td>"+contract.printing_machines[0].customer.name+"</td></tr>";
						} else {
							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/contracts/"+contract.id+"'>"+contract.code+"</a></td><td>"+contract.type+"</td><td>"+contract.start+"</td><td>"+contract.end+"</td><td>"+contract.status+"</td><td>"+contract.payment_system+"</td><td></td></tr>";
						}
					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}

			});
		}

	});
});

// End Ajax for Contracts index view

// Start Ajax for Customers index view
$(document).ready(function(){
	$('#customers-search-button').on('click', function(){
		var keyword = $('#customer_search').val();
		var newResult = "";
		if (keyword) {

			$.ajax({
				type: "GET",
				url:"/customers_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, customer) {
						newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/customers/"+customer.id+"'>"+customer.name+"</a></td><td>"+customer.code+"</td><td>"+customer.type+"</td><td>"+customer.governorate+"</td><td>"+customer.area+"</td><td>"+customer.telecoms[0].number+"</td></tr>"
					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}

			});
		}

	});
});
// End Ajax for Customers index view

//Start Ajax for contract _fom printing machine search
$(document).ready(function () {
	$("#contract-form-printing-machine-search-button").on("click", function(){
		var keyword = $("#printing-machine-search-field").val();
		var resultsTableBody = "";
		if (keyword) {
			$("#printing-machine-message").text("");
			$("#printing-machine-search-results-table-body").children().remove();

			$.ajax({
				type:"GET",
				url:"/contracts_pm_search/"+keyword,
				dataType:"json",
				success:function(results){
					$.each(results, function(key, printingMachine){
						resultsTableBody += "<tr><td>"+((printingMachine.customer)?printingMachine.customer.name:'')+"</td><td>"+printingMachine.code+"</td><td><button type='button' class='btn btn-success btn-xs printing-machine-select-button' data-priting-machine-id='"+printingMachine.id+"' data-customer-name='"+((printingMachine.customer)?printingMachine.customer.name:'')+"' data-printing-machine-code='"+printingMachine.code+"'> اختيار الآلة </button></td></tr>";
					});
					$("#printing-machine-search-results-table-body").append(resultsTableBody);
					$(".printing-machine-select-button").on("click", function(){
						pMId = $(this).attr("data-priting-machine-id");
						pMCode = $(this).attr("data-printing-machine-code");
						customerName = $(this).attr("data-customer-name");
						$("#printing-machine-selected-results-table-body").append("<tr><td>"+customerName+"</td><td>"+pMCode+"</td><td><button type='button' class='btn btn-danger btn-xs printing-machine-delete-button'> حذف الآلة </button><input type='hidden' name='assigned_machines_ids[]' value='"+pMId+"'></td></tr>");
						$(this).parent().parent().fadeOut('500', function(){
							$(this).remove();
						});
						$(".printing-machine-delete-button").on("click", function(){
							$(this).parent().parent().fadeOut('500', function(){
								$(this).remove();
							});
						});
					});
				},
			});
		} else {
			$("#printing-machine-message").text(" برجاء ادخال الكلمة المراد البحث عنها. ").css("color", "red");
		}
	});
	$(".printing-machine-delete-button").on("click", function(){
		$(this).parent().parent().fadeOut('500', function(){
			$(this).remove();
		});
	});
});
//End Ajax for contract _fom printing machine search

//Start contract add items and descriptions _form view
$(document).ready(function(){
    $("#contract-new-note-btb").click(function(){
        $("#contract-notes-wrapper").append("<div class='panel panel-default'> <div class='panel-heading clearfix'> <button type='button' class='btn btn-danger btn-xs pull-left contract-note-delete-btn'> حذف </button> </div><div class='panel-body'> <div class='form-group'> <label for='item_name'> البند </label> <input type='text' class='form-control' name='item_name[]' placeholder=' إدخل البند. ' value=''> </div><div class='form-group'> <label for='item_description'> تعريف البند </label> <textarea name='item_description[]' class='form-control' placeholder=' إدخل تعريف البند. '></textarea> </div></div></div>");

        $(".contract-note-delete-btn").click(function(){
            $(this).parent().parent().remove();
        });
    });

    $(".contract-note-delete-btn").click(function(){
        $(this).parent().parent().remove();
    });
});
//End contract add items and descriptions _form view

// Start Ajax for Employees index view
$(document).ready(function(){
	$('#employees-search-button').on('click', function(){
		var keyword = $('#employees_search').val();
		var newResult = "";
		if(keyword) {
			$.ajax({
				type: "GET",
				url:"/employees_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, employee) {
						if (employee.department && employee.the_department_that_he_manage_it) {
							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/employees/"+employee.id+"' target='_blank'>"+employee.user.name+"</a></td><td>"+employee.code+"</td><td>"+employee.job_title+"</td><td>"+employee.department.name+"</td><td>"+employee.the_department_that_he_manage_it.name+"</td><td>"+employee.date_of_hiring+"</td></tr>";
						} else if (employee.department) {
							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/employees/"+employee.id+"' target='_blank'>"+employee.user.name+"</a></td><td>"+employee.code+"</td><td>"+employee.job_title+"</td><td>"+employee.department.name+"</td><td> لا يوجد </td><td>"+employee.date_of_hiring+"</td></tr>";
						} else if (employee.the_department_that_he_manage_it) {
							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/employees/"+employee.id+"' target='_blank'>"+employee.user.name+"</a></td><td>"+employee.code+"</td><td>"+employee.job_title+"</td><td> لا يوجد </td><td>"+employee.the_department_that_he_manage_it.name+"</td><td>"+employee.date_of_hiring+"</td></tr>";
						} else {
							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/employees/"+employee.id+"' target='_blank'>"+employee.user.name+"</a></td><td>"+employee.code+"</td><td>"+employee.job_title+"</td><td> لا يوجد </td><td> لا يوجد </td><td>"+employee.date_of_hiring+"</td></tr>";
						}
					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}

			});
		}
	});
});
// End Ajax for Employees index view

// Start Ajax for Follow Up Card Special Report index view
$(document).ready(function(){
	$('#follow-up-card-special-report-search-button').on('click', function(){
		var keyword = $('#follow_up_card_special_reports_search').val();
		var newResult = "";
		if(keyword) {
			$.ajax({
				type: "GET",
				url:"/follow_up_card_special_reports_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, follow_up_card_special_report) {
						newResult += "<tr> <td>"+(index+1)+"</td><td>"+follow_up_card_special_report.id+"</td><td><a href='/follow_up_card_special_reports/"+follow_up_card_special_report.id+"'>"+follow_up_card_special_report.the_date+"</a></td><td>"+follow_up_card_special_report.readings_of_printing_machine+"</td><td>"+follow_up_card_special_report.indexation_number+"</td><td>"+follow_up_card_special_report.invoice_number+"</td><td>"+follow_up_card_special_report.the_payment+"</td></tr>"
					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}

			});
		}
	});
});
// End Ajax for Follow Up Card Special Report index view

// Start Ajax for Follow Up Card _form view
$(document).ready(function(){
	$("#follow-up-card-printing-machine-search-btn").on("click", function(){
		var keyword = $("#follow-up-card-printing-machine-search-field").val();
		$("#follow-up-card-printing-machine-search-p").text("");
		$("#follow-up-card-results-table-body ").children().remove();
		var resultsTableBody = '';
		if(keyword){
			$.ajax({
				type:"GET",
				url:"/follow_up_card_pm_search/"+keyword,
				dataType:"json",
				success:function(results){
					$.each(results, function(key, machine){
						resultsTableBody += "<tr><td>"+machine.code+"</td><td>"+((machine.customer)?machine.customer.name:'')+"</td><td><button type='button' class='btn btn-success btn-xs follow-up-card-select-printing-machine' data-printing-machine-id='"+machine.id+"' data-printing-machine-code='"+machine.code+"'> اختيار هذة الآلة </button></td></tr>";
					});
					$("#follow-up-card-results-table-body").append(resultsTableBody);
					$(".follow-up-card-select-printing-machine").on("click", function(){
						printingMachineCode = $(this).attr('data-printing-machine-code');
						printingMachineId = $(this).attr('data-printing-machine-id');
						$("#printing-machine-id").val(printingMachineId);
					});
				},
			});
		}else{
			$("#follow-up-card-printing-machine-search-p").text(" برجاء إدخال قيمة ").css('color','red');
		}
	});
});
// End Ajax for Follow Up Card _form view

// Sart Ajax for Follow Up Card index view
$(document).ready(function(){
	$('#follow-up-card-search-button').on('click', function(){
		var keyword = $('#follow_up_cards_search').val();
		var newResult = "";
		if(keyword) {
			$.ajax({
				type: "GET",
				url:"/follow_up_cards_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, follow_up_cards) {
						if(follow_up_cards.contract){
							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/follow_up_cards/"+follow_up_cards.id+"'>"+follow_up_cards.code+"</a></td><td><a href='/contracts/"+follow_up_cards.contract.id+"'>"+follow_up_cards.contract.code+"</a></td></tr>"
						}else{
							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/follow_up_cards/"+follow_up_cards.id+"'>"+follow_up_cards.code+"</a></td></tr>"
						}

					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}

			});
		}
	});
});
// End Ajax for Follow Up Card index view

// Start Ajax for Indexation index view
$(document).ready(function(){
	$('#indexatoin-search-button').on('click', function(){
		var keyword = $('#indexations_search').val();
		var newResult = "";
		if(keyword) {
			$.ajax({
				type: "GET",
				url:"/indexations_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, indexation) {
						if(indexation.reference) {

							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/indexations/"+indexation.id+"'>"+indexation.code+"</a></td><td>"+indexation.the_date+"</td><td>"+indexation.customer_approval+"</td><td>"+indexation.technical_manager_approval+"</td><td>"+indexation.warehouse_approval+"</td></tr>";
						}else {
							newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/indexations/"+indexation.id+"'>"+indexation.code+"</a></td><td>"+indexation.the_date+"</td><td>"+indexation.customer_approval+"</td><td>"+indexation.technical_manager_approval+"</td><td>"+indexation.warehouse_approval+"</td></tr>";
						}
					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}

			});
		}
	});
});
// End Ajax for Indexation index view

//Start Ajax for Installation Records _fom printing machine search
$(document).ready(function(){
	$("#installation-record-printing-machine-search-btn").on("click", function(){		
		var keyword = $("#installation-record-printing_machine_search_field").val();
		$("#printing-machine-search-p").text("");
		$("#installation-record-results-table-body ").children().remove();
		var resultsTableBody = '';
		if(keyword){
			$.ajax({
				type:"GET",
				url:"/installation_records_pm_search/"+keyword,
				dataType:"json",
				success:function(results){
					$.each(results, function(key, machine){
						resultsTableBody += "<tr><td>"+machine.code+"</td><td>"+((machine.customer)?machine.customer.name:'')+"</td><td><button type='button' class='btn btn-success btn-xs installation-record-select-printing-machine' data-printing-machine-id='"+machine.id+"' data-printing-machine-code='"+machine.code+"'> اختيار هذة الآلة </button></td></tr>";
					});
					$("#installation-record-results-table-body").append(resultsTableBody);
					$(".installation-record-select-printing-machine").on("click", function(){
						printingMachineCode = $(this).attr('data-printing-machine-code');
						printingMachineId = $(this).attr('data-printing-machine-id');
						$("#printing-machine-id").val(printingMachineId);
					});
				},
			});
		}else{
			$("#printing-machine-search-p").text(" برجاء إدخال قيمة ").css('color','red');
		}
	});
});
//End Ajax for Installation Records _fom printing machine search

//Start installation record add items and descriptions
$(document).ready(function(){
    $("#installation-record-new-items-btb").click(function(){
        $("#installation-record-items-wrapper").append("<div class='panel panel-default'> <div class='panel-heading clearfix'> <button type='button' class='btn btn-danger btn-xs pull-left installation-record-itmes-delete-btn'> حذف </button> </div><div class='panel-body'> <div class='form-group'> <label for='item_name'> العنصر </label> <input type='text' class='form-control' name='item_name[]' placeholder=' إدخل العنصر. ' value=''> </div><div class='form-group'> <label for='item_description'> تعريف العنصر </label> <textarea name='item_description[]' class='form-control' placeholder=' إدخل تعريف العنصر. '></textarea> </div></div></div>");

        $(".installation-record-itmes-delete-btn").click(function(){
            $(this).parent().parent().remove();
        });
    });

    $(".installation-record-itmes-delete-btn").click(function(){
        $(this).parent().parent().remove();
    });
});
//End installation record add items and descriptions

// Start Ajax for Invoices index view
$(document).ready(function(){
	$('#invoices-search-button').on('click', function(){
		var keyword = $('#invoice_search').val();
		var newResult = "";
		if(keyword) {
			$.ajax({
				type: "GET",
				url:"/invoices_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, invoice) {
						if(invoice.customer) {
							newResult += "<tr><td>"+(index+1)+"</td><td><a href='/invoices/"+invoice.id+"'>"+( (invoice.number)?(invoice.number):('لم يتم تعين الرقم حتى الآن') )+"</a></td><td>"+invoice.customer.name+"</td><td>"+invoice.type+"</td><td>"+invoice.issuer+"</td><td>"+invoice.order_number+"</td><td>"+invoice.delivery_permission_number+"</td><td>"+invoice.finance_check_out+"</td><td>"+invoice.total+"</td><td>"+invoice.release_date+"</td></tr>";
						} else {
							newResult += "<tr><td>"+(index+1)+"</td><td><a href='/invoices/"+invoice.id+"'>"+( (invoice.number)?(invoice.number):('لم يتم تعين الرقم حتى الآن') )+"</a></td><td></td><td>"+invoice.type+"</td><td>"+invoice.issuer+"</td><td>"+invoice.order_number+"</td><td>"+invoice.delivery_permission_number+"</td><td>"+invoice.finance_check_out+"</td><td>"+invoice.total+"</td><td>"+invoice.release_date+"</td></tr>";
						}

					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}

			});
		}
	});
});
// End Ajax for Invoices index view

// Start Ajax for Part Serial Number index view
$(document).ready(function(){
	$('#part-serial-number-search-button').on('click', function(){
		var keyword = $('#part_serial_numbers_search').val();
		var newResult = "";
		if (keyword) {
			$.ajax({
				type: "GET",
				url:"/part_serial_numbers_search/"+keyword,
				dataType: "json",
				success: function(results){

					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, part) {
						newResult += "<tr><td>"+(index+1)+"</td><td>"+part.part.name+"</td><td><a href='/part_serial_numbers/"+part.id+"'>"+part.serial_number+"</a></td><td>"+part.code+"</td><td>"+part.availability+"</td><td>"+part.status+"</td><td>"+part.date_of_entry+"</td><td>"+part.date_of_departure+"</td><td></tr>"
					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}
			});
		}
	});
});
// End Ajax for Part Serial Number index view

// Start Ajax for Parts index view
$(document).ready(function(){
	$('#parts-search-button').on('click', function(){
		var keyword = $('#parts_search').val();
		var newResult = "";
		if (keyword) {
			$.ajax({
				type: "GET",
				url:"/parts_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, part) {
						newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/parts/"+part.id+"'>"+part.name+"</a></td><td>"+part.code+"</td><td>"+part.type+"</td><td></td></tr>"
					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}

			});
		}

	});
});
// End Ajax for Parts index view

// Start Ajax for printing machines index view
$(document).ready(function(){
	$('#printing-machine-search-button').on('click', function(){
		var keyword = $('#printing_machyines_search').val();
		var newResult = "";
		$.ajax({
			type: "GET",
			url:"/printing_machines_search/"+keyword,
			dataType: "json",
			success: function(results){
				$("#my-table-body").fadeOut();
				$("#my-table-body").children().remove();
				$.each(results, function(index, machine) {
					if(machine.customer) {
						newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/printing_machines/"+machine.id+"'>"+machine.folder_number+"</a></td><td>"+machine.code+"</td><td>"+machine.model_prefix+"-"+machine.model_suffix+"</td><td>"+machine.customer.name+"</td> </tr>";
					} else {
						newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/printing_machines/"+machine.id+"'>"+machine.folder_number+"</a></td><td>"+machine.code+"</td><td>"+machine.model_prefix+"-"+machine.model_suffix+"</td><td></td> </tr>";
					}
				});
				$("#my-table-body").append(newResult);
				$("#my-table-body").fadeIn();
			}

		});

	});
});
// End Ajax for printing machines index view

// Start Ajax for References index view
$(document).ready(function(){
	$('#references-search-button').on('click', function(){
		var keyword = $('#references_search').val();
		var newResult = "";
		if(keyword) {
			$.ajax({
				type: "GET",
				url:"/references_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					$("#my-table-body").children().remove();
					$.each(results, function(index, reference) {
						newResult += "<tr> <td>"+(index+1)+"</td><td><a href='/references/"+reference.id+"'>"+reference.code+"</a></td><td>"+((reference.employee_who_receive_the_rereference)?((reference.employee_who_receive_the_rereference.user)?reference.employee_who_receive_the_rereference.user.name:''):'')+"</td><td>"+reference.type+"</td><td>"+reference.status+"</td><td>"+((reference.assigned_employee)?((reference.assigned_employee.user)?reference.assigned_employee.user.name:''):'')+"</td><td>"+reference.received_date+"</td><td><a href='/printing_machines/"+((reference.printing_machine)?reference.printing_machine.id:'')+"'>"+((reference.printing_machine)?reference.printing_machine.code:'')+"</a></td><td>"+((reference.printing_machine)?((reference.printing_machine.serial_number)?(reference.printing_machine.serial_number):('')):(''))+"</td><td>"+((reference.printing_machine)?((reference.printing_machine.customer)?((reference.printing_machine.customer.name)?(reference.printing_machine.customer.name):('')):('')):(''))+"</td><td>"+((reference.reviewed_by_the_chief_engineer)?(reference.reviewed_by_the_chief_engineer):(''))+"</td></tr>";
					});
					$("#my-table-body").append(newResult);
					$("#my-table-body").fadeIn();
				}

			});
		}
	});
});
// End Ajax for References index view

//Start References Searching on Printing machine on _from view
$(document).ready(function(){
	$("#reference-printing-machine-search-btn").on("click", function(){
		var keyword = $("#reference-printing-machine-search-field").val();
		$("#reference-printing-machine-search-p").text("");
		$("#reference-results-table-body ").children().remove();
		var resultsTableBody = '';
		if(keyword){
			$.ajax({
				type:"GET",
				url:"/references_pm_search/"+keyword,
				dataType:"json",
				success:function(results){
					$.each(results, function(key, machine){
						resultsTableBody += "<tr><td>"+machine.code+"</td><td>"+((machine.customer)?machine.customer.name:'')+"</td><td>"+((machine.assigned_employees)?((machine.assigned_employees[0])?((machine.assigned_employees[0].user)?((machine.assigned_employees[0].user.name)?(machine.assigned_employees[0].user.name):('')):('')):('')):(''))+"</td><td><button type='button' class='btn btn-success btn-xs select-printing-machine' data-printing-machine-id='"+machine.id+"' data-printing-machine-code='"+machine.code+"'> اختيار هذة الآلة </button></td></tr>";
					});
					$("#reference-results-table-body").append(resultsTableBody);
					$(".select-printing-machine").on("click", function(){
						printingMachineCode = $(this).attr('data-printing-machine-code');
						printingMachineId = $(this).attr('data-printing-machine-id');
						$("#printing-machine-id").val(printingMachineId);
					});
				},
			});
		}else{
			$("#reference-printing-machine-search-p").text(" برجاء إدخال قيمة ").css('color','red');
		}
	});
});
//End References Searching on Printing machine on _from view

//Start References add malunctions and works were done on it _form view
$(document).ready(function(){
    $("#reference-new-malfunction-btb").click(function(){
        $("#reference-malfunction-wrapper").append("<div class='panel panel-default'> <div class='panel-heading clearfix'> <button type='button' class='btn btn-danger btn-xs pull-left reference-malfunction-delete-btn'> حذف </button> </div><div class='panel-body'> <div class='form-group'> <label for='malfunction_type'> نوع العطل </label> <input type='text' class='form-control' name='malfunction_type[]' placeholder=' إدخل نوع العطل. ' value=''> </div><div class='form-group'> <label for='works_were_done'> الأعمال التي تم تنفيذها </label> <textarea name='works_were_done[]' class='form-control' placeholder=' إدخل الأعمال التي تم تنفيذها. '></textarea> </div></div></div>");

        $(".reference-malfunction-delete-btn").click(function(){
            $(this).parent().parent().remove();
        });
    });

    $(".reference-malfunction-delete-btn").click(function(){
        $(this).parent().parent().remove();
    });
});
//End References add malunctions and works were done on it _form view

//Start Datatable
$(document).ready(function() {
    if ($('.standart-datatable').DataTable) {
		
			
			// Setup - add a text input to each footer cell
			$('.standart-datatable tfoot th').each( function (i) {
				var title = $('.standart-datatable thead th').eq( $(this).index() ).text();
				$(this).html( '<input class="form-control" type="text" placeholder="بحث بـ'+title+'" data-index="'+i+'" style="width: 50%"/>' );
			} );
		  
			// DataTable
			var theTable = $('.standart-datatable').DataTable(
				{
					
					"searching": true,
					"lengthChange": false,
					// "scrollY": '500px',
					"paging": false,
					dom: 'Bfrtip',
					buttons: [
						'excel', 'print'
					],
					
				});
			
		 
			// Filter event handler
			$( theTable.table().container() ).on( 'keyup', 'tfoot input', function () {
				theTable
					.column( $(this).data('index') )
					.search( this.value )
					.draw();
			} );
			$(".dataTables_filter, .dataTables_info").css('display','none');
	}
	
});
//End Datatable
