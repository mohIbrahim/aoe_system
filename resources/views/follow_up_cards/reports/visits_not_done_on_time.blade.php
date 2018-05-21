@extends('layouts.app')

@section('title')
	تقرير عن الزيارات التي لم تمت خلال فترة محددة لبطاقات المتابعة
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">



				<legend> البحث عن الزيارات </legend>
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="form-inline">


							<div id="message" style="display: none">
								<div class="alert alert-danger alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>				برجاء إختيار التاريخ			
								</div>
							</div>
							<div class="form-group">
								<label for="visit-input-search"> من </label>
								<input type="text" class="form-control" id="datepicker" placeholder=" إدخل الكلمة المراد البحث عنها. ">
							</div>

							<div class="form-group">
								<label for="visit-input-search"> إلى </label>
								<input type="text" class="form-control" id="datepicker2" placeholder=" إدخل الكلمة المراد البحث عنها. ">
							</div>
	
							<button type="button" id="follow-up-card-visits-not-done-report-search-btn" class="btn btn-primary"> بحث </button>
							

						</div>
					</div>
				</div>





				<h3 class="text-center"> عرض الزيارات </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover standart-datatable">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> رقم الزيارة </th>
                                <th> تاريخ الزيارة </th>
                                <th> نوع الزيارة </th>
                                <th> كود آلة التصوير </th>
			  				    <th> قراءة العداد </th>
			  				    <th> اسم المهندس الذي قام بالزيارة </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="visit-index-my-table-body">
							<div class="">								
								<tr>										
									<td>											
									</td>

									<td>											
									</td>

									<td>											
									</td>

									<td>											
									</td>

									<td>											
									</td>

									<td>											
									</td>

									<td>											
									</td>
								</tr>
							</div>
			  		    </tbody>
			  	     </table>
				 </div>

		    </div>
		  </div>
	  </div>
	</div>

@endsection

@section('head')
{{-- Datatable --}}
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/datatables.min.css"/>
{{-- Datatable --}}
{{-- datePicker --}}
    <link rel="stylesheet" href="{{asset('css/datepicker/jquery-ui.min.css')}}">
{{-- datePicker --}}
@endsection

@section('js_footer')
{{-- Datatable --}}
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/datatables.min.js"></script>
{{-- Datatable --}}
{{-- datePicker --}}
    <script src="{{asset('js/datepicker/jquery-ui.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/datepicker/sys.js')}}" charset="utf-8"></script>
{{-- datePicker --}}

<script>
	$(function(){

		$("#follow-up-card-visits-not-done-report-search-btn").on("click", function(){
			var datepicker1 = $("#datepicker").val();
			var datepicker2 = $("#datepicker2").val();
			if (datepicker1 != "" && datepicker2 != "" ) {
				$("#message").css("display", "none");
			}else {
				$("#message").css("display", "block");
			}
			$.ajax({
				type: "GET",
				url: "/visits_not_done_on_time_for_follow_up_cards_report_search",
				dataType: "json",
				beforSend:function(){},
				success: function(results){
					
				},
				error: function(){},
			});
		});
	});
</script>
@endsection