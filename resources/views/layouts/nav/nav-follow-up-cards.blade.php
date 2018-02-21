<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_follow_up_cards',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 بطاقات المتــابعة
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_follow_up_cards', $permissions))
				<li class="dropdown-header"> بطاقات المتابعة </li>
				<li><a href="{{ action('FollowUpCardController@index') }}"> عرض كل بطاقات المتابعة </a></li>
				@if(in_array('create_follow_up_cards', $permissions))
					<li><a href="{{ action('FollowUpCardController@create') }}"> إضافة بطاقة متابعة جديد </a></li>
				@endif
			@endif
			@if(in_array('view_follow_up_card_special_reports', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> التقارير الخاصة ببطاقات المتابعة  </li>
				<li><a href="{{ action('FollowUpCardSpecialReportController@index') }}"> عرض كل التقارير الخاصة ببطاقات المتابعة  </a></li>
				@if(in_array('create_follow_up_card_special_reports', $permissions))
					<li><a href="{{ action('FollowUpCardSpecialReportController@create') }}"> إضافة تقرير خاص لبطاقة متابعة  </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
