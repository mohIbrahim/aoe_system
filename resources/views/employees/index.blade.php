@extends('layouts.app')

@section('title')
	 عرض الموظفين
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن الموظفين </legend>
				<div class="form-group">
					<label for=""> البحث بـ الكود والمسمى الوظيفي. </label>
					<input type="text" class="form-control" id="employees_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="employees-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center">  عرض الموظفين</h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> اسم الموظف </th>
                                <th> كود الموظف </th>
                                <th> المسمى الوظيفي </th>
                                <th> القسم  </th>
                                <th> القسم الذي يرأسه </th>
                                <th>  تاريخ التعيين  </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($employees as $k => $employee)
									<tr>
										<td>
											{{$k+1}}
										</td>
                                        <td>
                                            <a href="{{action('EmployeeController@show', ['id'=>$employee->id])}}" target="_blank">
                                                {{$employee->user->name or ''}}
                                            </a>
                                        </td>
										<td>
                                            {{$employee->code}}
                                        </td>
                                        <td>
                                            {{$employee->job_title}}
                                        </td>
                                        <td>
                                            {{isset($employee->department)?$employee->department->name:'لا يوجد'}}
                                        </td>
                                        <td>
                                            {{isset($employee->theDepartmentThatHeManageIt)?$employee->theDepartmentThatHeManageIt->name:'لا يوجد'}}
                                        </td>
                                        <td>
                                            {{$employee->date_of_hiring}}
                                        </td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$employees->links()}}
					 </div>
				 </div>

		    </div>
		  </div>
	  </div>
	</div>
@endsection
