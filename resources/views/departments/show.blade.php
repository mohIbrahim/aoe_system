@extends('layouts.app')
@section('title')
	 القسم: {{$department->name}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> القسم: {{$department->name}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover main_arabic_font">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية </h2>
									<div class="text-center">
										@if(in_array('update_departments', $permissions))
											<a href="{{action('DepartmentController@edit', ['id'=>$department->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_departments', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
								    <tr>
									    <th> اسم القسم </th>
									    <td>{{$department->name}}</td>
								    </tr>

                                    <tr>
									    <th> مدير القسم </th>
									    <td>
                                            <a href="{{action('EmployeeController@show', ['id'=>$managerId])}}" target="_blank">
                                                {{$managerName}}
                                            </a>
                                        </td>
								    </tr>

								    <tr>
									    <th> الملاحظات </th>
									    <td>{{$department->comments}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$department->created_at}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$department->created_at}}</td>
								    </tr>


							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$department->name,
								  'id'=> $department->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'DepartmentController@destroy'])
