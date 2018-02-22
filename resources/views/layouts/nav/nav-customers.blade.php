<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_customers',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 العملاء
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_customers', $permissions))
				<li class="dropdown-header"> العملاء </li>
				<li><a href="{{ action('CustomerController@index') }}"> عرض كل العملاء </a></li>
				@if(in_array('create_customers', $permissions))
					<li><a href="{{ action('CustomerController@create') }}"> إنشاء عميل جديد </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
