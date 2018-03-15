@extends('layouts.app')

@section('title')
	تقرير عن الدفعات واجبة الدفع هذا الشهر
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">	
			<div class="panel-heading text-center">
				<h3> تقرير عن الدفعات واجبة الدفع هذا الشهر </h3>
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
                                <th> تاريخ السداد </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($contracts as $contractsIterators => $contract)
									<tr>
										<td>
											{{ $contractsIterators+1 }}
                                        </td>
                                        
                                        <td>
                                            {{ $contract->printingMachines()->first()->customer->name }}
                                        </td>
                                        
                                        <td>
                                            {{ ($contract->code)?($contract->code):('') }}
                                        </td>

                                        <td>
                                            {{ $paymentsNames[$contractsIterators] }}
                                        </td>
                                            
                                        <td>
                                            {{ $paymentsDates[$contractsIterators] }}
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
