@extends('layouts.app')
@section('title')
	{{$indexation->code}} :المقايسة
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-info main_arabic_font">
				<div class="panel-heading">
					<h3 class="panel-title"> المقايسة: {{$indexation->code}}</h3>
				</div>
				<div class="panel-body">

				
					@if(
							in_array('create_invoices', $permissions) 
							&&
							(
								isset($indexation) &&
								isset($indexation->printingMachine) &&
								isset($indexation->printingMachine->customer)
							) 
							
						)
						<a href="{{action('InvoiceController@createWithCustomerIdAndIndexationId', ['customer_id'=>$indexation->printingMachine->customer->id, 'indexation_id'=>$indexation->id] )}}" class="pull-left"><span class="glyphicon glyphicon-plus"></span> إضافة فاتورة </a>
					@elseif(
							in_array('create_invoices', $permissions)
							&&
							
							(
								isset($indexation) &&
								isset($indexation->visit) &&
								isset($indexation->visit->printingMachine) &&
								isset($indexation->visit->printingMachine->customer)
							)
						)
						<a href="{{action('InvoiceController@createWithCustomerIdAndIndexationId', ['customer_id'=>$indexation->visit->printingMachine->customer->id, 'indexation_id'=>$indexation->id] )}}" class="pull-left"><span class="glyphicon glyphicon-plus"></span> إضافة فاتورة </a>
					@endif

					
					<span class="clearfix"></span>
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
								<th> نوع المقايسة </th>
								<td>{{$indexation->type}}</td>
							</tr>
							<tr>
								<th> اسم المهندس الذي قام المقايسة </th>
								<td>{{$indexation->employeeNameWhoPerformedTheIndexation()}}</td>
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

							@include('indexations.show_sections.printing_machine')
							@include('indexations.show_sections.parts')

							
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
							<tr>
								<th> ملفات المقايسة pdf.</th>
								<td>
									@foreach ($indexation->softCopies as $projectImageKey => $projectImage)
										@if ($projectImage->type == "pdf")
											<div><a href="{{url('images/project_images/'.$projectImage->name)}}" target="_blank">{{$projectImageKey+1}}.ملف المقايسة  </a></div>
										@endif
									@endforeach
								</td>
							</tr>
							<tr>
								<th> ملفات المقايسة jpg, png. "الصور"</th>
								<td>
									@foreach ($indexation->softCopies as $projectImageKey => $projectImage)
										@if( $projectImage->type == "img")
											<div>
												<a href="{{url('images/project_images/'.$projectImage->name)}}" target="_blank">
													{{$projectImageKey+1}}.ملف المقايسة  <img src="{{url('images/project_images/'.$projectImage->name)}}" width="100px">
												</a>
											</div>
										@endif
									@endforeach
								</td>
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
'message'=>' هل أنت متأكد؟ هل تريد حذف هذة المقايسة',
'route'=>'IndexationController@destroy'])
