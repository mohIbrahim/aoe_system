@extends('layouts.app')

@section('title')
	تقرير عن فواتير العقود واجبة التحصيل لهذا الشهر
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">	
			<div class="panel-heading text-center">
				<h3> تقرير عن فواتير العقود واجبة التحصيل لهذا الشهر "{{"$thisYear-$thisMonth"}}" </h3>
			</div>	    
		    <div class="panel-body">
		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> اسم العميل </th>
                                <th> كود العقد </th>
                                <th> ترتيب الدفعة </th>
                                <th> رقم الفاتورة </th>
                                <th> تاريخ وجوب السداد </th>
                                <th> تاريخ التحصيل </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($contracts as $contractKey => $contract)
									<tr>
										<td>
											{{$contractKey+1}}
										</td>
										<td>
											<a href="{{action('CustomerController@show',['id'=>(($contract->printingMachines)?(($contract->printingMachines()->first())?(($contract->printingMachines()->first()->customer)?($contract->printingMachines()->first()->customer->id):('')):('')):(''))])}}">
													{{(($contract->printingMachines)?(($contract->printingMachines()->first())?(($contract->printingMachines()->first()->customer)?($contract->printingMachines()->first()->customer->name):('')):('')):(''))}}
											</a>
										</td>
										<td>
											<a href="{{action('ContractController@show', ['id'=>(($contract->id)?($contract->id):(''))])}}">
												{{ ($contract->code)?($contract->code):('') }}
											</a>
										</td>
										<td>
											{{ $paymentsNames[$contractKey] }}
										</td>
										<td>
											<a href="{{action('InvoiceController@show', ['id'=>(($invoices[$contractKey]->id)?($invoices[$contractKey]->id):(''))])}}">
												{{ ($invoices[$contractKey]->number)?($invoices[$contractKey]->number):('لم يتم تعين الرقم') }}
											</a>
										</td>
										<td>
											{{(($invoices[$contractKey]->release_date)?($invoices[$contractKey]->release_date):(''))}}
										</td>
										<td>
											{{(($invoices[$contractKey]->collect_date)?($invoices[$contractKey]->collect_date):(''))}}
										</td>
									</tr>
								@endforeach
							</div>
			  		    </tbody>
			  	     </table>
				 </div>
		    </div>
		  </div>
	  </div>
	</div>
@endsection
