<h3 class="text-center"> الفواتير </h3>
<a href="{{action('InvoiceController@create')}}"><span class="glyphicon glyphicon-plus"></span> إضافة فاتورة جديدة </a>
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
			@if ($printingMachine->customer)
				@if ($printingMachine->customer->invoices)
					@foreach ($printingMachine->customer->invoices as $invoiceIterator => $invoice)
						<tr>
							<td>
								<a href="{{action('InvoiceController@show', ['id'=>$invoice->id])}}">
									{{$invoice->number}}
								</a>
							</td>
							<td>{{$invoice->type}}</td>
							<td>{{$invoice->release_date}}</td>
							<td>{{$invoice->total}}</td>
						</tr>
					@endforeach
				@endif
			@endif
		</tbody>
	</table>
</div>
