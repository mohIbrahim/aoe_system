@extends('layouts.app')

@section('title')
	 عرض الإشارات
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن الإشارات </legend>
				<div class="form-group">
					<label for=""> البحث بـ كود, نوع , تاريخ, الإشارة, اسم المهندس المعيين لهذة الاشارة أو كود, الرقم المسلسل لآلة التصوير أو اسم العميل. </label>
					<input type="text" class="form-control" id="references_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="references-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center">  عرض الإشارات </h3>
		    </div>
		    <div class="panel-body">
		  		<div class="table-responsive">
			  	    <table class="table table-hover standard-datatable">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> كود الإشارة </th>
                                <th> اسم مستلم الإشارة </th>
                                <th> نوع الإشارة </th>
                                <th> حالة الإشارة </th>
                                <th> اسم المهندس المعيين لهذة الاشار </th>
                                <th> تاريخ الإستلام </th>
								<th> كود الآلة التصوير </th>
								<th> الرقم المسلسل لآلة التصوير </th>
								<th> اسم العميل </th>
								<th> مراجعة كبير المهندسين </th>
							</tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($references as $k => $reference)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('ReferenceController@show', ['id'=>$reference->id])}}" target="_blank">
                                                {{$reference->code}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$reference->employeeWhoReceiveTheRereference->user->name or ''}}
                                        </td>
                                        <td>
                                            {{$reference->type}}
                                        </td>
                                        <td>
                                            {{$reference->status}}
                                        </td>
                                        <td>
                                            {{isset($reference->assignedEmployee)?(isset($reference->assignedEmployee->user)?$reference->assignedEmployee->user->name:''):''}}
                                        </td>
                                        <td>
                                            {{$reference->received_date}}
                                        </td>
                                        <td>
                                            <a href="{{action('PrintingMachineController@show', ['id'=>(isset($reference->printingMachine)?$reference->printingMachine->id:'')])}}">
                                                {{$reference->printingMachine->code or ''}}
                                            </a>
										</td>
										<td>
											{{(($reference->printingMachine)?(($reference->printingMachine->serial_number)?($reference->printingMachine->serial_number):('')):(''))}}
										</td>
										<td>
											{{(($reference->printingMachine)?(($reference->printingMachine->customer)?($reference->printingMachine->customer->name):('')):(''))}}
										</td>
										<td>
											{{$reference->reviewed_by_the_chief_engineer}}
										</td>
									</tr>
								@endforeach
							</div>
			  		    </tbody>
			  		    <tfoot>
			  			    <tr>
								<th>#</th>
                                <th> كود الإشارة </th>
                                <th> اسم مستلم الإشارة </th>
                                <th> نوع الإشارة </th>
                                <th> حالة الإشارة </th>
                                <th> اسم المهندس المعيين لهذة الاشار </th>
                                <th> تاريخ الإستلام </th>
								<th> كود الآلة التصوير </th>
								<th> الرقم المسلسل لآلة التصوير </th>
								<th> اسم العميل </th>
								<th> مراجعة كبير المهندسين </th>
							</tr>
			  		    </tfoot>
			  	     </table>
					 <div class="text-center">
						 {{$references->links()}}
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