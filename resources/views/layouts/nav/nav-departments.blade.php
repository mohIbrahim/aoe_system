<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_departments',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الأقســام
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_departments', $permissions))
				<li class="dropdown-header"> الأقســام </li>
				<li><a href="{{ action('DepartmentController@index') }}"> عرض كل الأقســام </a></li>
				@if(in_array('create_departments', $permissions))
					<li><a href="{{ action('DepartmentController@create') }}"> إنشاء قسم جديد </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
