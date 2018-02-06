@extends('layouts.app')
@section('title')
	 الفاتورة: {{$invoice->number}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary main_arabic_font">
				<div class="panel-heading">
					<h3 class="panel-title"> الفاتورة: {{$invoice->number}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover ">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية </h2>
									<div class="text-center">
										@if(in_array('update_invoices', $permissions))
											<a href="{{action('InvoiceController@edit', ['id'=>$invoice->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_invoices', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
								    <tr>
									    <th> رقم الفاتورة </th>
									    <td>{{$invoice->number}}</td>
								    </tr>

                                    <tr>
									    <th> نوع الفاتورة </th>
									    <td>
                                            {{$invoice->type}}
                                        </td>
								    </tr>

                                    <tr>
									    <th> كود العقد </th>
									    <td>
                                            <a href="{{action('ContractController@show', ['id'=>(isset($invoice->contract->code)?$invoice->contract->id:'')])}}">
                                               {{$invoice->contract->code or ''}}
                                            </a>
                                        </td>
								    </tr>

                                    <tr>
									    <th> كود المقايسة </th>
									    <td>
                                            <a href="{{action('IndexationController@show', ['id'=>(isset($invoice->indexation->code)?$invoice->indexation->id:'')])}}">
                                               {{$invoice->indexation->code or ''}}
                                            </a>
                                        </td>
								    </tr>

                                    <tr>
									    <th> جهة الإصدار </th>
									    <td>{{$invoice->issuer}}</td>
								    </tr>

								    <tr>
									    <th> أمر توريد رقم </th>
									    <td>{{$invoice->order_number}}</td>
								    </tr>

								    <tr>
									    <th> إذن تسليم رقم </th>
									    <td>{{$invoice->delivery_permission_number}}</td>
								    </tr>

								    <tr>
									    <th> إطلاع قسم الحسابات </th>
										<td>
											{{$invoice->finance_check_out}}
										</td>
								    </tr>

                                    <tr>
									    <th>  تاريخ الإصدار </th>
									    <td>{{$invoice->release_date}}</td>
								    </tr>

                                    <tr>
									    <th> الوصف </th>
									    <td>{{$invoice->descriptions}}</td>
								    </tr>

                                    <tr>
									    <th> الملاحظات </th>
									    <td>{{$invoice->comments}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$invoice->created_at}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$invoice->created_at}}</td>
								    </tr>

							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$invoice->number,
								  'id'=> $invoice->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'InvoiceController@destroy'])
