@extends('layouts.app')
@section('title')
     تقرير عن الإشارات التي تمت في فترة محددة 
@endsection
@section('content')
<div class="row main_arabic_font">
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		<div class="panel panel-default">
			<div class="panel-heading ">
				<legend> تقرير عن الإشارات التي تمت في فترة محددة  </legend>
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="form-inline">
							<div class="alert alert-danger alert-dismissible" id="visits-in-specific-period-report-error-validator" style="display: none; text-align:center">
								برجاء إختيار التاريخ
							</div>

							<div class="form-group">
								<label for="visit-input-search"> من </label>
								<input type="text" name="from" class="form-control" id="datepicker" placeholder=" برجاء إختيار تاريخ بداية المدة. ">
							</div>
							<div class="form-group">
								<label for="visit-input-search"> إلى </label>
								<input type="text" name="to" class="form-control" id="datepicker2" placeholder=" برجاء إختيار تاريخ نهاية المدة. ">
							</div>
							<button type="button" id="visits-in-specific-period-report-search-btn" class="btn btn-primary"> بحث </button>
						</div>
					</div>
				</div>
				<h3 class="text-center"> عرض الزيارات </h3>
			</div>
			<div class="panel-body">
				<div id="references-in-specific-period-report-loading-message" class="text-center"></div>
				<table class="table table-hover standard-datatable">
					<thead>
                        <tr>
                            <th>#</th>
                            <th> كود الإشارة </th>
                            <th> اسم مستلم الإشارة </th>
                            <th> نوع الإشارة </th>
                            <th> حالة الإشارة </th>
                            <th> اسم المهندس المعيين لهذة الاشار </th>
                            <th> تاريخ الإستلام </th>
                            <th> كود الآلة التصوير </th>
                            <th> الرقم المسلسل لآلة التصوير </th>
                            <th> رقم ملف الآلة </th>
                            <th> اسم العميل </th>
                            <th> رقم آخر زيارة </th>
                            <th> مراجعة كبير المهندسين </th>
                        </tr>
                    </thead>
					<tbody id="references-in-specific-period-report-table-body">
					</tbody>
					<tfoot>
						<tr>
                            <tr>
								<th>#</th>
                                <th> كود الإشارة </th>
                                <th> اسم مستلم الإشارة </th>
                                <th> نوع الإشارة </th>
                                <th> حالة الإشارة </th>
                                <th> اسم المهندس المعيين لهذة الاشار </th>
                                <th> تاريخ الإستلام </th>
								<th> كود الآلة التصوير </th>
								<th> الرقم المسلسل لآلة التصوير </th>
								<th> رقم ملف الآلة </th>
								<th> اسم العميل </th>
								<th> رقم آخر زيارة </th>
								<th> مراجعة كبير المهندسين </th>
							</tr>
                        </tr>
					</tfoot>
				</table>

			</div>
		</div>
	</div>
</div>
@endsection @section('head') {{-- Datatable --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/datatables.min.css"
/> {{-- Datatable --}} {{-- datePicker --}}
<link rel="stylesheet" href="{{asset('css/datepicker/jquery-ui.min.css')}}"> {{-- datePicker --}} @endsection @section('js_footer') {{-- Datatable --}}
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/datatables.min.js"></script> {{-- Datatable --}} {{-- datePicker --}}
<script src="{{asset('js/datepicker/jquery-ui.min.js')}}" charset="utf-8"></script>
<script src="{{asset('js/datepicker/sys.js')}}" charset="utf-8"></script> {{-- datePicker --}} @endsection