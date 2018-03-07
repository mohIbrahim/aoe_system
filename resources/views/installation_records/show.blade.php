@extends('layouts.app')
@section('title')
	 محضر التركيب : {{$installationRecord->name}}
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel panel-info main_arabic_font">
				<div class="panel-heading">
					<h3 class="panel-title"> محضر التركيب: {{$installationRecord->id}}</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						     <table class="table table-hover">
							    <thead>
								    <h2 class="text-center"> البيانات الآساسية لمحضر التركيب </h2>
									<div class="text-center">
										@if(in_array('update_installation_records', $permissions))
											<a href="{{action('InstallationRecordController@edit', ['id'=>$installationRecord->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
											|
										@endif

										@if(in_array('delete_installation_records', $permissions))
											<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
										@endif

										<br/>
									</br/>
									</div>

							    </thead>
							    <tbody>
									<tr>
									    <th> كود آلة التصوير </th>
									    <td>
											<a href="{{action('PrintingMachineController@show', ['id'=>(isset($installationRecord->printingMachine))?($installationRecord->printingMachine->id):('')])}}">
												{{ (isset($installationRecord->printingMachine))?($installationRecord->printingMachine->code):('') }}
											</a>
										</td>
								    </tr>

									<tr>
									    <th> اسم الموظف المسؤول </th>
									    <td>
											<a href="{{action('EmployeeController@show', ['id'=>(isset($installationRecord->responsibleEmployee)?$installationRecord->responsibleEmployee->id:'')])}}">
												{{isset($installationRecord->responsibleEmployee)?(isset($installationRecord->responsibleEmployee->user)?$installationRecord->responsibleEmployee->user->name:''):''}}
											</a>
										</td>
								    </tr>

								    <tr>
									    <th> اسم مستلم الآلة </th>
									    <td>{{$installationRecord->recipient_of_the_printing_machine}}</td>
								    </tr>
								    <tr>
									    <th> اسم العميل الذي تدرب </th>
									    <td>{{$installationRecord->trainee_name}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التركيب </th>
									    <td>{{$installationRecord->installation_date}}</td>
								    </tr>

								    <tr>
									    <th>Feeder Model</th>
									    <td>{{$installationRecord->feeder_model}}</td>
								    </tr>

								    <tr>
									    <th>Feeder Serial Number </th>
										<td>
											{{$installationRecord->feeder_serial_number}}
										</td>
								    </tr>

                                    <tr>
									    <th>Feeder Product Key</th>
									    <td>{{$installationRecord->feeder_product_key}}</td>
								    </tr>

                                    <tr>
									    <th>Finisher Model</th>
									    <td>{{$installationRecord->finisher_model}}</td>
								    </tr>

                                    <tr>
									    <th>Finisher Serial Number</th>
									    <td>{{$installationRecord->finisher_serial_number}}</td>
								    </tr>

                                    <tr>
									    <th>Finisher Product Key</th>
									    <td>{{$installationRecord->finisher_product_key}}</td>
								    </tr>

                                    <tr>
									    <th>Hard Disk Model</th>
									    <td>{{$installationRecord->hard_disk_model}}</td>
								    </tr>

									<tr>
									    <th>Hard Disk Serial Number</th>
									    <td>{{$installationRecord->hard_disk_serial_number}}</td>
								    </tr>

									<tr>
									    <th>Hard Disk Product Key</th>
									    <td>{{$installationRecord->hard_disk_product_key}}</td>
								    </tr>

									<tr>
									    <th>Paper Drawer Model</th>
									    <td>{{$installationRecord->paper_drawer_model}}</td>
								    </tr>

									<tr>
									    <th>Paper Drawer Serial Number</th>
									    <td>{{$installationRecord->paper_drawer_serial_number}}</td>
								    </tr>

									<tr>
									    <th>Paper Drawer Product Key</th>
									    <td>{{$installationRecord->paper_drawer_product_key}}</td>
								    </tr>

									<tr>
									    <th>Network Scanner Model</th>
									    <td>{{$installationRecord->network_scanner_model}}</td>
								    </tr>

									<tr>
									    <th>Network Scanner Serial Number</th>
									    <td>{{$installationRecord->network_scanner_serial_number}}</td>
								    </tr>

									<tr>
									    <th>Network Scanner Product Key</th>
									    <td>{{$installationRecord->network_scanner_product_key}}</td>
								    </tr>

								    <tr>
									    <th> صورة محضر التركيب </th>
									    <td>
											@foreach ($installationRecord->softCopies as $key => $projectImage)
												<a href="{{url('images/project_images/'.$projectImage->name)}}" target="_blank"> صورة محضر التركيب	 </a>
											@endforeach
										</td>
									</tr>
									
									<tr>
									    <td colspan="2">
                                            <h3> عناصر آخرى </h3>
											<hr />
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> العنصر </th>
                                                            <th> تعريفه </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														@foreach ($installationRecord->otherItems as $itemIterator => $item)
															<tr>
																<td>
																	{{$item->item_name or ''}}
																</td>
																<td>
																	{{$item->item_description or ''}}
																</td>
															</tr>
														@endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
								    </tr>

									<tr>
									    <th> الملاحظات </th>
									    <td>{{$installationRecord->comments}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ الإنشاء </th>
									    <td style="direction:ltr; text-align:center">{{$installationRecord->created_at}}</td>
								    </tr>

								    <tr>
									    <th> تاريخ التعديل </th>
									    <td style="direction:ltr; text-align:center">{{$installationRecord->created_at}}</td>
								    </tr>

							    </tbody>
						     </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@include('partial.deleteConfirm',['name'=>$installationRecord->id,
								  'id'=> $installationRecord->id,
								  'message'=>' هل أنت متأكد؟ هل تريد حذف ',
								  'route'=>'InstallationRecordController@destroy'])
