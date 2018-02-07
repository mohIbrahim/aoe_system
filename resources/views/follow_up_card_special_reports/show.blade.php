@extends('layouts.app')
@section('title')
	 التقرير الخاص بالبطاقة: {{$followUpCardSpecialReport->id}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> التقرير الخاص بالبطاقة: {{$followUpCardSpecialReport->id}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover main_arabic_font">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية للتقرير الخاص باللطاقة </h2>
									<div class="text-center">
										@if(in_array('update_follow_up_card_special_reports', $permissions))
											<a href="{{action('FollowUpCardSpecialReportController@edit', ['id'=>$followUpCardSpecialReport->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_follow_up_card_special_reports', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
								    <tr>
									    <th> التاريخ </th>
									    <td>{{$followUpCardSpecialReport->the_date}}</td>
								    </tr>

								    <tr>
									    <th> قراءة العداد </th>
									    <td>{{$followUpCardSpecialReport->readings_of_printing_machine}}</td>
								    </tr>

								    <tr>
									    <th> رقم المقايسة </th>
									    <td>{{$followUpCardSpecialReport->indexation_number}}</td>
								    </tr>

								    <tr>
									    <th> رقم الفاتورة </th>
									    <td>{{$followUpCardSpecialReport->invoice_number}}</td>
								    </tr>

								    <tr>
									    <th> السداد </th>
										<td>
											{{$followUpCardSpecialReport->the_payment}}
										</td>
								    </tr>

                                    <tr>
									    <th> التقرير  </th>
									    <td>{{$followUpCardSpecialReport->report}}</td>
								    </tr>

                                    <tr>
									    <th> اسم المراجع </th>
									    <td>{{$followUpCardSpecialReport->auditor_name}}</td>
								    </tr>

                                    <tr>
									    <th> الملاحظات </th>
									    <td>{{$followUpCardSpecialReport->comments}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$followUpCardSpecialReport->created_at}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$followUpCardSpecialReport->created_at}}</td>
								    </tr>

							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$followUpCardSpecialReport->id,
								  'id'=> $followUpCardSpecialReport->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'FollowUpCardSpecialReportController@destroy'])
