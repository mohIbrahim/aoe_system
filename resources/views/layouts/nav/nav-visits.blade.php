<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_visits',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الزيارات
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_visits', $permissions))
				<li class="dropdown-header">  الزيارات </li>
				<li><a href="{{ action('VisitController@index') }}"> عرض كل الزيارات </a></li>
				@if(in_array('create_visits', $permissions))
					<li><a href="{{ action('VisitController@create') }}"> إنشاء زيارة جديدة </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
