@extends('layouts.app')
@section('title')
	 {{$reference->code}} :الإشارة
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-info main_arabic_font">
				<div class="panel-heading">
					<h3 class="panel-title"> الإشارة: {{$reference->code}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية للإشارة </h2>
									<div class="text-center">
										@if(in_array('update_references', $permissions))
											<a href="{{action('ReferenceController@edit', ['id'=>$reference->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_references', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
								    <tr>
									    <th> كود الإشارة </th>
									    <td>{{$reference->code}}</td>
								    </tr>
                                    <tr>
									    <th> اسم مستلم الإشارة </th>
									    <td>{{$reference->employeeWhoReceiveTheRereference->user->name or ''}}</td>
								    </tr>
                                    <tr>
									    <th> كود الدفــتر </th>
									    <td>{{$reference->notebook_number}}</td>
								    </tr>
								    <tr>
									    <th> نوع الإشارة </th>
									    <td>{{$reference->type}}</td>
									</tr>
									<tr>
										<th> حالة الإشارة </th>
										<td>{{$reference->status}}</td>
									</tr>
									<tr>
										<th> تاريخ غلق الإشارة </th>
										<td>{{$reference->closing_date}}</td>
									</tr>
								    <tr>
									    <th> تاريخ الإستلام </th>
									    <td>{{$reference->received_date}}</td>
								    </tr>
                                    <tr>
									    <th> اسم المهندس المعيين لهذة الاشارة </th>
									    <td>{{isset($reference->assignedEmployee)?(isset($reference->assignedEmployee->user)?$reference->assignedEmployee->user->name:''):''}}</td>
								    </tr>
									<tr>
										<th> كود الآلة </th>
										<td>
											@if(isset($reference->printingMachine))
												<a href="{{action('PrintingMachineController@show', ['id'=>$reference->printingMachine->id])}}">
													{{$reference->printingMachine->code}}
												</a>
											@endif
										</td>
									</tr>
									<tr>
										<th> رقم ملف لآلة </th>
										<td>
											@if(isset($reference->printingMachine))
												{{$reference->printingMachine->folder_number}}
											@endif
										</td>
									</tr>
									<tr>
										<th> الرقم المسلسل للآلة </th>
										<td>
											@if(isset($reference->printingMachine))
												{{$reference->printingMachine->serial_number}}
											@endif
										</td>
									</tr>
										
                                    <tr>
									    <th> اسم العميل </th>
									    <td>
                                            <a href="{{action('CustomerController@show', ['id'=>(($reference->printingMachine)?(isset($reference->printingMachine->customer)?$reference->printingMachine->customer->id:''):'')])}}">
                                                {{$reference->printingMachine->customer->name or ''}}
                                            </a>
                                        </td>
								    </tr>
									<tr>
									    <td colspan="2" class="text-center">
                                            <h3> الأعطال </h3>
											<hr />
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> # </th>
                                                            <th> نوع العطل </th>
                                                            <th> الأعمال التي تم تنفيذها </th>
                                                            <th> قطع الآلة المطلوبة </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														@foreach ($reference->malfunctions as $malfunctionIterator => $malfunction)
															<tr>
																<td>{{++$malfunctionIterator}}</td>
																<td>
																	{{$malfunction->malfunction_type or ''}}
																</td>
																<td>
																	{{$malfunction->works_were_done or ''}}
																</td>
																<td>
																	{{$malfunction->required_parts or ''}}
																</td>
															</tr>
														@endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
								    </tr>
								    <tr>
									    <th> ارقم الزيارات </th>
									    <td>
											@foreach($reference->visits as $visit)
												<a href="{{ action('VisitController@show', ['id'=>$visit->id]) }}" target="_blank">
													{{ $visit->id }}
												</a> &nbsp; &nbsp;
											@endforeach
										</td>
								    </tr>
								    <tr>
									    <th> قراءة العداد </th>
									    <td>{{$reference->readings_of_printing_machine}}</td>
								    </tr>                                    
									<tr>
									    <th> اسم مُبلغ الإشارة  </th>
									    <td>{{$reference->informer_name}}</td>
									</tr>
									<tr>
										<th> رقم تليفون المُبلغ عن الإشارة </th>
										<td>{{$reference->informer_phone}}</td>
									</tr>
									<tr>
										<th> تاريخ غلق الإشارة </th>
										<td>{{$reference->closing_date or 'لم يتم غلقها بعد'}}</td>
									</tr>
									<tr>
										<th> هل تم المراجعة من كبير المهندسين؟
											</th>
										<td>{{$reference->reviewed_by_the_chief_engineer or ''}}</td>
									</tr>
                                    <tr>
									    <th> الملاحظات </th>
									    <td>{{$reference->comments}}</td>
								    </tr>
								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$reference->created_at}}</td>
								    </tr>
								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$reference->updated_at}}</td>
								    </tr>
									<tr>
										<th> ملفات الإشارة pdf.</th>
										<td>
											@foreach ($reference->softCopies as $projectImageKey => $projectImage)
												@if ($projectImage->type == "pdf")
													<div><a href="{{url('images/project_images/'.$projectImage->name)}}" target="_blank">{{$projectImageKey+1}}.ملف الإشارة  </a></div>
												@endif
											@endforeach
										</td>
									</tr>
									<tr>
										<th> ملفات الإشارة jpg, png. "الصور"</th>
										<td>
											@foreach ($reference->softCopies as $projectImageKey => $projectImage)
												@if( $projectImage->type == "img")
													<div>
														<a href="{{url('images/project_images/'.$projectImage->name)}}" target="_blank">
															{{$projectImageKey+1}}.ملف الإشارة  <img src="{{url('images/project_images/'.$projectImage->name)}}" width="100px">
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

@section('js_footer')
	@include('partial.deleteConfirm',['name'=>$reference->code,
									'id'=> $reference->id,
									'message'=>' هل أنت متأكد؟ هل تريد حذف ',
									'route'=>'ReferenceController@destroy'])
@endsection
