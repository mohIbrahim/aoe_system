@extends('layouts.app')

@section('title')
	 عرض المقايسات
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن المقايسات </legend>
				<div class="form-group">
					<label for=""> البحث بـ كود, التاريخ, موافقة العميل, موافقة مدير الأقسام الفنية, موافقة المخازن للمقايسة أو كود الإشارة. </label>
                    <p>
                        <small> البحث بالتاريخ يتم كتابة السنة ثم الشهر ثم اليوم </small>
                    </p>
                    <p>
                        <small> وإذا كان الشهر أو اليوم أقل من عشرة يوضع صفر قبل الرقم مثل هذا التنسيق 01, 02, 03 ... 09 </small>
                    </p>
					<input type="text" class="form-control" id="indexations_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="indexatoin-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center">  عرض المقايسات</h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover standard-datatable">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> كود المقايسة </th>
                                <th> اسم العميل </th>
                                <th> الرقم المسلسل للآلة </th>
                                <th>  التاريخ  </th>
                                <th>  اسم المهندس الذي قام بالمقايسة  </th>
                                <th> موافقة العميل </th>
                                <th> موافقة مدير الأقسام الفنية </th>
                                <th> موافقة المخازن </th>
                                <th> النوع </th>
                                <th> رقم الزيارة </th>
                                <th> قراءة العداد </th>
                                <th> إجمالي السعر بالضريبة</th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($indexations as $k => $indexation)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('IndexationController@show', ['id'=>$indexation->id])}}" target="_blank">
                                                {{$indexation->code}}
                                            </a>
                                        </td>
										<td>
											@if(isset($indexation->printingMachine) && 
												isset($indexation->printingMachine->customer))
												<a href="{{ action('CustomerController@show', ['id'=>$indexation->printingMachine->customer->id]) }}" target="_blank">
													{{$indexation->printingMachine->customer->name}}
												</a>
											@elseif(isset($indexation->visit) &&
													isset($indexation->visit->printingMachine) &&
													isset($indexation->visit->printingMachine->customer))
													<a href="{{ action('CustomerController@show', ['id'=>$indexation->visit->printingMachine->customer->id]) }}" target="_blank">
													{{$indexation->visit->printingMachine->customer->name}}
												</a>
											@endif
										</td>
                                        <td>
											@if(isset($indexation->printingMachine))
												<a href="{{ action('PrintingMachineController@show', ['id'=>$indexation->printingMachine->id]) }}" target="_blank">
													{{$indexation->printingMachine->serial_number}}
												</a>
											@elseif(isset($indexation->visit) &&
													isset($indexation->visit->printingMachine))
												<a href="{{ action('PrintingMachineController@show', ['id'=>$indexation->visit->printingMachine->id]) }}" target="_blank">
													{{$indexation->visit->printingMachine->serial_number}}
												</a>
											@endif
                                        </td>
                                        <td>
                                            {{$indexation->the_date}}
                                        </td>
										<td>
											{{$indexation->employeeNameWhoPerformedTheIndexation()}}
										</td>
                                        <td>
                                            {{$indexation->customer_approval}}
                                        </td>
                                        <td>
                                            {{$indexation->technical_manager_approval}}
                                        </td>
                                        <td>
                                            {{$indexation->warehouse_approval}}
                                        </td>
                                        <td>
                                            {{$indexation->type}}
                                        </td>
                                        <td>
                                            {!!($indexation->visit)?("<a href='".action('VisitController@show', ['id'=>$indexation->visit->id])."'target='_blank'>".$indexation->visit->id."</a>"):('')!!}
                                        </td>
                                        <td>
                                            {{($indexation->visit)?(($indexation->visit->readingOfPrintingMachine)?($indexation->visit->readingOfPrintingMachine->value):('')):('')}}
                                        </td>
										<td>
											{{$indexation->statementOfRequiredParts()[1].' جنية '}}
										</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
						<tfoot>
			  			    <tr>
								<th>#</th>
                                <th> كود المقايسة </th>
                                <th> اسم العميل </th>
                                <th> الرقم المسلسل للآلة </th>
                                <th>  التاريخ  </th>
                                <th> موافقة العميل </th>
                                <th> موافقة مدير الأقسام الفنية </th>
                                <th> موافقة المخازن </th>
                                <th> النوع </th>
                                <th> رقم الزيارة </th>
                                <th> قراءة العداد </th>
                                <th> إجمالي السعر بالضريبة</th>
			  			    </tr>
			  		    </tfoot>
			  	     </table>
					 <div class="text-center">
						 {{$indexations->links()}}
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
