<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_employee',$permissions))
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				الموظفيـن
				<span class="caret"></span>
			</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_employee', $permissions))
				<li class="dropdown-header"> الموظفيـن </li>
				@if(in_array('view_employees', $permissions))
					<li><a href="{{ action('EmployeeController@index') }}"> عرض كل الموظفيـن </a></li>
				@endif
				@if(in_array('create_employees', $permissions))
					<li><a href="{{ action('EmployeeController@create') }}"> إنشاء موظف جديد </a></li>
				@endif
				@if(in_array('view_employees_reports', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> <i class="glyphicon glyphicon-info-sign"></i>  تقرير </li>
				@if(in_array('view_responsible_employees_for_invoices_not_paid_report', $permissions))
					<li><a href="{{ action('EmployeeController@getResponsibleEmployeesForInvoicesNotPaidReport') }}">تقرير عن المواظفين المسؤولين عن الفواتير التي لم يتم تحصيلها</a></li>
				@endif
			@endif
			@endif
		</ul>
	</li>
</ul>
