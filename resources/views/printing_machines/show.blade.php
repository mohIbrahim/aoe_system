@extends('layouts.app')
@section('title')
	{{"$printingMachine->model_prefix - $printingMachine->model_suffix"}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> الآلة {{"$printingMachine->model_prefix - $printingMachine->model_suffix"}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover main_arabic_font">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية </h2>
									<div class="text-center">
										@if(in_array('update_printing_machines', $permissions))
											<a href="{{action('PrintingMachineController@edit', ['id'=>$printingMachine->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_printing_machines', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
								    <tr>
									    <th> رقم الملف الآلة </th>
									    <td>{{$printingMachine->folder_number}}</td>
								    </tr>

								    <tr>
									    <th> كود الآلة الآلة </th>
									    <td>{{$printingMachine->code}}</td>
								    </tr>

								    <tr>
									    <th> اسم الشركة المصنعة للآلة </th>
									    <td>{{$printingMachine->the_manufacture_company}}</td>
								    </tr>

								    <tr>
									    <th> الموديل الجزء الأول الملف الآلة </th>
									    <td>{{$printingMachine->model_prefix}}</td>
								    </tr>

								    <tr>
									    <th> الموديل الجزء الثاني </th>
									    <td>{{$printingMachine->model_suffix}}</td>
								    </tr>

								    <tr>
									    <th> Serial Number </th>
									    <td>{{$printingMachine->serial_number}}</td>
								    </tr>

                                    <tr>
									    <th> حالة الآلة </th>
									    <td>{{$printingMachine->status}}</td>
								    </tr>

								    <tr>
									    <th> Product Key </th>
									    <td>{{$printingMachine->product_key}}</td>
								    </tr>

								    <tr>
									    <th> سنة التصنيع </th>
									    <td>{{$printingMachine->manufacturing_year}}</td>
								    </tr>

								    <tr>
									    <th> وصف الآلة </th>
									    <td>{{$printingMachine->description}}</td>
								    </tr>


								    <tr>
									    <th> سعر الآلة عند البيع بدون ضريبة </th>
									    <td>{{$printingMachine->price_without_tax}}</td>
								    </tr>

								    <tr>
									    <th> سعر الآلة عند البيع بالضريبة </th>
									    <td>{{$printingMachine->price_with_tax}}</td>
								    </tr>

								    <tr>
									    <th> هل هذة الآلة تم بيعها عن طريق الشركة العربية؟ </th>
									    <td>{{($printingMachine->is_sold_by_aoe)? "نعم":"لا"}}</td>
								    </tr>

								    <tr>
									    <th> الملاحظات </th>
									    <td>{{$printingMachine->comments}}</td>
								    </tr>


							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$printingMachine->code,
								  'id'=> $printingMachine->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'PrintingMachineController@destroy'])
