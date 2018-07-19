@extends('layouts.app')

@section('title')
	 عرض الآلات التصوير
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">

		    <div class="panel-heading ">
				<legend> البحث عن الآلات. </legend>
				<div class="form-group">
					<label for="printing_machyines_search"> البحث بـ رقم الملف الآلة، كود الآلة، الموديل أو اسم العميل. </label>
					<input type="text" class="form-control" id="printing_machyines_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="printing-machine-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center"> عرض الآلات التصوير </h3>
			<h5 class="text-left"> إجمالي عدد الآلات: {{$printingMachines->total()}} </h5>
		    </div>

		    <div class="panel-body">
				<table class="table table-hover standard-datatable" id="printing-machine-index-table">
					<thead>
						<tr>
							<th>#</th>
							<th> رقم الملف الآلة </th>
							<th> الرقم المسلسل </th>
							<th> كود الآلة </th>
							<th> الموديل </th>
							<th> اسم العميل </th>
							<th> الموظفين المسؤولين عن الآلة </th>
						</tr>
					</thead>
					<tbody id="my-table-body">
						<div class="">
							@foreach ($printingMachines as $k => $printingMachine)
								<tr>
									<td>
										{{$k+1}}
									</td>
									<td><a href="{{action('PrintingMachineController@show', ['id'=>$printingMachine->id])}}">{{$printingMachine->folder_number}}</a></td>
									<td>{{$printingMachine->serial_number}}</td>
									<td>{{$printingMachine->code}}</td>
									<td>{{"$printingMachine->model_prefix-$printingMachine->model_suffix"}}</td>
									<td>{{isset($printingMachine->customer)?$printingMachine->customer->name:''}}</td>
									<td>
										@if(!empty($printingMachine->assignedEmployees))
											@foreach($printingMachine->assignedEmployees as $assignedEmployee)
												<div>{{$assignedEmployee->user->name}}</div> &nbsp &nbsp
											@endforeach
										@endif
									</td>
								</tr>
							@endforeach
						</div>
					</tbody>
					<tfoot>
						<tr>
							<th>#</th>
							<th> رقم الملف الآلة </th>
							<th> الرقم المسلسل </th>
							<th> كود الآلة </th>
							<th> الموديل </th>
							<th> اسم العميل </th>
						</tr>
					</tfoot>
				</table>
					<div class="text-center">
						{{$printingMachines->links()}}
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
@endsection
@section('js_footer')
{{-- Datatable --}}
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/datatables.min.js"></script>
{{-- Datatable --}}
@endsection
