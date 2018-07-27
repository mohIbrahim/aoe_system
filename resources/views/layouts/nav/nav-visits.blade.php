<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_visit',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الزيارات
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_visit', $permissions))
				<li class="dropdown-header">  الزيارات </li>
				@if(in_array('view_visits',$permissions))
					<li><a href="{{ action('VisitController@index') }}"> عرض كل الزيارات </a></li>
				@endif
				@if(in_array('create_visits', $permissions))
					<li><a href="{{ action('VisitController@create') }}"> إنشاء زيارة جديدة </a></li>
				@endif
			@endif
			@if(in_array('view_visits_reports', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> <i class="glyphicon glyphicon-info-sign"></i> تقرير </li>
				@if(in_array('view_visits_in_specific_period_report', $permissions))
					<li><a href="{{ action('VisitController@indexVisitsInSpecificPeriodReport') }}"> تقرير عن الزيارات التي تمت في فترة محددة </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
