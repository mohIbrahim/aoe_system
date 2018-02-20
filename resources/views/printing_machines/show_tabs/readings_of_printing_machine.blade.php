<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<h3 class="text-center"> قراءات العداد </h3>
			<tr>
				<th> القراءة </th>
				<th> تاريخ أخذ القراءة </th>
				<th> رقم الزيارة </th>
			</tr>
		</thead>
		<tbody>

			@foreach ($printingMachine->readings as $key => $reading)
				<tr>
					<td>{{$reading->value}}</td>
					<td>{{$reading->reading_date}}</td>
					<td>
						<a href="{{action('VisitController@show', ['id'=>$reading->visit_id])}}">
							{{$reading->visit_id}}
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
