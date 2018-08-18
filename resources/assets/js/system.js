//Start Datatable
var standardTable;
$(document).ready(function() {
    if ( $('.standard-datatable').DataTable ) {
		// Setup - add a text input to each footer cell
		$('.standard-datatable tfoot th').each( function (i) {
			var title = $('.standard-datatable thead th').eq( $(this).index() ).text();
			$(this).css('max-width', '60px');
			$(this).html( '<input class="form-control" type="text" placeholder="بحث بـ'+title+'" data-index="'+i+'" style="width: 50%"/>' );
		} );		
		// DataTable
		var theTable = $('.standard-datatable').DataTable(
			{	
				"searching": true,
				"lengthChange": true,
				// "scrollY": "1000px",
				// "scrollCollapse": true,
				"paging": false,
				"ordering": true,
				"info": true,
				"language": {
					"search": "بحث: ",
					"info": "المعروض _START_ إلى _END_ ",
					"infoEmpty": "لا توجد سجلات متاحة",
					"zeroRecords": "نأسف لم يتم العثور على شيء",
					"infoFiltered": "(تمت تصفيته من إجمالي _MAX_ من السجلات)",
					},
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
		$(".dataTables_filter, .dataTables_info").css({'float':'left','display':'block'});
		standardTable = theTable;
	}	
});
//End Datatable

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

// Start add another upload file fields pdf for indexation, visits, references and contracts
$(document).ready(function() {
	var upload_files_pdf_max_fields      = 10; //maximum input boxes allowed
	var upload_files_pdf_wrapper         = $(".upload_files_pdf_input_fields_wrap_1"); //Fields wrapper
	var upload_files_pdf_add_button      = $(".upload_files_pdf_add_field_button_1"); //Add button ID

	var x = 1; //initlal text box count
	$('input').keypress(function(event) { //prevent enter key to submit the form and coz we was have a bug when pressing enter key inside input field another telecom input added
		if (event.keyCode == 13) {
			event.preventDefault();
		}
	});
	$(upload_files_pdf_add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < upload_files_pdf_max_fields){ //max input box allowed
			x++; //text box increment
			

			$(upload_files_pdf_wrapper).append('<div class="form-group"><input type="file" class="form-control" id="upload_files_pdf" name="upload_files_pdf[]"><a href="#" class="upload_files_pdf_remove_field btn btn-xs btn-danger">حذف</a></div>'); //add input box
		}
	});

	$(upload_files_pdf_wrapper).on("click",".upload_files_pdf_remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
// End add another upload file fields pdf for indexation, visits, references and contracts

// Start add another upload file fields img for indexation, visits, references and contracts
$(document).ready(function() {
	var upload_files_img_max_fields      = 10; //maximum input boxes allowed
	var upload_files_img_wrapper         = $(".upload_files_img_input_fields_wrap_1"); //Fields wrapper
	var upload_files_img_add_button      = $(".upload_files_img_add_field_button_1"); //Add button ID

	var x = 1; //initlal text box count
	$('input').keypress(function(event) { //prevent enter key to submit the form and coz we was have a bug when pressing enter key inside input field another telecom input added
		if (event.keyCode == 13) {
			event.preventDefault();
		}
	});
	$(upload_files_img_add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < upload_files_img_max_fields){ //max input box allowed
			x++; //text box increment
			

			$(upload_files_img_wrapper).append('<div class="form-group"><input type="file" class="form-control" id="upload_files_img" name="upload_files_img[]"><a href="#" class="upload_files_img_remove_field btn btn-xs btn-danger">حذف</a></div>'); //add input box
		}
	});

	$(upload_files_img_wrapper).on("click",".upload_files_img_remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
// End add another upload file fields img for indexation, visits, references and contracts

/**
 * /////////////////////
 * ///// CONTRACTS /////
 * /////////////////////
 */

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
					standardTable.clear();
					$.each(results, function(index, contract) {
						standardTable.row.add([
												(index+1),
												"<a href='/contracts/"+contract.id+"'>"+contract.code+"</a>",
												contract.type,
												contract.start,
												contract.end,
												contract.status,
												contract.payment_system,
												(contract.printing_machines[0])?((contract.printing_machines[0].customer)?(contract.printing_machines[0].customer.name):('')):(''),
												contract.price,
											]);
					});
					standardTable.draw();
					$("#my-table-body").fadeIn();
				}
			});
		}
	});
});
// End Ajax for Contracts index view

//Start Ajax for contract _form printing machine search
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
						resultsTableBody += "<tr><td>"+((printingMachine.customer)?printingMachine.customer.name:'')+"</td><td>"+printingMachine.code+"</td><td>"+printingMachine.serial_number+"</td><td><button type='button' class='btn btn-success btn-xs printing-machine-select-button' data-priting-machine-id='"+printingMachine.id+"' data-customer-name='"+((printingMachine.customer)?printingMachine.customer.name:'')+"' data-printing-machine-code='"+printingMachine.code+"' data-printing-machine-serial_number='"+printingMachine.serial_number+"'> اختيار الآلة </button></td></tr>";
					});
					$("#printing-machine-search-results-table-body").append(resultsTableBody);
					$(".printing-machine-select-button").on("click", function(){
						pMId = $(this).attr("data-priting-machine-id");
						pMCode = $(this).attr("data-printing-machine-code");
						pMSerialNumber = $(this).attr("data-printing-machine-serial_number");
						customerName = $(this).attr("data-customer-name");
						$("#printing-machine-selected-results-table-body").append("<tr><td>"+customerName+"</td><td>"+pMCode+"</td><td>"+pMSerialNumber+"</td><td><button type='button' class='btn btn-danger btn-xs printing-machine-delete-button'> حذف الآلة </button><input type='hidden' name='assigned_machines_ids[]' value='"+pMId+"'></td></tr>");
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

// Start Contract released or end during a certain period report.
$(function(){
	$("#contract-released-or-end-during-a-certain-period-search-btn").on("click", function(){
		var start = $("#datepicker").val();
		start = start.replace(/\//g,"-");
		var end = $("#datepicker2").val();
		end = end.replace(/\//g,"-");
		var isEndDate = $("#is-end-date").prop('checked');
		if (start != "" && end != "" ) {
			$("#contract-released-or-end-during-a-certain-period-error-validator").css("display", "none");
			$.ajax({
				type: "GET",
				url: "/contracts_released_or_end_during_a_certain_period_search/"+start+"/"+end+"/"+isEndDate,
				dataType: "json",
				beforeSend: function(){
					$("#contract-released-or-end-during-a-certain-period-loading-message").append("<h4 style='color: #1877a3'>جاري البحث... </h4>");
				},
				success: function(results){
					$("#contract-released-or-end-during-a-certain-period-table-body").fadeOut();
					standardTable.clear();
					$.each(results, function(index, contract){
						standardTable.row.add([
												(index+1),
												"<a href='/contracts/"+contract.id+"'>"+contract.code+"</a>",
												contract.type,
												contract.start,
												contract.end,
												contract.status,
												contract.payment_system,
												((contract.printing_machines)
												?((contract.printing_machines[0])
													?((contract.printing_machines[0].customer)
														?(contract.printing_machines[0].customer.name)
														:(''))
													:(''))
												:('')),
												contract.price,
												
											]);
					});
					$("#contract-released-or-end-during-a-certain-period-loading-message").empty();
					standardTable.draw();
					$("#contract-released-or-end-during-a-certain-period-table-body").fadeIn();
				},
				error: function(){
					$("#contract-released-or-end-during-a-certain-period-loading-message").append("<h4>خطاء في الإتصال الرجاء إعادة تحميل الصفحة</h4>");
				},
			});
		}else {
			$("#contract-released-or-end-during-a-certain-period-error-validator").css("display", "block");
		}
	});
});
// End Contract released or end during a certain period report.

/**
 * /////////////////////
 * ///// CUSTOMERS /////
 * /////////////////////
 */

// Start Ajax for Customers index view
$(document).ready(function(){
	$('#customers-search-button').on('click', function(){
		var keyword = $('#customer_search').val();
		if (keyword) {
			$.ajax({
				type: "GET",
				url:"/customers_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#my-table-body").fadeOut();
					standardTable.clear();
					$.each(results, function(index, customer) {
						standardTable.row.add([
												(index+1),
												"<a href='/customers/"+customer.id+"'>"+customer.name+"</a>",
												customer.code,
												customer.administration,
												customer.type,
												customer.governorate,
												customer.area,
												( (customer)?((customer.telecoms[0])?(customer.telecoms[0].number):('')):('') ),
											]);
					});
					standardTable.draw();
					$("#my-table-body").fadeIn();
				}

			});
		}

	});
});
// End Ajax for Customers index view

/**
 * /////////////////////
 * ///// EMPLOYEES /////
 * /////////////////////
 */

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
					standardTable.clear();
					$.each(results, function(index, employee) {
						standardTable.row.add([
							(index+1),
							"<a href='/employees/"+employee.id+"' target='_blank'>"+((employee.user)?(employee.user.name):(''))+"</a>",
							employee.code,
							employee.job_title,
							((employee.department)?(employee.department.name):('لا يوجد')),
							((employee.the_department_that_he_manage_it)?(employee.the_department_that_he_manage_it.name):('لا يوجد')),
							employee.date_of_hiring,
						]);
					});
					standardTable.draw();
					$("#my-table-body").fadeIn();
				}
			});
		}
	});
});
// End Ajax for Employees index view

/**
 * //////////////////////////////////////////
 * ///// FOLLOW UP CARDS SPECIAL REPORT /////
 * //////////////////////////////////////////
 */

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
					standardTable.clear();
					$.each(results, function(index, follow_up_card_special_report) {
						standardTable.row.add([
												(index+1),
												follow_up_card_special_report.id,
												"<a href='/follow_up_card_special_reports/"+follow_up_card_special_report.id+"'>"+follow_up_card_special_report.the_date+"</a>",
												follow_up_card_special_report.readings_of_printing_machine,
												follow_up_card_special_report.indexation_number,
												follow_up_card_special_report.invoice_number,
												follow_up_card_special_report.the_payment
											]);
					});
					standardTable.draw();
					$("#my-table-body").fadeIn();
				}
			});
		}
	});
});
// End Ajax for Follow Up Card Special Report index view

/**
 * ///////////////////////////
 * ///// FOLLOW UP CARDS /////
 * ///////////////////////////
 */

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
					standardTable.clear();
					$.each(results, function(index, follow_up_card) {
						standardTable.row.add([
							(index+1),
							"<a href='/follow_up_cards/"+follow_up_card.id+"'>"+follow_up_card.code+"</a>",
							(follow_up_card.printing_machine !== null)?((follow_up_card.printing_machine.customer !== null)?(follow_up_card.printing_machine.customer.name):('')):(''),
							(follow_up_card.contract)?("<a href='/contracts/"+follow_up_card.contract.id+"'>"+follow_up_card.contract.code+"</a>"):(''),
							(follow_up_card.printing_machine !== null)?(follow_up_card.printing_machine.serial_number):(''),
							(formatDate(follow_up_card.updated_at) || ''),
						]);
					});
					standardTable.draw();
					$("#my-table-body").fadeIn();
				}
			});
		}
	});
});
// End Ajax for Follow Up Card index view

// Start Follow up Card visits not done on time report view
$(function(){
	$("#follow-up-card-visits-not-done-report-search-btn").on("click", function(){
		var start = $("#datepicker").val();
		start = start.replace(/\//g,"-");
		var end = $("#datepicker2").val();
		end = end.replace(/\//g,"-");
		if (start != "" && end != "" ) {
			$("#follow-up-card-visits-not-done-report-error-validator").css("display", "none");
			$.ajax({
				type: "GET",
				url: "/visits_not_done_on_time_for_follow_up_cards_report_search/"+start+"/"+end,
				dataType: "json",
				beforeSend: function(){
					$("#follow-up-card-visits-not-done-report-loading-message").append("<h4 style='color: #1877a3'>جاري البحث... </h4>");
				},
				success: function(results){
					$("#follow-up-card-visits-not-done-report-table-body").fadeOut();
					standardTable.clear();
					$.each(results, function(key, value){
						standardTable.row.add([
												key+1,
												"<a href='/customers/"+value.customerId+"' target='_blank'>"+value.customerName+"</a>",
												"<a href='/printing_machines/"+value.printingMachineId+"' target='_blank'>"+value.printingMachineCode+"</a>",
												value.assignedEmployees,
												"<a href='/follow_up_cards/"+value.followUpCardId+"' target='_blank'>"+value.followUpCardCode+"</a>",
											]);
					});
					$("#follow-up-card-visits-not-done-report-loading-message").empty();
					standardTable.draw();
					$("#follow-up-card-visits-not-done-report-table-body").fadeIn();
				},
				error: function(){
					$("#follow-up-card-visits-not-done-report-loading-message").append("<h4>خطاء في الإتصال الرجاء إعادة تحميل الصفحة</h4>");
				},
			});
		}else {
			$("#follow-up-card-visits-not-done-report-error-validator").css("display", "block");
		}
	});
});
// End Follow up Card visits not done on time report view

/**
 * ///////////////////////
 * ///// INDEXATIONS /////
 * ///////////////////////
 */
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
					standardTable.clear();
					$.each(results, function(index, indexation) {
						standardTable.row.add([
												(index+1),
												"<a href='/indexations/"+indexation.id+"'>"+indexation.code+"</a>",
												
												((indexation.printing_machine)?((indexation.printing_machine.customer)?((indexation.printing_machine.customer)?("<a href='/customers/"+indexation.printing_machine.customer.id+"'>"+indexation.printing_machine.customer.name+"</a>"):('')):('')):((indexation.visit)?((indexation.visit.printing_machine)?((indexation.visit.printing_machine.customer)?(("<a href='/customers/"+indexation.visit.printing_machine.customer.id+"'>"+indexation.visit.printing_machine.customer.name+"</a>")):('')):('')):(''))),

												indexation.the_date,
												indexation.customer_approval,
												indexation.technical_manager_approval,
												indexation.warehouse_approval,
												indexation.type,
												(indexation.visit)?(indexation.visit.id):(''),
												(indexation.visit)?(indexation.visit.readings_of_printing_machine):(''),
												indexation.totalPrice,
											]);
					});
					standardTable.draw();
					$("#my-table-body").fadeIn();
				}
			});
		}
	});
});
// End Ajax for Indexation index view

// Start Indexations released in specific period report
$(function(){
	$("#indexations-released-in-specific-period-report-search-btn").on("click", function(){
		var start = $("#datepicker").val();
		start = start.replace(/\//g,"-");
		var end = $("#datepicker2").val();
		end = end.replace(/\//g,"-");
		if (start != "" && end != "" ) {
			$("#indexations-released-in-specific-period-report-error-validator").css("display", "none");
			$.ajax({
				type: "GET",
				url: "/indexations_released_in_specific_period_report_search/"+start+"/"+end,
				dataType: "json",
				beforeSend: function(){
					$("#indexations-released-in-specific-period-report-loading-message").append("<h4 style='color: #1877a3'>جاري البحث... </h4>");
				},
				success: function(results){
					$("#indexations-released-in-specific-period-report-table-body").fadeOut();
					standardTable.clear();
					$.each(results, function(index, indexation){
						standardTable.row.add([
												(index+1),
												"<a href='/indexations/"+indexation.id+"'>"+indexation.code+"</a>",
												indexation.the_date,
												indexation.customer_approval,
												indexation.technical_manager_approval,
												indexation.warehouse_approval,
												(indexation.visit)?(indexation.visit.id):(''),
												(indexation.visit)?(indexation.visit.readings_of_printing_machine):(''),
											]);
					});
					$("#indexations-released-in-specific-period-report-loading-message").empty();
					standardTable.draw();
					$("#indexations-released-in-specific-period-report-table-body").fadeIn();
				},
				error: function(){
					$("#indexations-released-in-specific-period-report-loading-message").append("<h4>خطاء في الإتصال الرجاء إعادة تحميل الصفحة</h4>");
				},
			});
		}else {
			$("#indexations-released-in-specific-period-report-error-validator").css("display", "block");
		}
	});
});
// End Indexations released in specific period report

/**
 * ////////////////////////////////
 * ///// INSTALLATION RECORDS /////
 * ////////////////////////////////
 */
//Start Ajax for Installation Records _form printing machine search
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
//End Ajax for Installation Records _form printing machine search

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

/**
 * ////////////////////
 * ///// INVOICES /////
 * ////////////////////
 */
// Start Ajax for Invoices _form view
$("#invoice-form-search-button").on('click', function(){
	var keyword = $('#invoice-form-search-input').val();

	if (keyword) {
		$.ajax({
			type:"GET",
			url:"/invoices_form_part_search/"+keyword,
			dataType:"JSON",
			beforeSend:function(){
				$("#invoice-form-message-span").empty();
				$("#invoice-form-message-span").text('جاري البحث...');
			},
			success:function(results){
				
				if (results) {
					$("#invoice-form-message-span").empty();
					var resultTableBody = $('#invoice-form-results-table-body').empty();
					$.each(results, function(key, part){
						
						resultTableBody.append("<tr><td>"+part.name+"</td><td>"+part.descriptions+"</td><td><button type='button' class='btn btn-success btn-xs invoice-form-part-add-button' data-part-id='"+part.id+"' data-part-name='"+part.name+"' data-part-price-without-tax='"+part.price_without_tax+"' data-part-price-with-tax='"+part.price_with_tax+"' data-part-description='"+part.descriptions+"'> اضف </button></td></tr>");
					});

					$(".invoice-form-part-add-button").on("click", function(){
						var addButton = $(this);
						$("#invoice-form-selected-parts-table-body").append("<tr><td>"+addButton.attr('data-part-name')+"<input type='hidden' name='parts_names[]' value='"+addButton.attr('data-part-name')+"' ></td><td><div class='input-group'><input type='text' class='form-control' placeholder=' ادخل الرقم المسلسل للقطعة ' name='parts_serial_numbers[]'></div></td><td><div class='input-group'><input type='text' class='form-control' placeholder='ادخل وصف القطعة' name='parts_descriptions[]' value='"+addButton.attr('data-part-description')+"'></div></td><td><div class='input-group'><input type='number' class='form-control' placeholder=' ادخل عدد القطع ' name='parts_count[]' value='1'><input type='hidden' class='form-control' name='parts_ids[]' value='"+addButton.attr('data-part-id')+"'></div></td><td><div class='input-group'><input type='number' step='0.01' class='form-control' placeholder='ادخل سعر القطعة بدون الضريبة' name='parts_prices_without_tax[]' value='"+addButton.attr('data-part-price-without-tax')+"'></div></td><td><div class='input-group'><input type='number' step='0.01' class='form-control' placeholder='ادخل سعر القطعة بالضريبة' name='parts_prices[]' value='"+addButton.attr('data-part-price-with-tax ')+"'></div></td><td><div class='input-group'><input type='number' class='form-control' name='discount_rate[]' placeholder='إدخل نسبة الخصم إن وجدت'></div></td><td><div class='input-group'><button type='button' class='btn btn-danger btn-xs invoice-form-delete-part-button'> حذف </button></div></td></tr>");
						addButton.parent().parent().fadeOut('500', 'linear', function(){$(this).remove()});

						$('.invoice-form-delete-part-button').on('click', function(){
							$(this).parent().parent().parent().fadeOut('500', 'linear', function(){$(this).remove()});
						});
					});


				}
			},

		error:function(){
			$("#invoice-form-results-table-body").empty();
			$("#invoice-form-message-span").text('خطاء');
		},

		});
	} else {
		$("#invoice-form-message-span").text('برجاء إدخال الكلمة المراد بحث عنها.');
	}
});
$('.invoice-form-delete-part-button').on('click', function(){
	$(this).parent().parent().parent().fadeOut('500', 'linear', function(){$(this).remove()});
});
// End Ajax for Invoices _form view

//Start choose a customer ajaxly for _form view
window.invoiceFormViewChooseACustomer = function() {
	//Cache Dom
	var $inputSearch = $("#invoices-_form-customer-search-input");
	var $searchButton = $("#search-button");
	var $tableBoadyResults = $("#invoices-_form-cutomer-search-table-results tbody");
	var $customerNameInput = $("#invoices-_form-customer-id-input");
	var $customerIdInput = $("[name='customer_id']");
	var $progress = $(".progress");
	var $progressBar = $(".progress-bar");
	//Bind Event
	$searchButton.on('click', getKeyword );

	function getKeyword()
	{
		keyword = $inputSearch.val();
		callServerSide(keyword);
	}
	function callServerSide(keyword)
	{
		$.ajax({
			method:"GET",
			url:"/invoices_form_customer_search/"+keyword,
			type:"json",
			beforeSend:beforeSend,
			success:ajaxSuccess,
		});
	}
	function beforeSend()
	{
		$progressBar.animate({width:'70%'}, 0 );
	}
	function ajaxSuccess(results)
	{
		renderSearchResults(results);
		cacheAndBindEventForTableResults();
	}
	function renderSearchResults(results)
	{
		if (results) {
			$progress.show("fast", function(){
				$progressBar.animate({width:'100%'}, 0);
			});

			$tableBoadyResults.fadeOut();
			$tableBoadyResults.empty();
			rows = "";
			$.each(results, function(index, item){
				rows += addRow([
					(index+1),
					item.name,
					item.code,
					'<button type="button" class="btn btn-danger btn-xs select-cutomer-button" data-selected-customer-id="'+item.id+'" data-selected-customer-name="'+item.name+'">إختيار</button>',
				]);
			});
			
			$tableBoadyResults.append(rows);
			$tableBoadyResults.fadeIn("fast", function(){
				$progress.hide();
			});
		}
	}
	function addRow(array)
	{
		row = "<tr>";
		$.each(array, function(index, item){
			row += "<td>"+item+"</td>";
		});
		row +="</tr>";
		return row;
	}
	function cacheAndBindEventForTableResults()
	{
		$buttonDataCarrior = $(".select-cutomer-button");
		$buttonDataCarrior.on("click", selectCustomer);
	}
	function selectCustomer()
	{
		id = $(this).data("selected-customer-id"),
		name = $(this).data("selected-customer-name");
		customer =  {
						name:name,
						id:id,
					}
		setSelectedCustomer(customer);
	}
	function setSelectedCustomer(customer)
	{
		$customerNameInput.val(customer.name);
		$customerIdInput.val(customer.id);
	}
};

//Start choose a customer ajaxly for _form view

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
					standardTable.clear();
					$.each(results, function(index, invoice) {
						standardTable.row.add([
												(index+1),
												"<a href='/invoices/"+invoice.id+"'>"+( (invoice.number)?(invoice.number):('لم يتم تعين الرقم حتى الآن') )+"</a>",
												((invoice.customer)?(invoice.customer.name):('')),
												invoice.type,
												(invoice.issuer||''),
												(invoice.order_number||''),
												(invoice.delivery_permission_number||''),
												(invoice.finance_check_out||''),
												(invoice.total||''),
												((invoice.employee_responisable_for_this_invoice)?((invoice.employee_responisable_for_this_invoice.user)?(invoice.employee_responisable_for_this_invoice.user.name):('')):('')),
												(invoice.release_date||''),
												(invoice.collect_date||''),
											]);
					});
					standardTable.draw();
					$("#my-table-body").fadeIn();
				}

			});
		}
	});
});
// End Ajax for Invoices index view

// Start Invoices released in specific period report
$(function(){
	$("#invices-released-in-specific-period-report-search-btn").on("click", function(){
		var start = $("#datepicker").val();
		start = start.replace(/\//g,"-");
		var end = $("#datepicker2").val();
		end = end.replace(/\//g,"-");
		if (start != "" && end != "" ) {
			$("#invices-released-in-specific-period-report-error-validator").css("display", "none");
			$.ajax({
				type: "GET",
				url: "/invoices_released_in_specific_period_report_search/"+start+"/"+end,
				dataType: "json",
				beforeSend: function(){
					$("#invices-released-in-specific-period-report-loading-message").append("<h4 style='color: #1877a3'>جاري البحث... </h4>");
				},
				success: function(results){
					$("#invices-released-in-specific-period-report-table-body").fadeOut();
					standardTable.clear();
					$.each(results, function(index, invoice){
						standardTable.row.add([
												(index+1),
												"<a href='/invoices/"+invoice.id+"'>"+( (invoice.number)?(invoice.number):('لم يتم تعين الرقم حتى الآن') )+"</a>",
												((invoice.customer)?(invoice.customer.name):('')),
												invoice.type,
												(invoice.issuer||''),
												(invoice.order_number||''),
												(invoice.delivery_permission_number||''),
												(invoice.finance_check_out||''),
												(invoice.total||''),
												((invoice.employee_responisable_for_this_invoice)?((invoice.employee_responisable_for_this_invoice.user)?(invoice.employee_responisable_for_this_invoice.user.name):('')):('')),
												(invoice.release_date||''),
												(invoice.collect_date||''),
											]);
					});
					$("#invices-released-in-specific-period-report-loading-message").empty();
					standardTable.draw();
					$("#invices-released-in-specific-period-report-table-body").fadeIn();
				},
				error: function(){
					$("#invices-released-in-specific-period-report-loading-message").append("<h4>خطاء في الإتصال الرجاء إعادة تحميل الصفحة</h4>");
				},
			});
		}else {
			$("#invices-released-in-specific-period-report-error-validator").css("display", "block");
		}
	});
});
// End Invoices released in specific period report

/**
 * ////////////////////////////////
 * ///// PARTS SERIAL NUMBERS /////
 * ////////////////////////////////
 */
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
					standardTable.clear();
					$.each(results, function(index, part) {
						standardTable.row.add([
												(index+1),
												((part.part)?(part.part.name):('')),
												"<a href='/part_serial_numbers/"+part.id+"'>"+part.serial_number+"</a>",
												part.code,
												part.availability,
												part.status,
												part.date_of_entry,
												part.date_of_departure,
											]);
					});
					standardTable.draw();
					$("#my-table-body").fadeIn();
				}
			});
		}
	});
});
// End Ajax for Part Serial Number index view

/**
 * /////////////////
 * ///// PARTS /////
 * /////////////////
 */
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
					standardTable.clear();
					$.each(results, function(index, part) {
						standardTable.row.add([
												index+1,
												"<a href='/parts/"+part.id+"'>"+part.name+"</a>",
												part.code,
												part.type,
												((part.is_serialized)?(part.qty):(part.no_serial_qty)),
												part.compatible_printing_machines,
											]);
					});
					standardTable.draw();
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
				standardTable.clear();
				$.each(results, function(index, machine) {

					//preparing assigned employee
					assignedEmployeesRow = '';
					if (machine.assigned_employees){
						$.each(machine.assigned_employees, function(key, value){
							if (value.user){
								assignedEmployeesRow += '<div>'+value.user.name+'</div> &nbsp &nbsp';
							}
						});
					}
					standardTable.row.add([
						index+1,
						"<a href='/printing_machines/"+machine.id+"'>"+machine.folder_number+"</a>",
						machine.serial_number,
						machine.code,
						machine.model_prefix+"-"+machine.model_suffix,
						machine.status,
						machine.customer.name,
						((machine.customer.administration !== null)?(machine.customer.administration):('')),
						assignedEmployeesRow,
					]);
				});
				standardTable.draw();
				$("#my-table-body").fadeIn();
			}
		});
	});
});
// End Ajax for printing machines index view

/**
 * ///////////////////////
 * ///// REFERENCES //////
 * ///////////////////////
 */

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
					standardTable.clear();
					$.each(results, function(index, reference) {
						standardTable.row.add([
												(index+1),
												"<a href='/references/"+reference.id+"'>"+reference.code+"</a>",
												((reference.employee_who_receive_the_rereference)?((reference.employee_who_receive_the_rereference.user)?reference.employee_who_receive_the_rereference.user.name:''):''),
												reference.type,
												reference.status,
												((reference.assigned_employee)?((reference.assigned_employee.user)?reference.assigned_employee.user.name:''):''),
												reference.received_date,
												"<a href='/printing_machines/"+((reference.printing_machine)?reference.printing_machine.id:'')+"'>"+((reference.printing_machine)?reference.printing_machine.code:'')+"</a>",
												((reference.printing_machine)?((reference.printing_machine.serial_number)?(reference.printing_machine.serial_number):('')):('')),
												((reference.printing_machine)?((reference.printing_machine.customer)?((reference.printing_machine.customer.name)?(reference.printing_machine.customer.name):('')):('')):('')),
												((reference.reviewed_by_the_chief_engineer)?(reference.reviewed_by_the_chief_engineer):('')),
											]);
					});
					standardTable.draw();
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
        $("#reference-malfunction-wrapper").append("<div class='panel panel-default'><div class='panel-heading clearfix'><button type='button' class='btn btn-danger btn-xs pull-left reference-malfunction-delete-btn'> حذف </button></div><div class='panel-body'><div class='form-group'><label for='malfunction_type'> نوع العطل </label><input type='text' class='form-control' name='malfunction_type[]' placeholder=' إدخل نوع العطل. 'value=''> </div><div class='form-group'><label for='works_were_done'> الأعمال التي تم تنفيذها </label><textarea name='works_were_done[]' class='form-control' placeholder=' إدخل الأعمال التي تم تنفيذها. '></textarea> </div><div class='form-group'><label for='required_parts'> قطع الآلة المطلوبة </label><textarea name='required_parts[]' class='form-control' placeholder=' إدخل قطع الآلة المطلوبة. '></textarea> </div></div></div>");

        $(".reference-malfunction-delete-btn").click(function(){
            $(this).parent().parent().remove();
        });
    });

    $(".reference-malfunction-delete-btn").click(function(){
        $(this).parent().parent().remove();
    });
});
//End References add malunctions and works were done on it _form view

/**
 * //////////////////
 * ///// VISITS /////
 * //////////////////
 */
// Start Ajax for Visits index view
$(document).ready(function(){
	$('#visits-index-search-button').on('click', function(){
		var keyword = $('#visit-input-search').val();
		var newResult = "";
		if(keyword) {
			$.ajax({
				type: "GET",
				url:"visits_search/"+keyword,
				dataType: "json",
				success: function(results){
					$("#visit-index-my-table-body").fadeOut();
					standardTable.clear();
					$.each(results, function(index, visit) {
						standardTable.row.add([
							(index+1),
							"<a href='{{url('visits')}}/"+visit.id+"'>"+visit.id+"</a>",
							visit.visit_date,
							visit.type,
							"<a href='{{url('printing_machines')}}/"+((visit.printing_machine)?visit.printing_machine.id:'')+"'>"+((visit.printing_machine)?visit.printing_machine.code:'')+"</a>",
							((visit.printing_machine !== null)?(visit.printing_machine.serial_number):('')),
							visit.readings_of_printing_machine,
							((visit.the_employee_who_made_the_visit)?((visit.the_employee_who_made_the_visit.user)?visit.the_employee_who_made_the_visit.user.name:''):''),
						]);
					});
					standardTable.draw();
					$("#visit-index-my-table-body").fadeIn();
				}
			});
		}
	});
});
// End Ajax for Visits index view

// Start visits done on specific period of time report view
$(function(){
	$("#visits-in-specific-period-report-search-btn").on("click", function(){
		var start = $("#datepicker").val();
		start = start.replace(/\//g,"-");
		var end = $("#datepicker2").val();
		end = end.replace(/\//g,"-");
		if (start != "" && end != "" ) {
			$("#visits-in-specific-period-report-error-validator").css("display", "none");
			$.ajax({
				type: "GET",
				url: "/get_visits_in_specific_period_report/"+start+"/"+end,
				dataType: "json",
				beforeSend: function(){
					$("#visits-in-specific-period-report-loading-message").append("<h4 style='color: #1877a3'>جاري البحث... </h4>");
				},
				success: function(results){
					$("#visits-in-specific-period-report-table-body").fadeOut();
					standardTable.clear();
					$.each(results, function(key, visit){
						standardTable.row.add([
												key+1,
												"<a href='/visits/"+visit.id+"' target='_blank'>"+visit.id+"</a>",
												visit.visit_date,
												visit.type,
												((visit.printing_machine !== null)?( "<a href='/printing_machines/"+visit.printing_machine.id+"' target='_blank'>"+visit.printing_machine.code+"</a>"):('')),
												visit.readings_of_printing_machine,
												((visit.the_employee_who_made_the_visit.user !== null )?( visit.the_employee_who_made_the_visit.user.name):('')),
											]);
					});
					$("#visits-in-specific-period-report-loading-message").empty();
					standardTable.draw();
					$("#visits-in-specific-period-report-table-body").fadeIn();
				},
				error: function(){
					$("#visits-in-specific-period-report-loading-message").append("<h4>خطاء في الإتصال الرجاء إعادة تحميل الصفحة</h4>");
				},
			});
		}else {
			$("#visits-in-specific-period-report-error-validator").css("display", "block");
		}
	});
});
// Start visits done on specific period of time report view

/**
 * /////////////////////////
 * ///// MISCELLANEOUS /////
 * /////////////////////////
 */

//Start format date function
function formatDate(date) {
	date = new Date(date);
    var monthNames = [
      "January", "February", "March",
      "April", "May", "June", "July",
      "August", "September", "October",
      "November", "December"
    ];
  
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
  
    return day + '-' + monthIndex + '-' + year;
  }
//End format date function

