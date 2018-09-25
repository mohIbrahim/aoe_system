@extends('layouts.app')

@section('title')
	 عرض الزيارات
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">



				<legend> البحث عن الزيارات </legend>

				<div class="form-group">
					<label for="visit-input-search"> البحث بـ رقم وتاريخ ونوع الزيارة - كود الآلة سيريل الآلة - اسم المهندس المسؤول. </label>
                    <p>
                        <small> البحث بالتاريخ يتم كتابة السنة ثم الشهر ثم اليوم </small>
                    </p>
                    <p>
                        <small> وإذا كان الشهر أو اليوم أقل من عشرة يوضع صفر قبل الرقم مثل هذا التنسيق 01, 02, 03 ... 09 </small>
                    </p>

					<input type="text" class="form-control" id="visit-input-search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>



				<button type="button" id="visits-index-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>


				<h3 class="text-center"> عرض الزيارات </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover standard-datatable">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> رقم الزيارة </th>
                                <th> تاريخ الزيارة </th>
                                <th> نوع الزيارة </th>
                                <th> رقم ملف الآلة </th>
                                <th> كود آلة التصوير </th>
                                <th> سيريل آلة التصوير </th>
			  				    <th> قراءة العداد </th>
			  				    <th> اسم المهندس الذي قام بالزيارة </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="visit-index-my-table-body">
							<div class="">
								@foreach ($visits as $k => $visit)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('VisitController@show', ['id'=>$visit->id])}}" target="_blank">
                                                {{$visit->id}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$visit->visit_date}}
                                        </td>
										<td>{{$visit->type}}</td>
										<td>{{isset($visit->printingMachine)?$visit->printingMachine->folder_number:''}}</td>
                                        <td>
                                            <a href="{{action('PrintingMachineController@show', ['id'=>(isset($visit->printingMachine)?$visit->printingMachine->id:'')])}}">
                                                {{isset($visit->printingMachine)?$visit->printingMachine->code:''}}
                                            </a>
                                        </td>
										<td>{{(isset($visit->printingMachine)?($visit->printingMachine->serial_number):(''))}}</td>
										<td>{{$visit->readings_of_printing_machine}}</td>
										<td>{{$visit->theEmployeeWhoMadeTheVisit->user->name or ''}}</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  		    <tfoot>
			  			    <tr>
								<th>#</th>
                                <th> رقم الزيارة </th>
                                <th> تاريخ الزيارة </th>
                                <th> نوع الزيارة </th>
                                <th> رقم ملف الآلة </th>
                                <th> كود آلة التصوير </th>
                                <th> سيريل آلة التصوير </th>
			  				    <th> قراءة العداد </th>
			  				    <th> اسم المهندس الذي قام بالزيارة </th>
			  			    </tr>
			  		    </tfoot>
			  	     </table>
					 <div class="text-center">
						 {{$visits->links()}}
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