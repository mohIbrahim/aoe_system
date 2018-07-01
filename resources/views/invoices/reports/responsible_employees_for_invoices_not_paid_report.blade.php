@extends('layouts.app') @section('title') تقرير عن المواظفين المسؤولين عن الفواتير التي لم يتم تحصيلها @endsection @section('content')
<div class="row main_arabic_font">
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		<div class="panel panel-default">
			<div class="panel-heading ">
				<h3 class="text-center">تقرير عن المواظفين المسؤولين عن الفواتير التي لم يتم تحصيلها</h3>
			</div>
			<div class="panel-body">
				@foreach($invoices as $invoiceGroupedKey=>$invoiceGrouped)
					<div class="panel panel-danger">
						<h3 class="">{{$invoiceGroupedKey}}</h3>
						<div class="table-responsive">
							<table class="table table-hover">
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
												{{$invoiceKey}}
											</td>
											<td>
												{{$invoice->number}}
											</td>
										</tr>
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