<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_reference',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الإشارات
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_reference', $permissions))
				<li class="dropdown-header">  الإشارات </li>
				@if(in_array('view_references', $permissions))
					<li><a href="{{ action('ReferenceController@index') }}"> عرض كل الإشارات </a></li>
				@endif
				@if(in_array('create_references', $permissions))
					<li><a href="{{ action('ReferenceController@create') }}"> إنشاء إشارة جديدة </a></li>
				@endif
			@endif
			@if(in_array('view_references_reports', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> <i class="glyphicon glyphicon-info-sign"></i>  تقرير </li>
				@if(in_array('view_references_during_last_two_working_days_report', $permissions))
					<li><a href="{{ action('ReferenceController@referencesDuringLastTwoWorkingDaysReport') }}"> تقرير عن الإشارات التي تم استلامها خلال آخر يومين عمل </a></li>
				@endif
				@if(in_array('view_references_still_open_after_forty_eight_hours_report', $permissions))
					---
					<li><a href="{{ action('ReferenceController@referencesStillOpenAfterFortyEightHoursReport') }}"> تقرير عن الإشارات التي ما زالت مفتوحة بعد مرور 48 ساعة </a></li>
				@endif
				@if(in_array('view_references_in_specific_period_report', $permissions))
					---
					<li><a href="{{ action('ReferenceController@indexReferencesInSpecificPeriodReport') }}"> تقرير عن الإشارات التي تمت في فترة محددة </a></li>
				@endif
			@endif
			
		</ul>
	</li>
	
</ul>
