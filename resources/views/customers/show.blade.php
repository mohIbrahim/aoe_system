@extends('layouts.app')
@section('title')
	 العميل: {{$customer->name}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> العميل: {{$customer->name}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover main_arabic_font">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية </h2>
									<div class="text-center">
										@if(in_array('update_customers', $permissions))
											<a href="{{action('CustomerController@edit', ['id'=>$customer->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
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
									    <th> كود العميل </th>
									    <td>{{$customer->code}}</td>
								    </tr>

								    <tr>
									    <th> اسم العميل </th>
									    <td>{{$customer->name}}</td>
								    </tr>

								    <tr>
									    <th> نوع العميل </th>
									    <td>{{$customer->type}}</td>
								    </tr>

								    <tr>
									    <th> أرقام التليفون </th>
										<td>
											@foreach ($customer->telecoms as $key => $phone)
												{{$phone->number}} <br/>
											@endforeach
										</td>
								    </tr>

								    <tr>
									    <th> البريد الإلكتروني </th>
									    <td>{{$customer->email}}</td>
								    </tr>

								    <tr>
									    <th> الموقع الكتروني </th>
									    <td>{{$customer->website}}</td>
								    </tr>

								    <tr>
									    <th> الإدارة </th>
									    <td>{{$customer->administration}}</td>
								    </tr>

								    <tr>
									    <th> القسم </th>
									    <td>{{$customer->department}}</td>
								    </tr>

								    <tr>
									    <th> العنوان </th>
									    <td>
											{{$customer->address}}
										</td>
								    </tr>

									<tr>
									    <th> المنطقة </th>
									    <td>
											{{$customer->area}}
										</td>
								    </tr>

									<tr>
									    <th> الحي </th>
									    <td>
											{{ $customer->district}}
										</td>
								    </tr>

									<tr>
									    <th> المدينة </th>
									    <td>
											{{$customer->city}}
										</td>
								    </tr>

									<tr>
									    <th> المحافظة </th>
									    <td>
											{{$customer->governorate}}
										</td>
								    </tr>


								    <tr>
									    <th> اسم الشخص المسؤول عن الآلة </th>
									    <td>{{$customer->responsible_person_name}}</td>
								    </tr>

								    <tr>
									    <th> الملاحظات </th>
									    <td>{{$customer->comments}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$customer->created_at}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$customer->created_at}}</td>
								    </tr>


							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$customer->name,
								  'id'=> $customer->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'CustomerController@destroy'])
