<h3 class="text-center"> الإشارات </h3>
<a href="{{action('ReferenceController@createWithPrintingMachineId', ['printing_machine_id'=>$printingMachine->id] )}}"><span class="glyphicon glyphicon-plus"></span> إضافة إشارة جديدة </a>
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
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
