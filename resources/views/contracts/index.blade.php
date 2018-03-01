@extends('layouts.app')

@section('title')
	 عرض العقود
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">



				<legend> البحث عن العقود </legend>

				<div class="form-group">
					<label for=""> البحث بـ كود، حالة، نوع العقد أو اسم العميل. </label>
					<input type="text" class="form-control" id="contract_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>



				<button type="button" id="contract-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>


				<h3 class="text-center"> عرض العقود </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
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
										<td>{{isset($contract->printingMachines()->first()->customer->name)?$contract->printingMachines()->first()->customer->name:''}}</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$contracts->links()}}
					 </div>
				 </div>

		    </div>
		  </div>
	  </div>
	</div>

@endsection
