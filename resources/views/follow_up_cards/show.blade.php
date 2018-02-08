@extends('layouts.app')
@section('title')
	 بطاقة المتابعة: {{$followUpCard->code}}
@endsection

@section('content')
	<div class="row main_arabic_font">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center"> بطاقة المتابعة: {{$followUpCard->code}}</h3>
				</div>
				<div class="panel-body">

					<div class="panel panel-primary">
						<div class="panel-body">

							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<h2 class="text-center"> البيانات الآساسية لبطاقة المتابعة </h2>
										<div class="text-center">
											@if(in_array('update_follow_up_cards', $permissions))
												<a href="{{action('FollowUpCardController@edit', ['id'=>$followUpCard->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
												|
											@endif

											@if(in_array('delete_follow_up_cards', $permissions))
												<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
											@endif

											<br/>
											</br/>
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

					@if (in_array('view_contracts', $permissions))

						<div class="panel panel-primary">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<h2 class=" text-center"> بيانات العقد </h2>
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

                    @if (in_array('view_contracts', $permissions))

						<div class="panel panel-primary">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<h2 class=" text-center"> بيانات الزيارات </h2>
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


				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$followUpCard->code,
								  'id'=> $followUpCard->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'FollowUpCardController@destroy'])
