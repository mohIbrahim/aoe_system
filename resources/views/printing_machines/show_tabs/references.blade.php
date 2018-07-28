<h3 class="text-center"> الإشارات </h3>
<a href="{{action('ReferenceController@createWithPrintingMachineId', ['printing_machine_id'=>$printingMachine->id] )}}"><span class="glyphicon glyphicon-plus"></span> إنشاء إشارة جديدة </a>
<hr />
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th> # </th>
				<th> كود الإشارة </th>
				<th> نوع الإشارة </th>
				<th> تاريخ الاستلام </th>
				<th> المهندس المعين </th>
				<th> إضافة زيارة </th>
			</tr>
		</thead>
		<tbody>

			@foreach ($printingMachine->references as $key2 => $reference)
				<tr>
					<td>{{$key2+1}}</td>
					<td>
						<a href="{{action('ReferenceController@show', ['id'=>$reference->id])}}">
							{{$reference->code}}
						</a>
					</td>
					<td>{{$reference->type}}</td>
					<td>{{$reference->received_date}}</td>
					<td>{{$reference->assignedEmployee->user->name or ''}}</td>
					<td>
						<a href="{{ action('VisitController@createWithPrintingMachineIdAndReferenceId', ['pm_id'=>(($reference->printingMachine)?(($reference->printingMachine->id)?($reference->printingMachine->id):('')):('')), 'refernce_id'=>$reference->id]) }}" target="_blank">
                        <span class="glyphicon glyphicon-plus"></span>
                            إضافة زيارة
                        </a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
