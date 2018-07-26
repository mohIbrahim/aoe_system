@extends('layouts.app')

@section('title')
	 عرض العملاء
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن العملاء </legend>
				<div class="form-group">
					<label for=""> البحث بـ الاسم وكود العميل. </label>
					<input type="text" class="form-control" id="customer_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="customers-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				@if(in_array('view_customers_excel', $permissions))
					<a href="{{ action('CustomerController@getCustomersAsExcel') }}"  class="btn btn-info"> الكل Excel </a>
				@endif
				<h3 class="text-center"> عرض العملاء </h3>
				<h5 class="text-left"> إجمالي عدد العملاء: {{$countOfMainBranches}} </h5>
		    </div>
		    <div class="panel-body">
		  		<div class="table-responsive" style="overflow-y:hidden">
			  	    <table class="table table-hover standard-datatable">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> الاسم </th>
			  				    <th> الكود </th>
			  				    <th> الإدارة </th>
			  				    <th> النوع </th>
			  				    <th> المحافظة </th>
			  				    <th> المنطقة </th>
			  				    <th> التليفون </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($customers as $k => $customer)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('CustomerController@show', ['id'=>$customer->id])}}" target="_blank">
                                                {{$customer->name}}
                                            </a>
                                        </td>
										<td>{{$customer->code}}</td>
										<td>{{$customer->administration}}</td>
										<td>{{$customer->type}}</td>
										<td>{{$customer->governorate}}</td>
										<td>{{$customer->area}}</td>
										<td>{{$customer->telecoms()->first()->number or ''}}</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
						  	<tfoot>
								<tr>
									<th>#</th>
									<th> الاسم </th>
									<th> الكود </th>
									<th> الإدارة </th>
									<th> النوع </th>
									<th> المحافظة </th>
									<th> المنطقة </th>
									<th> التليفون </th>
								</tr>
							</tfoot>
			  	     </table>
					 <div class="text-center">
						 {{$customers->links()}} 
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
