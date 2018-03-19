@extends('layouts.app')
@section('title')
	 العقد: {{$contract->code}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-info main_arabic_font">
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
									    <th> اسم الموظف الذي حرر العقد </th>
									    <td>{{$contract->employeeWhoEditedThisContract->user->name or ''}}</td>
								    </tr>

                                    <tr>
									    <th> صورة العقد </th>
									    <td>
											@foreach ($contract->softCopies as $key => $projectImage)
												<a href="{{url('images/project_images/'.$projectImage->name)}}" target="_blank"> صورة العقد </a>
											@endforeach
										</td>
								    </tr>
									<tr>
									    <th> بطاقة المتابعة </th>
									    <td>
											<a href="{{action('FollowUpCardController@show', ['id'=>(($contract->followUpCard)?($contract->followUpCard->id):(''))])}}">
												{{$contract->followUpCard->code or ''}}
											</a>
										</td>
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
                                            <h3> بيانات الآلات </h3>
											<hr />
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> كود الآلة </th>
                                                            <th> موديل الآلة </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														@foreach ($contract->printingMachines as $pritingMachineiterator => $printingMachine)
															<tr>
																<td>
																	<a href="{{action('PrintingMachineController@show', ['id'=>(isset($printingMachine)?$printingMachine->id:'')])}}">
																		{{isset($printingMachine)?$printingMachine->code:''}}
																	</a>
																</td>
																<td>
																	{{ isset($printingMachine)?$printingMachine->model_prefix:''}}
																	-
																	{{ isset($printingMachine)?$printingMachine->model_suffix:''}}
																</td>
															</tr>
														@endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
								    </tr>

                                    <tr>
									    <td colspan="2">
                                            <h3> بيانات العميل </h3>
											<hr />
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
                                                                {{isset($contract->printingMachines()->first()->customer->name)?$contract->printingMachines()->first()->customer->name:''}}
                                                            </td>
                                                            <td>
                                                                <a href="{{action('CustomerController@show', ['id'=>(isset($contract->printingMachines()->first()->customer->id)?$contract->printingMachines()->first()->customer->id:'')])}}">
                                                                    {{isset($contract->printingMachines()->first()->customer->code)?$contract->printingMachines()->first()->customer->code:''}}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                {{isset($contract->printingMachines()->first()->customer->type)?$contract->printingMachines()->first()->customer->type:''}}
                                                            </td>
                                                            <td>
                                                                {{isset($contract->printingMachines()->first()->customer->area)?$contract->printingMachines()->first()->customer->area:''}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
								    </tr>

									<tr>
									    <td colspan="2">
                                            <h3> بيانات الفواتير ودفعات السداد </h3>
											<hr />
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> رقم الدفعة </th>
                                                            <th> تاريخ الإستحقاق </th>
                                                            <th> رقم الفاتورة </th>
                                                            <th> نوع الفاتورة </th>
                                                            <th> تاريخ السداد  </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														@foreach ($contract->invoices as $invoiceKey => $invoice)
															<tr>
																<td>
																	{{ $paymentsNames[($invoiceKey+1)] }}
																</td>
																<td>
																	{{$invoice->release_date}}
																</td>
																<td>
																	<a href="{{action('InvoiceController@show', ['id'=>(($invoice->id)?($invoice->id):(''))])}}">
																		{{($invoice->number)?($invoice->number):('لم يتم تعين الرقم')}}
																	</a>
																</td>
																<td>
																		{{($invoice->type)?($invoice->type):('')}}
																</td>
																<td>
																		{{($invoice->collect_date)?($invoice->collect_date):('الفاتورة لم يتم سدادها بعد')}}
																</td>
																
															</tr>															
														@endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
								    </tr>

                                    <tr>
									    <td colspan="2">
                                            <h3> بنود خاصة </h3>
											<hr />
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> البند </th>
                                                            <th> تعريفه </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														@foreach ($contract->notesOnContracting as $noteIterator => $note)
															<tr>
																<td>
																	{{$note->item_name or ''}}
																</td>
																<td>
																	{{$note->item_description or ''}}
																</td>
															</tr>
														@endforeach
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
