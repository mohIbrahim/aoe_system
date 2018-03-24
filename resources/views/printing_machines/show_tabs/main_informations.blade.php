<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<h3 class="text-center"> البيانات الآساسية لآلة التصوير </h3>
			<div class="text-center">
				@if(in_array('update_printing_machines', $permissions))
				<a href="{{action('PrintingMachineController@edit', ['id'=>$printingMachine->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
				|
				@endif
				
				@if(in_array('delete_printing_machines', $permissions))
				<a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
				@endif
				
				<br/>
			</br/>
		</div>
		
	</thead>
	<tbody>
		<tr>
			<th> اسم العميل "حائز الآلة" </th>
			<td>
				<a href="{{action('CustomerController@show', ['id'=>(isset($printingMachine->customer)?$printingMachine->customer->id:'')])}}">
					{{isset($printingMachine->customer)?$printingMachine->customer->name:''}}
				</a>
			</td>
		</tr>
		<tr>
			<th> كود العميل </th>
			<td>
				{{isset($printingMachine->customer)?$printingMachine->customer->code:''}}
			</td>
		</tr>
		
		<tr>
			<th> رقم ملف الآلة </th>
			<td>{{$printingMachine->folder_number}}</td>
		</tr>
		
		<tr>
			<th> كود الآلة </th>
			<td>{{$printingMachine->code}}</td>
		</tr>
		
		<tr>
			<th> اسم الشركة المصنعة للآلة </th>
			<td>{{$printingMachine->the_manufacture_company}}</td>
		</tr>
		
		<tr>
			<th> الموديل الجزء الأول  </th>
			<td>{{$printingMachine->model_prefix}}</td>
		</tr>
		
		<tr>
			<th> الموديل الجزء الثاني </th>
			<td>{{$printingMachine->model_suffix}}</td>
		</tr>
		
		<tr>
			<th> Serial Number </th>
			<td>{{$printingMachine->serial_number}}</td>
		</tr>
		
		<tr>
			<th> حالة الآلة </th>
			<td>{{$printingMachine->status}}</td>
		</tr>
		
		<tr>
			<th> Product Key </th>
			<td>{{$printingMachine->product_key}}</td>
		</tr>
		
		<tr>
			<th> سنة التصنيع </th>
			<td>{{$printingMachine->manufacturing_year}}</td>
		</tr>
		
		<tr>
			<th> وصف الآلة </th>
			<td>{{$printingMachine->description}}</td>
		</tr>
		
		
		<tr>
			<th> سعر الآلة عند البيع بدون ضريبة </th>
			<td>{{$printingMachine->price_without_tax}}</td>
		</tr>
		
		<tr>
			<th> سعر الآلة عند البيع بالضريبة </th>
			<td>{{$printingMachine->price_with_tax}}</td>
		</tr>
		
		<tr>
			<th> هل هذة الآلة تم بيعها عن طريق الشركة العربية؟ </th>
			<td>{{($printingMachine->is_sold_by_aoe)? "نعم":"لا"}}</td>
		</tr>
		
		<tr>
			<th> اسم الموظف الذي قام بتسليم الآلة </th>
			<td>{{$printingMachine->employee_delivered_the_machine}}</td>
		</tr>
		
		<tr>
			<th>
				اسماء الموظفين المعينين لهذة الآلة
			</th>
			<td>
				@foreach ($printingMachine->assignedEmployees as $key => $employee)
				<a href="{{action('EmployeeController@show', ['id'=>$employee->id])}}">
					<span class="label label-default">{{$employee->user->name or ''}}</span>
				</a>
				@endforeach
			</td>
		</tr>
		
		<tr>
			<th>  رقم محضر التركيب </th>
			<td>
				<a href="{{action('InstallationRecordController@show', ['id'=>($printingMachine->installationRecord)?($printingMachine->installationRecord->id):('')])}}">
					{{ ($printingMachine->installationRecord)?($printingMachine->installationRecord->id):('') }}					
				</a>
			</td>
		</tr>
		
		<tr>
			<th>فيدر موديل</th>
			<td>{{$printingMachine->feeder_model}}</td>
		</tr>
		<tr>
			<th>فينشر موديل</th>
			<td>{{$printingMachine->finisher_model}}</td>
		</tr>
		<tr>
			<th>هارد ديسك موديل</th>
			<td>{{$printingMachine->hard_disk_model}}</td>
		</tr>
		<tr>
			<th>بابير درو موديل</th>
			<td>{{$printingMachine->paper_drawer_model}}</td>
		</tr>
		<tr>
			<th>نيتورك سكانير موديل</th>
			<td>{{$printingMachine->network_scanner_model}}</td>
		</tr>
		
		<tr>
			<th> الملاحظات </th>
			<td>{{$printingMachine->comments}}</td>
		</tr>
		
	</tbody>
</table>
</div>
