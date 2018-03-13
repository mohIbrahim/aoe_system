<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_references',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الإشارات
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_references', $permissions))
				<li class="dropdown-header">  الإشارات </li>
				<li><a href="{{ action('ReferenceController@index') }}"> عرض كل الإشارات </a></li>
				@if(in_array('create_references', $permissions))
					<li><a href="{{ action('ReferenceController@create') }}"> إنشاء إشارة جديدة </a></li>
				@endif
			@endif
			@if(in_array('view_references', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header">  التقارير </li>				
				<li><a href="{{ action('ReferenceController@referencesReportDuringLastTwoWorkingDays') }}"> تقرير عن الإشارات التي تم <br> استلامها خلال آخر يومين عمل </a></li>				
			@endif
			
		</ul>
	</li>
	
</ul>
