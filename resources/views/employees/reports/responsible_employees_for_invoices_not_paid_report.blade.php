@extends('layouts.app') @section('title') تقرير عن المواظفين المسؤولين عن الفواتير التي لم يتم تحصيلها @endsection @section('content')
<div class="row main_arabic_font">
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		<div class="panel panel-default">
			<div class="panel-heading ">
				<h3 class="text-center">تقرير عن المواظفين المسؤولين عن الفواتير التي لم يتم تحصيلها</h3>
			</div>
			<div class="panel-body">
				@foreach($employeesInvoices as $employeeName=>$employeeInvoices)
					@php
						$i = 0;
					@endphp
					<div class="panel panel-default">
					<div class="panel-body">
						<h4 class="">{{$employeeName}}</h4>
					</div>
						<div class="table-responsive">
							<table class="table table-hover standard-datatable" style="font-size:.75em">
								<thead>
									<tr>
										<th>#</th>
										<th> رقم الفاتورة </th>
										<th> اسم العميل </th>
										<th> نوع الفاتورة </th>
										<th> جهة الإصدار </th>
										<th> أمر توريد رقم</th>
										<th> إذن تسليم رقم العقد </th>
										<th> إطلاع قسم الحسابات </th>
										<th> إجمالي القيمة </th>
										<th> اسماء الموظفين المسؤولين عن الفاتورة </th>
										<th> تاريخ الإصدار </th>
										<th> تاريخ التحصيل </th>
									</tr>
								</thead>
								<tbody>
									@foreach($employeeInvoices as $invoiceKey=>$invoice)
										<tr>
											<td>
												{{($invoiceKey+1)}}
											</td>
											<td>
												<a href="{{ action('InvoiceController@show', ['id'=>$invoice->id]) }}" target="_blank">
													{{$invoice->number}}
												</a>
											</td>
											<td>
												<a href="{{ action('CustomerController@show', ['id'=>(($invoice->customer)?($invoice->customer->id):('#'))]) }}" target="_blank">
													{{$invoice->customer->name or ''}}
												</a>
											</td>
											<td>
												{{$invoice->type}}
											</td>
											<td>
												{{$invoice->issuer}}
											</td>
											<td>
												{{$invoice->order_number}}
											</td>
											<td>
												{{$invoice->delivery_permission_number}}
											</td>
											<td>
												{{$invoice->finance_check_out}}
											</td>
											<td>
												{{$invoice->total.' جنية'}}
											</td>
											<td>
												{{($invoice->employeesNamesThatAreResponsibleOnThisInvoice)}}
											</td>
											<td>
												{{$invoice->release_date}}
											</td>
											<td>
												{{$invoice->collect_date or 'لم تحٌصل بعد'}}
											</td>
										</tr>
										@php
											$i++;
										@endphp
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>#</th>
										<th> رقم الفاتورة </th>
										<th> اسم العميل </th>
										<th> نوع الفاتورة </th>
										<th> جهة الإصدار </th>
										<th> أمر توريد رقم</th>
										<th> إذن تسليم رقم العقد </th>
										<th> إطلاع قسم الحسابات </th>
										<th> إجمالي القيمة </th>
										<th> اسماء الموظفين المسؤولين عن الفاتورة </th>
										<th> تاريخ الإصدار </th>
										<th> تاريخ التحصيل </th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				@endforeach
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