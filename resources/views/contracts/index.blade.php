@extends('layouts.app')

@section('title')
	 عرض محاضر التركيب
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<h3 class="text-center"> عرض محاضر التركيب </h3>
		    </div>
		    <div class="panel-body">
		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th> الكود </th>
                                <th> اسم المتدرب </th>
			  				    <th> تاريخ التريب </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($installationRecords as $k => $installationRecord)
									<tr>
										<td>
                                            <a href="{{action('InstallationRecordController@show', ['id'=>$installationRecord->id])}}" target="_blank">
                                                {{$installationRecord->id}}
                                            </a>
                                        </td>
										<td>
											{{$installationRecord->trainee_name}}
										</td>
										<td>{{$installationRecord->installation_date}}</td>
									</tr>
								@endforeach
							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$installationRecords->links()}}
					 </div>
				 </div>
		    </div>
		  </div>
	  </div>
	</div>
@endsection
