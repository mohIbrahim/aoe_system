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
			  	    <table class="table table-hover standart-datatable">
			  		    <thead>
			  			    <tr>
								<th> # </th>
								<th> كود الآلة التصوير </th>
								<th>  اسم الموظف المسؤول </th>
                                <th> اسم العميل الذي تدرب </th>
			  				    <th> تاريخ التركيب </th>
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
											{{(isset($installationRecord->printingMachine))?($installationRecord->printingMachine->code):('')}}
										</td>

										<td>
											{{(isset($installationRecord->responsibleEmployee)?(isset($installationRecord->responsibleEmployee->user)?$installationRecord->responsibleEmployee->user->name:''):'')}}
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
