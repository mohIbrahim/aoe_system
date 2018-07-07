@extends('layouts.app')

@section('title')
	 عرض القطع الفرعية
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن القطع الفرعية. </legend>
				<div class="form-group">
					<label for=""> البحث بـالرقم المسلسل. </label>
					<input type="text" class="form-control" id="part_serial_numbers_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="part-serial-number-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center"> عرض القطع الفرعية </h3>
		    </div>
		    <div class="panel-body">
		  		<div class="table-responsive">
			  	    <table class="table table-hover standard-datatable">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> القطعة الرئيسية </th>
                                <th> الرقم المسلسل </th>
                                <th> كود </th>
                                <th> التوافر </th>
                                <th> الحالة </th>
                                <th> تاريخ الدخول </th>
                                <th> تاريخ الخروج </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($partSerialNumbers as $k => $partSerialNumber)
									<tr>
										<td>
											{{$k+1}}
										</td>

										<td>
                                            {{$partSerialNumber->part->name}}
                                        </td>

										<td>
                                            <a href="{{action('PartSerialNumberController@show', ['id'=>$partSerialNumber->id])}}" target="_blank">
                                                {{$partSerialNumber->serial_number}}
                                            </a>
                                        </td>

										<td>
                                            {{$partSerialNumber->code}}
                                        </td>

										<td>
                                            {{$partSerialNumber->availability}}
                                        </td>

										<td>
                                            {{$partSerialNumber->status}}
                                        </td>

										<td>
                                            {{$partSerialNumber->date_of_entry}}
                                        </td>

										<td>
                                            {{$partSerialNumber->date_of_departure}}
                                        </td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$partSerialNumbers->links()}}
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
