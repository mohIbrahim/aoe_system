@extends('layouts.app')
@section('title')
	   الموظف: {{$employee->user->name}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> الموظف: {{$employee->user->name}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover main_arabic_font">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية للموظف </h2>
									<div class="text-center">
										@if(in_array('update_employees', $permissions))
											<a href="{{action('EmployeeController@edit', ['id'=>$employee->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_employees', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
								    <tr>
									    <th> اسم الموظف </th>
									    <td>{{$employee->user->name}}</td>
								    </tr>

                                    <tr>
									    <th> كود الموظف </th>
									    <td>{{$employee->code}}</td>
								    </tr>

								    <tr>
									    <th> المسمى الوظيفي </th>
									    <td>{{$employee->job_title}}</td>
								    </tr>

                                    <tr>
                                        <th> تاريخ التعيين  </th>
                                        <td>{{$employee->date_of_hiring}}</td>
                                    </tr>

									<tr>
                                        <th> اسم القسم التابع له  </th>
                                        <td>{{isset($employee->department)?$employee->department->name:' لا يوجد '}}</td>
                                    </tr>

									<tr>
                                        <th> اسم القسم الذي يديره  </th>
                                        <td>{{isset($employee->theDepartmentThatHeManageIt)?$employee->theDepartmentThatHeManageIt->name:'لا يوجد'}}</td>
                                    </tr>

								    <tr>
									    <th> الراتب </th>
									    <td>{{$employee->salary}}</td>
								    </tr>

                                    <tr>
									    <th> البريد الإلكتروني </th>
									    <td>{{$employee->user->email}}</td>
								    </tr>

                                    <tr>
									    <th> الملاحظات </th>
									    <td>{{$employee->comments}}</td>
								    </tr>
								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$employee->created_at}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$employee->created_at}}</td>
								    </tr>
							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$employee->user->name,
								  'id'=> $employee->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'EmployeeController@destroy'])
