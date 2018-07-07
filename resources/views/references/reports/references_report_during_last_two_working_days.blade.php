@extends('layouts.app')

@section('title')
	تقرير عن الإشارات التي تم استلامها خلال آخر يومين عمل
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">	
			<div class="panel-heading text-center">
				<h3> تقرير عن الإشارات التي تم استلامها خلال آخر يومين عمل </h3>
			</div>	    
		    <div class="panel-body">
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
									</tr>
								@endforeach
							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$references->links()}}
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
