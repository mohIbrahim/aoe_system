<h3 class="text-center"> الفواتير </h3>
@if(in_array('create_invoices', $permissions) && isset($printingMachine->customer))
	<a href="{{action('InvoiceController@createWithCustomerId', ['customer_id'=>$printingMachine->customer->id])}}"><span class="glyphicon glyphicon-plus"></span> إنشاء فاتورة جديدة </a>
@endif
<hr />
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th> رقم الفاتورة </th>
				<th> نوع الفاتورة </th>
				<th> الكود  (المقايسة أو التعاقد)</th>
				<th> تاريخ الإصدار </th>
				<th> الإجمالي </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="7" class="text-center">
					<h4>فواتير التعاقدات</h4>
				</td>
			</tr>
			@if ($printingMachine->contracts->isNotEmpty())
				
				@foreach ($printingMachine->contracts as $contractIterator => $contract)
					@foreach ($contract->invoices as $invoiceIterator => $invoice)
						@if($printingMachine->customer->id == $invoice->customer->id)
							<tr>
								<td>
									<a href="{{action('InvoiceController@show', ['id'=>$invoice->id])}}">
										{{$invoice->number or '	لم يتم تعين الرقم'}}
									</a>
								</td>
								<td>{{$invoice->type}}</td>
								<td>
									<a href="{{ action('ContractController@show', ['id'=>$contract->id]) }}" target="_blank">
										{{$contract->code}}
									<a>
								</td>
								<td>{{$invoice->release_date}}</td>
								<td>{{$invoice->total.' جنية'}}</td>
							</tr>
						@endif
					@endforeach
				@endforeach
			
			@endif
			<tr>
				<td colspan="7" class="text-center">
					<h4>فواتير المقايسات</h4>
				</td>
			</tr>
			@if ($printingMachine->phoneIndexations->isNotEmpty())
				@foreach ($printingMachine->phoneIndexations as $phoneIndexationKey => $indexation)
					@if(!empty($indexation->invoice))
						<tr>
							<td>
								<a href="{{action('InvoiceController@show', ['id'=>$indexation->invoice->id])}}">
									{{$indexation->invoice->number or '	لم يتم تعين الرقم'}}
								</a>
							</td>
							<td>{{$indexation->invoice->type}}</td>
							<td>
								<a href="{{ action('IndexationController@show', ['id'=>$indexation->id]) }}" target="_blank">
									{{$indexation->code}}
								<a>
							</td>
							<td>{{$indexation->invoice->release_date}}</td>
							<td>{{$indexation->invoice->total.' جنية'}}</td>
						</tr>
					@endif
				@endforeach
			@endif
		</tbody>
	</table>
</div>
