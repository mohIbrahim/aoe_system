<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_printing_machines',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الآلات الطباعة
			<span class="caret"></span>
		</a>
		@endif

		<ul class="dropdown-menu">
			@if(in_array('view_printing_machines', $permissions))
				<li class="dropdown-header"> الآلات </li>
				<li><a href="{{ action('PrintingMachineController@index') }}"> عرض كل الآلات </a></li>
				@if(in_array('create_printing_machines', $permissions))
					<li><a href="{{ action('PrintingMachineController@create') }}"> إضافة آلة  </a></li>
				@endif
				<li role="separator" class="divider"></li>
			@endif
		</ul>
	</li>
</ul>
