@extends('layouts.app')
@section('title')
	 {{$reference->code}} :الإشارة
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> الإشارة: {{$reference->code}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover main_arabic_font">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية </h2>
									<div class="text-center">
										@if(in_array('update_references', $permissions))
											<a href="{{action('ReferenceController@edit', ['id'=>$reference->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_references', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
								    <tr>
									    <th> كود الإشارة </th>
									    <td>{{$reference->code}}</td>
								    </tr>
                                    <tr>
									    <th> كود الدفــتر </th>
									    <td>{{$reference->notebook_number}}</td>
								    </tr>
								    <tr>
									    <th> نوع الإشارة </th>
									    <td>{{$reference->type}}</td>
								    </tr>
								    <tr>
									    <th> تاريخ الإستلام </th>
									    <td>{{$reference->received_date}}</td>
								    </tr>
                                    <tr>
									    <th> اسم المهندس المعيين لهذة الاشارة </th>
									    <td>{{isset($reference->assignedEmployee)?(isset($reference->assignedEmployee->user)?$reference->assignedEmployee->user->name:''):''}}</td>
								    </tr>
								    <tr>
									    <th> نوع العطل </th>
									    <td>{{$reference->malfunctions_type}}</td>
								    </tr>
								    <tr>
									    <th> الأعمال التي تم تنفيذها على الآلة </th>
									    <td>{{$reference->works_done_on_the_machine}}</td>
								    </tr>
								    <tr>
									    <th> قراءة العداد </th>
									    <td>{{$reference->readings_of_printing_machine}}</td>
								    </tr>
                                    <tr>
									    <th> الملاحظات </th>
									    <td>{{$reference->comments}}</td>
								    </tr>
								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$reference->created_at}}</td>
								    </tr>
								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$reference->created_at}}</td>
								    </tr>
							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$reference->code,
								  'id'=> $reference->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'ReferenceController@destroy'])
