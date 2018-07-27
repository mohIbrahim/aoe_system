<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_part',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 قطع الآلــة
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_part', $permissions))
				<li class="dropdown-header"> قطع الآلة الرئيسية </li>
				@if(in_array('view_parts', $permissions))
					<li><a href="{{ action('PartController@index') }}"> عرض كل قطع الآلة الرئيسية </a></li>
				@endif
				@if(in_array('create_parts', $permissions))
					<li><a href="{{ action('PartController@create') }}"> إنشاء قطعة رئيسية جديدة </a></li>
				@endif
			@endif
			@if(in_array('view_part_serial_numbers', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> قطع الآلة الفرعية  </li>
				<li><a href="{{ action('PartSerialNumberController@index') }}"> عرض كل قطع الآلة الفرعية  </a></li>
				@if(in_array('create_part_serial_numbers', $permissions))
					<li><a href="{{ action('PartSerialNumberController@create') }}"> إنشاء قطعة فرعية جديد </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
