<h3 class="text-center"> الزيارات </h3>
<a href="{{action('VisitController@createWithPrintingMachineId', ['printing_machine_id'=>$printingMachine->id] )}}"><span class="glyphicon glyphicon-plus"></span> إنشاء زيارة جديدة </a>
<hr />
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th> رقم الزيارة </th>
				<th> تاريخ الزيارة </th>
				<th> نوع الزيارة </th>
				<th> قراءة العداد </th>
				<th> إضافة مقايسة </th>
			</tr>
		</thead>
		<tbody>

			@foreach ($printingMachine->visits as $key1 => $visit)
				<tr>
					<td>
						<a href="{{action('VisitController@show', ['id'=>$visit->id])}}">
							{{$visit->id}}
						</a>
					</td>
					<td>{{$visit->visit_date}}</td>
					<td>{{$visit->type}}</td>
					<td>{{$visit->readings_of_printing_machine}}</td>
					@if( in_array('create_indexations', $permissions ))
						<td>
							<a href="{{action('IndexationController@createIndexationWithVisitId', ['visit_id'=>$visit->id])}}">
								إضافة مقايسة لهذة الزيارة
							</a>
						</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
