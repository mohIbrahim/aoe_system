<h3 class="text-center"> الفواتير </h3>
<a href="{{action('InvoiceController@create')}}"><span class="glyphicon glyphicon-plus"></span> إنشاء فاتورة جديدة </a>
<hr />
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th> رقم الفاتورة </th>
				<th> نوع الفاتورة </th>
				<th> تاريخ الإصدار </th>
				<th> الإجمالي </th>
			</tr>
		</thead>
		<tbody>
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
								<td>{{$invoice->release_date}}</td>
								<td>{{$invoice->total.' جنية'}}</td>
							</tr>
						@endif
					@endforeach
				@endforeach
			
			@endif
		</tbody>
	</table>
</div>
