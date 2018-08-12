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
			<tr>
				<td colspan="7" class="text-center">
					<h4>المقايسات بالزيارة</h4>
				</td>
			</tr>

			@foreach ($printingMachine->visits as $visitsIterator => $visit)
				@if($visit->indexation)
					<tr>
						<td>
							{{$visitsIterator+1}}
						</td>
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
			<tr>
				<td colspan="7" class="text-center">
					<h4>المقايسات التليفونية</h4>
				</td>
			</tr>
			@foreach ($printingMachine->phoneIndexations as $indexationKey => $indexation)
				
					<tr>
						<td>
							{{$indexationKey+1}}
						</td>
						<td>
							<a href="{{action('IndexationController@show', ['id'=>(($indexation)?($indexation->id):(''))])}}" target="_blank">
								{{$indexation->code or ''}}
							</a>
						</td>
						<td>{{$indexation->the_date or ''}}</td>
						<td>{{$indexation->customer_approval or ''}}</td>
						<td>{{$indexation->technical_manager_approval or ''}}</td>
						<td>{{$indexation->warehouse_approval or ''}}</td>
						<td>
							-
						</td>
					</tr>
				
			@endforeach
		</tbody>
	</table>
</div>


