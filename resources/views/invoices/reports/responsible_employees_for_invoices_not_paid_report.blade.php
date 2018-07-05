@extends('layouts.app') @section('title') تقرير عن المواظفين المسؤولين عن الفواتير التي لم يتم تحصيلها @endsection @section('content')
<div class="row main_arabic_font">
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		<div class="panel panel-default">
			<div class="panel-heading ">
				<h3 class="text-center">تقرير عن المواظفين المسؤولين عن الفواتير التي لم يتم تحصيلها</h3>
			</div>
			<div class="panel-body">
				@foreach($invoices as $invoiceGroupedKey=>$invoiceGrouped)
				@php
					$i = 0;
				@endphp
					<div class="panel panel-default">
					<div class="panel-body">
						<h4 class="">{{$invoiceGrouped[$i]->employeeResponisableForThisInvoice->user->name}}</h4>
					</div>
						<div class="table-responsive">
							<table class="table table-hover" style="font-size:.75em">
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
										<th> اسم المهندس المسؤول عن الفاتورة </th>
										<th> تاريخ الإصدار </th>
										<th> تاريخ التحصيل </th>
									</tr>
								</thead>
								<tbody>
									@foreach($invoiceGrouped as $invoiceKey=>$invoice)
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
												{{($invoice->employeeResponisableForThisInvoice)?((($invoice->employeeResponisableForThisInvoice->user)?($invoice->employeeResponisableForThisInvoice->user->name):(''))):('')}}
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
							</table>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection