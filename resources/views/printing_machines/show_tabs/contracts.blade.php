<h3 class="text-center"> العقود </h3>
<a href="{{action('ContractController@createWithPrintingMachineId', ['printing_machine_id'=>$printingMachine->id] )}}"><span class="glyphicon glyphicon-plus"></span> إنشاء عقد جديدة </a>
<hr />
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th> # </th>
				<th> كود العقد </th>
				<th> نوع العقد </th>
				<th> بطاقة المتابعة </th>
				<th> بداية التعاقد </th>
				<th> نهاية التعاقد </th>
				<th> حالة التعاقد </th>
				<th> محضر التركيب </th>
			</tr>
		</thead>
		<tbody>

			@foreach ($printingMachine->contracts as $key2 => $contract)
				<tr>
					<td>{{$key2+1}}</td>
					<td>
						<a href="{{action('ContractController@show', ['id'=>$contract->id])}}">
							{{$contract->code}}
						</a>
					</td>
					<td>{{$contract->type}}</td>
					<td>
						<a href="{{action('FollowUpCardController@show', ['id'=>(($contract->followUpCard)?($contract->followUpCard->id):(''))])}}">
							{{($contract->followUpCard)?($contract->followUpCard->code):('')}}
						</a>
					</td>
					<td>{{$contract->start}}</td>
					<td>{{$contract->end}}</td>
					<td>{{$contract->status}}</td>
					<td>
						<a href="{{action('InstallationRecordController@show', ['id'=>(($contract->installationRecord)?($contract->installationRecord->id):(''))])}}">
							{{$contract->installationRecord->id or ''}}
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
