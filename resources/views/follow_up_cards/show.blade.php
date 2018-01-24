@extends('layouts.app')
@section('title')
	 بطاقة المتابعة: {{$followUpCard->code}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> بطاقة المتابعة: {{$followUpCard->code}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover main_arabic_font">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية </h2>
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
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$followUpCard->code,
								  'id'=> $followUpCard->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'FollowUpCardController@destroy'])
