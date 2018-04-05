@extends('layouts.app')
@section('title')
	 القطعة : {{$part->name}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"> القطعة: {{$part->name}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover main_arabic_font">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية للقطعة </h2>
									<div class="text-center">
										@if(in_array('update_customers', $permissions))
											<a href="{{action('PartController@edit', ['id'=>$part->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_customers', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
								    <tr>
									    <th> كود القطعة </th>
									    <td>{{$part->code}}</td>
								    </tr>

									<tr>
									    <th> رقم القطعة </th>
									    <td>{{$part->part_number}}</td>
								    </tr>

								    <tr>
									    <th> اسم القطعة </th>
									    <td>{{$part->name}}</td>
								    </tr>

								    <tr>
									    <th> نوع القطعة </th>
									    <td>{{$part->type}}</td>
								    </tr>

								    <tr>
									    <th> آلات الطباعة المتوافقة مع هذة القطعة </th>
										<td>
											{{$part->compatible_printing_machines}}
										</td>
								    </tr>

									<tr>
									    <th> مكان القطعة في المخزن </th>
										<td>
											{{$part->location_in_warehouse}}
										</td>
								    </tr>

                                    <tr>
									    <th>  رقم المنتج "Product Number"  </th>
									    <td>{{$part->product_number}}</td>
								    </tr>

                                    <tr>
									    <th>  سعر القطعة بالضريبة "الحالي" </th>
									    <td>{{$part->price_with_tax}}</td>
								    </tr>

                                    <tr>
									    <th>  سعر القطعة بدون الضريبة "الحالي" </th>
									    <td>{{$part->price_without_tax}}</td>
								    </tr>

                                    <tr>
									    <th>  العمر الافتراضي للقطعة  </th>
									    <td>{{$part->life}} ورقة</td>
								    </tr>

									<tr>
									    <th>  تاريخ الإنتاج للقطعة  </th>
									    <td>{{$part->production_date}}</td>
								    </tr>

									<tr>
									    <th>  تاريخ الإنتهاء للقطعة  </th>
									    <td>{{$part->expiry_date}}</td>
								    </tr>

                                    <tr>
									    <th> الكمية </th>
									    <td>{{($part->is_serialized == '0')?($part->no_serial_qty):($part->serialNumbersCount())}}</td>
								    </tr>

								    <tr>
									    <th> الملاحظات </th>
									    <td>{{$part->comments}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$part->created_at}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$part->created_at}}</td>
								    </tr>

							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$part->name,
								  'id'=> $part->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'PartController@destroy'])
