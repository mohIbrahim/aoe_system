@extends('layouts.app')
@section('title')
	{{$indexation->code}} :المقايسة
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary main_arabic_font">
				<div class="panel-heading">
					<h3 class="panel-title"> المقايسة: {{$indexation->code}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<h2 class="text-center"> البيانات الآساسية للمقايسة </h2>
								<div class="text-center">
									@if(in_array('update_indexations', $permissions))
										<a href="{{action('IndexationController@edit', ['id'=>$indexation->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
										|
									@endif

									@if(in_array('delete_indexations', $permissions))
										<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
									@endif

									<br/>
								</br/>
							</div>

						</thead>
						<tbody>
							<tr>
								<th> كود المقايسة </th>
								<td>{{$indexation->code}}</td>
							</tr>
							<tr>
								<th> التاريخ  </th>
								<td>{{$indexation->the_date}}</td>
							</tr>
							<tr>
								<th> موافقة العميل </th>
								<td>{{$indexation->customer_approval}}</td>
							</tr>
							<tr>
								<th> موافقة مدير الأقسام الفنية </th>
								<td>{{$indexation->technical_manager_approval}}</td>
							</tr>
							<tr>
								<th> موافقة المخازنة </th>
								<td>{{$indexation->warehouse_approval}}</td>
							</tr>
							<tr>
								<th> كود الإشارة </th>
								<td>
									<a href="{{action('ReferenceController@show', ['id'=>(isset($indexation->reference)?$indexation->reference->id:'')])}}" target="_blank">
										{{isset($indexation->reference)?$indexation->reference->code:''}}
									</a>
								</td>
							</tr>
							<tr>
								<th> رقم الزيـارة </th>
								<td>
									<a href="{{action('VisitController@show', ['id'=>(isset($indexation->visit)?$indexation->visit->id:'')])}}" target="_blank">
										{{isset($indexation->visit)?$indexation->visit->id:''}}
									</a>
								</td>
							</tr>
							<tr>
								<th> رقم الفاتورة </th>
								<td>
									<a href="{{action('InvoiceController@show', ['id'=>(isset($indexation->invoice)?$indexation->invoice->id:'')])}}" target="_blank">
										{{isset($indexation->invoice)?$indexation->invoice->number:''}}
									</a>
								</td>
							</tr>
							<tr>
								<th> صورة المقايسة </th>
								<td>
									@foreach ($indexation->softCopies as $key => $projectImage)
										<a href="{{url('images/project_images/'.$projectImage->name)}}" target="_blank"> صورة المقايسة </a>
									@endforeach
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<table class="table table-hover">
										<h3 class="text-center"> بيانات الآلة </h3>
										<thead>
											<tr>
												<th> موديل </th>
												<th> كود الآلة </th>
												<th> اسم العميل </th>
												<th> الادارة </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													{{(isset($indexation->visit)?(isset($indexation->visit->printingMachine)?$indexation->visit->printingMachine->model_prefix:''):'')}} -
													{{(isset($indexation->visit)?(isset($indexation->visit->printingMachine)?$indexation->visit->printingMachine->model_suffix:''):'')}}
												</td>
												<td>
													{{(isset($indexation->visit)?(isset($indexation->visit->printingMachine)?$indexation->visit->printingMachine->code:''):'')}}
												</td>
												<td>
													{{(isset($indexation->visit)?(isset($indexation->visit->printingMachine)?(isset($indexation->visit->printingMachine->customer)?$indexation->visit->printingMachine->customer->name:''):''):'')}}
												</td>
												<td>
													{{(isset($indexation->visit)?(isset($indexation->visit->printingMachine)?(isset($indexation->visit->printingMachine->customer)?$indexation->visit->printingMachine->customer->administration:''):''):'')}}
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<table class="table table-hover">
										<?php $total = 0;?>
										<h3 class="text-center"> بيان للقطع المطلوبة </h3>
										<thead>
											<tr>
												<th> اسم القطعة </th>
												<th> الرقم المسلسل </th>
												<th> العدد </th>
												<th> سعر القطعة </th>
												<th> إجمالي الصنف الواحد </th>
											</tr>
										</thead>
										<tbody>
											@foreach ($indexation->parts as $key => $part)
												<tr>
													<td>{{$part->name or ''}}</td>
													<td>{{$part->pivot->serial_number or ''}}</td>
													<td>{{$part->pivot->number_of_parts or ''}}</td>
													<td>{{$part->pivot->price or ''}}</td>
													<td>
														{{(isset($part->pivot)?$part->pivot->price:1) * (isset($part->pivot->number_of_parts)?$part->pivot->number_of_parts:0) }}
														<?php $total += (isset($part->pivot)?$part->pivot->price:1) * (isset($part->pivot->number_of_parts)?$part->pivot->number_of_parts:0);?>
													</td>
												</tr>
											@endforeach
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<th>
													<span style="color:3d3d3d;border-top:1px solid #3d3d3d;padding:5px">
														 الإجمالــي: {{$total}} جنية
													 </span>
												 </th>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>

							<tr>
								<th> الملاحظات </th>
								<td>{{$indexation->comments}}</td>
							</tr>
							<tr>
								<th> تاريخ الإنشاء </th>
								<td style="direction:ltr; text-align:center">{{$indexation->created_at}}</td>
							</tr>
							<tr>
								<th> تاريخ التعديل </th>
								<td style="direction:ltr; text-align:center">{{$indexation->created_at}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@include('partial.deleteConfirm',['name'=>$indexation->code,
'id'=> $indexation->id,
'message'=>' هل أنت متأكد؟ هل تريد حذف ',
'route'=>'IndexationController@destroy'])
