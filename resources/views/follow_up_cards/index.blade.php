@extends('layouts.app')

@section('title')
	 عرض بطاقات المتابعة
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن بطاقة متابعة </legend>
				<div class="form-group">
					<label for=""> البحث ب كود البطاقة وكود العقد. </label>
					<input type="text" class="form-control" id="follow_up_cards_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="follow-up-card-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center"> عرض بطاقات المتابعة </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive" style="overflow-y: hidden;">
			  	    <table class="table table-hover standard-datatable" >
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> كود البطاقة </th>
                                <th> اسم العميل </th>
                                <th> كود العقد </th>
                                <th> الرقم المسلسل لآلة الطباعة </th>
                                <th> تاريخ التعديل </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($followUpCards as $k => $followUpCard)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('FollowUpCardController@show', ['id'=>$followUpCard->id])}}" target="_blank">
                                                {{$followUpCard->code}}
                                            </a>
                                        </td>

										<td>
											{{$followUpCard->printingMachine->customer->name}}
										</td>

										<td>
                                            <a href="{{action('ContractController@show', ['id'=>(isset($followUpCard->contract)?$followUpCard->contract->id:'')])}}" target="_blank">
                                                {{(isset($followUpCard->contract)?$followUpCard->contract->code:'')}}
                                            </a>
                                        </td>

										<td>
											{{$followUpCard->printingMachine->serial_number}}
										</td>

										<td>
											{{$followUpCard->updated_at->format('d-m-Y')}}
										</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$followUpCards->links()}}
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
