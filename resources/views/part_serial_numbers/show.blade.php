@extends('layouts.app')
@section('title')
	 القطعة الفرعية: {{$partSerialNumber->serial_number}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"> القطعة الفرعية: {{$partSerialNumber->serial_number}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover main_arabic_font">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية للقطعة الفرعية </h2>
									<div class="text-center">
										@if(in_array('update_part_serial_numbers', $permissions))
											<a href="{{action('PartSerialNumberController@edit', ['id'=>$partSerialNumber->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_part_serial_numbers', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
									<tr>
									    <th> القطعة الرئسية </th>
									    <td><a href="{{action('PartController@show', ['id'=>$partSerialNumber->part->id])}}">{{$partSerialNumber->part->name.' | كود رقم: '.$partSerialNumber->part->code}}</a></td>
								    </tr>
								    <tr>
									    <th> الرقم المسلسل </th>
									    <td>{{$partSerialNumber->serial_number}}</td>
								    </tr>

									<tr>
									    <th> الكود </th>
									    <td>{{$partSerialNumber->code}}</td>
								    </tr>

								    <tr>
									    <th> التوافر </th>
									    <td>{{$partSerialNumber->availability}}</td>
								    </tr>

									<tr>
									    <th> الحالة </th>
									    <td>{{$partSerialNumber->status}}</td>
								    </tr>

									<tr>
									    <th> تاريخ الدخول </th>
									    <td>{{$partSerialNumber->date_of_entry}}</td>
								    </tr>

									<tr>
									    <th> تاريخ الخروج </th>
									    <td>{{$partSerialNumber->date_of_departure}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$partSerialNumber->created_at}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$partSerialNumber->created_at}}</td>
								    </tr>

							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$partSerialNumber->serial_number,
								  'id'=> $partSerialNumber->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'PartSerialNumberController@destroy'])
