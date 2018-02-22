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
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
