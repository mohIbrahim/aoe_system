@extends('layouts.app')

@section('title')
	تقرير عن العقود التي سوف تنتهي خلال الثلاث أشهر القادمة
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">	
			<div class="panel-heading text-center">
				<h3> تقرير عن العقود التي سوف تنتهي خلال الثلاث أشهر القادمة  </h3>
			</div>	    
		    <div class="panel-body">
		  		<div class="table-responsive">
			  	    <table class="table table-hover standard-datatable">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> كود العقد </th>
			  				    <th> نوع العقد </th>
			  				    <th> تاريخ بداية العقد </th>
			  				    <th> تاريخ نهاية العقد </th>
			  				    <th> حالة التعاقد </th>
			  				    <th> نظام السداد </th>
			  				    <th> عدد الدفعات </th>
			  				    <th> اسم العميل </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($contracts as $k => $contract)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('ContractController@show', ['id'=>$contract->id])}}" target="_blank">
                                                {{$contract->code}}
                                            </a>
                                        </td>
										<td>{{$contract->type}}</td>
										<td>{{$contract->start}}</td>
										<td>{{$contract->end}}</td>
										<td>{{$contract->status}}</td>
										<td>{{$contract->payment_system}}</td>
										<td>{{ (!empty($contract->period_between_each_payment)?(($contract->period_between_each_payment == 13)?( 12 ):(12/($contract->period_between_each_payment))):('بدون')) }}</td>
										<td>{{isset($contract->printingMachines()->first()->customer->name)?$contract->printingMachines()->first()->customer->name:''}}</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
						<tfoot>
							<tr>
								<th>#</th>
								<th> كود العقد </th>
								<th> نوع العقد </th>
								<th> تاريخ بداية العقد </th>
								<th> تاريخ نهاية العقد </th>
								<th> حالة التعاقد </th>
								<th> نظام السداد </th>
								<th> اسم العميل </th>
							</tr>
			  		    </tfoot>
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
@endsection
@section('js_footer')
{{-- Datatable --}}
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/datatables.min.js"></script>
{{-- Datatable --}}
@endsection
