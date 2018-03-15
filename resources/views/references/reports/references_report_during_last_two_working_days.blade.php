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
		  		<div class="table-responsive">
			  	    <table class="table table-hover">
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
	</div>
@endsection
