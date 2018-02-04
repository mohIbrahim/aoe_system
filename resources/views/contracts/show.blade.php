@extends('layouts.app')
@section('title')
	 العقد: {{$contract->name}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-primary main_arabic_font">
				<div class="panel-heading">
					<h3 class="panel-title"> العقد: {{$contract->id}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover">
							    <thead>
								    <h1 class="text-center"> البيانات الآساسية للعقد </h1>
									<div class="text-center">
										@if(in_array('update_contracts', $permissions))
											<a href="{{action('ContractController@edit', ['id'=>$contract->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_contracts', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>


								    <tr>
									    <th> كود العقد </th>
									    <td>{{$contract->code}}</td>
								    </tr>

								    <tr>
									    <th> نوع العقد </th>
									    <td>{{$contract->type}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ بداية التعاقد </th>
									    <td>{{$contract->start}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ نهاية التعاقد </th>
										<td>
											{{$contract->end}}
										</td>
								    </tr>

                                    <tr>
									    <th> حالة التعاقد </th>
									    <td>{{$contract->status}}</td>
								    </tr>

                                    <tr>
									    <th> السعر بدون الضريبة </th>
									    <td>{{$contract->price}} جنية</td>
								    </tr>

                                    <tr>
									    <th> قيمة الضريبة </th>
									    <td>{{$contract->tax}} %</td>
								    </tr>

                                    <tr>
									    <th> إجمالي سعر التعاقد </th>
									    <td>{{$contract->total_price}} جنية</td>
								    </tr>

                                    <tr>
									    <th> نظام السداد </th>
									    <td>{{$contract->payment_system}}</td>
								    </tr>

									<tr>
									    <th> الملاحظات </th>
									    <td>{{$contract->comments}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$contract->created_at}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$contract->created_at}}</td>
								    </tr>
                                    <tr>
									    <td colspan="2">
                                            <h2> بيانات الآلة </h2>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> كود الآلة </th>
                                                            <th> موديل الآلة </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <a href="{{action('PrintingMachineController@show', ['id'=>(isset($contract->printingMachine)?$contract->printingMachine->id:'')])}}">
                                                                    {{isset($contract->printingMachine)?$contract->printingMachine->code:''}}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                {{ isset($contract->printingMachine)?$contract->printingMachine->model_prefix:''}}
                                                                -
                                                                {{ isset($contract->printingMachine)?$contract->printingMachine->model_suffix:''}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
								    </tr>

                                    <tr>
									    <td colspan="2">
                                            <h2> بيانات العميل </h2>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> اسم العميل </th>
                                                            <th> كود العميل </th>
                                                            <th> نوع العميل </th>
                                                            <th> المنطقة </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                {{isset($contract->printingMachine->customer->name)?$contract->printingMachine->customer->name:''}}
                                                            </td>
                                                            <td>
                                                                <a href="{{action('CustomerController@show', ['id'=>(isset($contract->printingMachine->customer->id)?$contract->printingMachine->customer->id:'')])}}">
                                                                    {{isset($contract->printingMachine->customer->code)?$contract->printingMachine->customer->code:''}}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                {{isset($contract->printingMachine->customer->type)?$contract->printingMachine->customer->type:''}}
                                                            </td>
                                                            <td>
                                                                {{isset($contract->printingMachine->customer->area)?$contract->printingMachine->customer->area:''}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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

@include('partial.deleteConfirm',['name'=>$contract->code,
								  'id'=> $contract->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'ContractController@destroy'])
