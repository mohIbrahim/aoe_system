@extends('layouts.app')

@section('title')
	 عرض الأقسام
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<h3 class="text-center"> عرض الأقسام </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> اسم القسم </th>
                                <th> مدير القسم </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($departments as $k => $department)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('DepartmentController@show', ['id'=>$department->id])}}" target="_blank">
                                                {{$department->name}}
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{action('EmployeeController@show', ['id'=>$eloquentDepartment->managerId($department)])}}" target="_blank">
                                                {{$eloquentDepartment->managerName($department)}}
                                            </a>
                                        </td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$departments->links()}}
					 </div>
				 </div>

		    </div>
		  </div>
	  </div>
	</div>

@endsection
