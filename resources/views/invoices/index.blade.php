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
			  				    <th> تاريخ الإصدار </th>
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
                                                {{$invoice->number}}
                                            </a>
                                        </td>
                                        <td>{{$invoice->customer->name or ''}}</td>
                                        <td>{{$invoice->type}}</td>
                                        <td>{{$invoice->issuer}}</td>
										<td>{{$invoice->order_number}}</td>
										<td>{{$invoice->delivery_permission_number}}</td>
										<td>{{$invoice->finance_check_out}}</td>
										<td>{{(isset($invoice->total))?($invoice->total.' جنية'):('0جنية')}} </td>
										<td>{{$invoice->release_date}}</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
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
