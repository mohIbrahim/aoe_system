<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_invoice',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الفواتيـــر
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_invoice', $permissions))
				<li class="dropdown-header">  الفواتيـــر </li>
				@if(in_array('view_invoices', $permissions))
					<li><a href="{{ action('InvoiceController@index') }}"> عرض كل الفواتيـــر </a></li>
				@endif
				@if(in_array('create_invoices', $permissions))
					<li><a href="{{ action('InvoiceController@create') }}"> إنشاء فاتورة جديدة </a></li>
				@endif
			@endif
			@if(in_array('view_invoices_reports', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> <i class="glyphicon glyphicon-info-sign"></i>  تقرير </li>
				@if(in_array('view_invoices_released_in_specific_period_report', $permissions))
					<li><a href="{{ action('InvoiceController@getInvoicesReleasedInSpecificPeriodReport') }}">تقرير عن الفواتير المصدرة خلال فترة معينة</a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
