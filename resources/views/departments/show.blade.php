@extends('layouts.app')
@section('title')
	القسم: {{$department->name}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary main_arabic_font">
				<div class="panel-heading">
					<h3 class="panel-title"> القسم: {{$department->name}}</h3>
				</div>
				<div class="panel-body">


					<div>
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#main-information" aria-controls="main-information" role="tab" data-toggle="tab">
									البيانات الآساسية
								</a>
							</li>
							<li role="presentation">
								<a href="#employees" aria-controls="employees" role="tab" data-toggle="tab">
								 الموظفين
								</a>
							</li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="main-information">
								<div class="table-responsive">
									<table class="table table-hover">
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
													<a href="{{action('EmployeeController@show', ['id'=>(isset($department->manager)?$department->manager->id:'')])}}" target="_blank">
														{{isset($department->manager)?(isset($department->manager->user)?$department->manager->user->name:''):''}}
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

							<div role="tabpanel" class="tab-pane" id="employees">
								<div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
											<h2 class="text-center"> الموظفين </h2>
											<tr>
                                                <th> # </th>
                                                <th> اسم الموظف </th>
                                                <th> المسمى الوظيفي </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($department->employees as $key => $employee)
                                                <tr>
													<td>{{$key+1}}</td>
                                                    <td>
                                                        <a href="{{action('EmployeeController@show', ['id'=>$employee->id])}}">
                                                            {{$employee->user->name or ''}}
                                                        </a>
                                                    </td>
                                                    <td>{{$employee->job_title}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
							</div>

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
