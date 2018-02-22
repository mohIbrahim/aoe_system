<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_employees',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الموظفيـن
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_employees', $permissions))
				<li class="dropdown-header"> الموظفيـن </li>
				<li><a href="{{ action('EmployeeController@index') }}"> عرض كل الموظفيـن </a></li>
				@if(in_array('create_employees', $permissions))
					<li><a href="{{ action('EmployeeController@create') }}"> إنشاء موظف جديد </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
