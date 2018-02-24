@extends('layouts.app')
@section('title')
	 بطاقة المتابعة: {{$followUpCard->code}}
@endsection

@section('content')
	<div class="row main_arabic_font">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4 class="text-center"> بطاقة المـتابعة: {{$followUpCard->code}}</h4>
				</div>
				<div class="panel-body">
					<div class="panel panel-info">
						<div class="panel-body">
							<h3 class="text-center"> البيانات الآساسية لبطاقة المتابعة </h3>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<div class="text-center">
											@if(in_array('update_follow_up_cards', $permissions))
												<a href="{{action('FollowUpCardController@edit', ['id'=>$followUpCard->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
												|
											@endif
											@if(in_array('delete_follow_up_cards', $permissions))
												<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
											@endif
											<br>
											<br>
										</div>
									</thead>
									<tbody>
										<tr>
											<th> كود البطاقة </th>
											<td>{{$followUpCard->code}}</td>
										</tr>
                                        <tr>
    									    <th> صورة بطاقة المتابعة </th>
    									    <td>
    											@foreach ($followUpCard->softCopies as $key => $projectImage)
    												<a href="{{url('images/project_images/'.$projectImage->name)}}" target="_blank"> صورة بطاقة المتابعة </a>
    											@endforeach
    										</td>
    								    </tr>
										<tr>
											<th> الملاحظات </th>
											<td>{{$followUpCard->comments}}</td>
										</tr>
										<tr>
											<th> تاريخ الإنشاء </th>
											<td style="direction:ltr; text-align:center">{{$followUpCard->created_at}}</td>
										</tr>
										<tr>
											<th> تاريخ التعديل </th>
											<td style="direction:ltr; text-align:center">{{$followUpCard->created_at}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					@if (in_array('view_customers', $permissions))

						<div class="panel panel-info">
							<div class="panel-body">
								<h3 class=" text-center"> بيانات العميل </h3>
								<hr>
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<th> اسم العميل </th>
											<th> كود العميل </th>
											<th> نوع العميل </th>
											<th> المدينة </th>
											<th> المنطقة </th>
										</thead>
										<tbody>
											<tr>
												<td>
													<a href="{{action('CustomerController@show', ['id'=>((isset($followUpCard->contract->printingMachine->customer))?($followUpCard->contract->printingMachine->customer->id):(''))])}}" target="_blank">
														{{(isset($followUpCard->contract->printingMachine->customer))?($followUpCard->contract->printingMachine->customer->name):('')}}
													</a>
												</td>
												<td>
													{{((isset($followUpCard->contract->printingMachine->customer))?($followUpCard->contract->printingMachine->customer->code):(''))}}
												</td>
												<td>
													{{((isset($followUpCard->contract->printingMachine->customer))?($followUpCard->contract->printingMachine->customer->type):(''))}}
												</td>
												<td>
													{{((isset($followUpCard->contract->printingMachine->customer))?($followUpCard->contract->printingMachine->customer->city):(''))}}
												</td>
												<td>
													{{((isset($followUpCard->contract->printingMachine->customer))?($followUpCard->contract->printingMachine->customer->area):(''))}}
												</td>

											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					@endif

					@if (in_array('view_contracts', $permissions))

						<div class="panel panel-info">
							<div class="panel-body">
								<h3 class=" text-center"> بيانات العقد </h3>
								<hr>
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<th> كود العقد </th>
											<th> نوع العقد </th>
											<th> من </th>
											<th> إلى </th>
											<th> نظام السداد </th>
											<th> السعر الكلي للتعاقد شامل الضريبة </th>
										</thead>
										<tbody>
											<tr>
												<td>
													<a href="{{action('ContractController@show', ['id'=>(isset($followUpCard->contract)?$followUpCard->contract->id:'')])}}" target="_blank">
														{{(isset($followUpCard->contract)?$followUpCard->contract->code:'')}}
													</a>
												</td>
												<td>
													{{(isset($followUpCard->contract)?$followUpCard->contract->type:'')}}
												</td>
												<td>
													{{(isset($followUpCard->contract->start)?$followUpCard->contract->start:'')}}
												</td>
												<td>
													{{(isset($followUpCard->contract)?$followUpCard->contract->end:'')}}
												</td>
												<td>
													{{(isset($followUpCard->contract)?$followUpCard->contract->payment_system:'')}}
												</td>
												<td>
													{{(isset($followUpCard->contract)?$followUpCard->contract->total_price.' جنية ':' 0 جنية ')}}
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					@endif

                    @if (in_array('view_visits', $permissions))

						<div class="panel panel-info">
							<div class="panel-body">
								<h3 class=" text-center"> بيانات الزيارات </h3>
									<a href="{{action('VisitController@createWithPrintingMachineIdAndFollowUpCardId', ['printing_machine_id'=>(   (isset($followUpCard->contract->printingMachine))?($followUpCard->contract->printingMachine->id):('')),'follow_up_card_id'=>$followUpCard->id])}}">
									<span class="glyphicon glyphicon-plus"></span>
									 إنشاء زيارة لهذة البطاقة
								</a>
								<hr />
								<hr>
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<th> رقم الزيارة </th>
											<th> التاريخ </th>
											<th> العداد </th>
											<th> اسم المسؤول </th>
											<th> المهندس المختص </th>
										</thead>
										<tbody>
                                            @foreach ($followUpCard->visits as $key3 => $visit)
                                                <tr>
                                                    <td>
                                                        <a href="{{action('VisitController@show', ['id'=>($visit->id)])}}">
                                                            {{$visit->id}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{$visit->visit_date}}
                                                    </td>
                                                    <td>
                                                        {{$visit->readings_of_printing_machine}}
                                                    </td>
                                                    <td>
                                                        {{$visit->representative_customer_name}}
                                                    </td>
                                                    <td>
                                                        {{$visit->theEmployeeWhoMadeTheVisit->user->name or ''}}
                                                    </td>
                                                </tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					@endif


                    @if (in_array('view_follow_up_card_special_reports', $permissions))

						<div class="panel panel-info">
							<div class="panel-body">
								<h3 class=" text-center"> تقارير خاصة </h3>
								<a href="{{action('FollowUpCardSpecialReportController@createWithFollowUpCardId', ['follow_up_card_id'=>$followUpCard->id])}}">
									<span class="glyphicon glyphicon-plus"></span>
									 إنشاء تقرير خاص لهذة البطاقة
								</a>
								<hr />
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<th> التاريخ </th>
											<th> العداد </th>
											<th> التقرير </th>
											<th> رقم الفاتورة </th>
										</thead>
										<tbody>
                                            @foreach ($followUpCard->specialReports as $key4 => $specialReport)
                                                <tr>
                                                    <td>
                                                        <a href="{{action('FollowUpCardSpecialReportController@show', ['id'=>($specialReport->id)])}}">
                                                            {{$specialReport->the_date}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{$specialReport->readings_of_printing_machine}}
                                                    </td>
                                                    <td>
                                                        {{$specialReport->report}}
                                                    </td>

                                                    <td>
                                                        {{$specialReport->invoice_number}}
                                                    </td>
                                                </tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					@endif


				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$followUpCard->code,
								  'id'=> $followUpCard->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'FollowUpCardController@destroy'])
