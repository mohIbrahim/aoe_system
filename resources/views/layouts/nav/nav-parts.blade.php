<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_parts',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 قطع الغيــار
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_parts', $permissions))
				<li class="dropdown-header"> قطع الغيار الرئيسية </li>
				<li><a href="{{ action('PartController@index') }}"> عرض كل قطع الغيار الرئيسية </a></li>
				@if(in_array('create_parts', $permissions))
					<li><a href="{{ action('PartController@create') }}"> إضافة قطعة غيار رئيسية جديدة </a></li>
				@endif
			@endif
			@if(in_array('view_part_serial_numbers', $permissions))
				<li role="separator" class="divider"></li>
				<li class="dropdown-header"> قطع الغيار الفرعية  </li>
				<li><a href="{{ action('PartSerialNumberController@index') }}"> عرض كل قطع الغيار الفرعية  </a></li>
				@if(in_array('create_part_serial_numbers', $permissions))
					<li><a href="{{ action('PartSerialNumberController@create') }}"> إضافة قطعة غيار فرعية جديد </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
