<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_contract',$permissions))
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				العقود
				<span class="caret"></span>
			</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_contract', $permissions))
				<li class="dropdown-header"> العقود </li>
				@if(in_array('view_contracts', $permissions))
					<li><a href="{{ action('ContractController@index') }}"> عرض كل العقود </a></li>
				@endif
				@if(in_array('create_contracts', $permissions))
					<li><a href="{{ action('ContractController@create') }}"> إنشاء عقد جديد </a></li>
				@endif
				@if(in_array('view_contracts_reports', $permissions))
					<li role="separator" class="divider"></li>
					<li class="dropdown-header"> <i class="glyphicon glyphicon-info-sign"></i>  تقرير </li>
					@if(in_array('view_contracts_expire_within_next_3_monthes_report', $permissions))
						<li>
							<a href="{{ action('ContractController@contractsThatWillExpireWithinTheNextThreeMonthesReport') }}">تقرير عن العقود التي سوف تنتهي خلال الثلاث شهور القادمة</a>
						</li>
					@endif
					<li>-</li>
					@if(in_array('view_contracts_invoices_are_due_in_this_month_report', $permissions))
						<li>
							<a href="{{ action('ContractController@contractsInvoicesAreDueInThisMonthReport') }}"> تقرير عن فواتير العقود واجبة التحصيل لهذا الشهر 
							</a>
						</li>
					@endif
				@endif
			@endif
		</ul>
	</li>
</ul>
