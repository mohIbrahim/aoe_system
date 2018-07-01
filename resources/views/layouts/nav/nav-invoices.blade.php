<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_invoices',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الفواتيـــر
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_invoices', $permissions))
				<li class="dropdown-header">  الفواتيـــر </li>
				<li><a href="{{ action('InvoiceController@index') }}"> عرض كل الفواتيـــر </a></li>
				@if(in_array('create_invoices', $permissions))
					<li><a href="{{ action('InvoiceController@create') }}"> إنشاء فاتورة جديدة </a></li>
				@endif
			@endif
			@if(in_array('view_invoices_reports', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> <i class="glyphicon glyphicon-info-sign"></i>  تقرير </li>
				@if(in_array('view_responsible_employees_for_invoices_not_paid_report', $permissions))
					<li><a href="{{ action('InvoiceController@getResponsibleEmployeesForInvoicesNotPaidReport') }}">تقرير عن المواظفين المسؤولين عن الفواتير التي لم يتم تحصيلها</a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
