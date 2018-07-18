@extends('layouts.app')

@section('title')
	 عرض الفواتير
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن الفواتير </legend>
				<div class="form-group">
					<label for=""> البحث ب رقم، إطلاع قسم الحسابات، تاريخ الفاتورة. </label>
					<input type="text" class="form-control" id="invoice_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="invoices-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center"> عرض الفواتير </h3>
		    </div>
		    <div class="panel-body">
		  		<div class="table-responsive" style="overflow-y:hidden">
			  	    <table class="table table-hover standard-datatable">
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
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($invoices as $k => $invoice)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('InvoiceController@show', ['id'=>$invoice->id])}}" target="_blank">
                                                {{$invoice->number or 'لم يتم تعين الرقم حتى الآن'}}
                                            </a>
                                        </td>
                                        <td>{{$invoice->customer->name or ''}}</td>
                                        <td>{{$invoice->type}}</td>
                                        <td>{{$invoice->issuer}}</td>
										<td>{{$invoice->order_number}}</td>
										<td>{{$invoice->delivery_permission_number}}</td>
										<td>{{$invoice->finance_check_out}}</td>
										<td>{{(isset($invoice->total))?($invoice->total.' جنية'):('0جنية')}} </td>
										<td>{{($invoice->employeeResponisableForThisInvoice)?((($invoice->employeeResponisableForThisInvoice->user)?($invoice->employeeResponisableForThisInvoice->user->name):(''))):('')}}</td>
										<td>{{$invoice->release_date}}</td>
										<td>{{$invoice->collect_date}}</td>
									</tr>
								@endforeach

							</div>
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
			  				    <th> اسم المهندس المسؤول عن الفاتورة </th>
			  				    <th> تاريخ الإصدار </th>
			  				    <th> تاريخ التحصيل </th>
			  			    </tr>
			  		    </tfoot>
			  	     </table>
					 <div class="text-center">
						 {{$invoices->links()}}
					 </div>
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