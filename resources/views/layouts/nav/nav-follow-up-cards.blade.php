<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_follow_up_card',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 بطاقات المتــابعة
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_follow_up_card', $permissions))
				<li class="dropdown-header"> بطاقات المتابعة </li>
				@if(in_array('view_follow_up_cards', $permissions))
					<li><a href="{{ action('FollowUpCardController@index') }}"> عرض كل بطاقات المتابعة </a></li>
				@endif
				@if(in_array('create_follow_up_cards', $permissions))
					<li><a href="{{ action('FollowUpCardController@create') }}"> إنشاء بطاقة متابعة جديد </a></li>
				@endif
			@endif
			@if(in_array('view_follow_up_card_special_report', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> التقارير الخاصة ببطاقات المتابعة  </li>
				@if(in_array('view_follow_up_card_special_reports', $permissions))
					<li><a href="{{ action('FollowUpCardSpecialReportController@index') }}"> عرض كل التقارير الخاصة ببطاقات المتابعة  </a></li>
				@endif
				@if(in_array('create_follow_up_card_special_reports', $permissions))
					<li><a href="{{ action('FollowUpCardSpecialReportController@create') }}"> إنشاء تقرير خاص لبطاقة متابعة  </a></li>
				@endif
			@endif
			@if(in_array('view_follow_up_cards_reports', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> <i class="glyphicon glyphicon-info-sign"></i> تقرير </li>
				@if(in_array('view_visits_not_done_on_time_for_follow_up_cards_report', $permissions))
					<li><a href="{{ action('FollowUpCardController@visitsNotDoneOnTimeReport') }}"> تقرير عن الزيارات التي لم تتم خلال فترة محددة لبطاقات المتابعة </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
