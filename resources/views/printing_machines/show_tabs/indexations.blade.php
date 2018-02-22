<h3 class="text-center"> المقايسات </h3>
<a href="{{action('IndexationController@create')}}"><span class="glyphicon glyphicon-plus"></span> إنشاء مقايسة جديدة </a>
<hr />
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th> # </th>
				<th> كود المقايسة </th>
				<th> التاريخ  </th>
				<th> موافقة العميل </th>
				<th> موافقة مدير الأقسام الفنية </th>
				<th> موافقة المخازنة </th>
				<th> رقم الزيارة </th>
			</tr>
		</thead>
		<tbody>

			@foreach ($printingMachine->visits as $visitsIterator => $visit)
				@if($visit->indexation)
					<tr>
						<td>{{$visitsIterator+1}}</td>
						<td>
							<a href="{{action('IndexationController@show', ['id'=>(($visit->indexation)?($visit->indexation->id):(''))])}}">
								{{$visit->indexation->code or ''}}
							</a>
						</td>
						<td>{{$visit->indexation->the_date or ''}}</td>
						<td>{{$visit->indexation->customer_approval or ''}}</td>
						<td>{{$visit->indexation->technical_manager_approval or ''}}</td>
						<td>{{$visit->indexation->warehouse_approval or ''}}</td>
						<td>
							<a href="{{action('VisitController@show', ['id'=>$visit->id])}}">
								{{$visit->id or ''}}
							</a>
						</td>
					</tr>
				@endif
			@endforeach
		</tbody>
	</table>
</div>
