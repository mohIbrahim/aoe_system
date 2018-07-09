<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_indexations',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  المقايســات
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_indexations', $permissions))
				<li class="dropdown-header">  المقايســات </li>
				<li><a href="{{ action('IndexationController@index') }}"> عرض كل المقايســات </a></li>
				@if(in_array('create_indexations', $permissions))
					<li><a href="{{ action('IndexationController@create') }}"> إنشاء مقايسة جديد </a></li>
				@endif
			@endif
			@if(in_array('view_indexations_reports', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> <i class="glyphicon glyphicon-info-sign"></i>  تقرير </li>
				@if(in_array('view_indexations_released_in_specific_period_report', $permissions))
					<li><a href="{{ action('IndexationController@getIndexationsReleasedInSpecificPeriodReport') }}"> تقرير عن المقايسات المصدرة خلال مدة معينة </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
