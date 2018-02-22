<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_installation_records',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 محاضر التراكيب
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_installation_records', $permissions))
				<li class="dropdown-header">  محاضر التراكيب </li>
				<li><a href="{{ action('InstallationRecordController@index') }}"> عرض كل محاضر التراكيب </a></li>
				@if(in_array('create_installation_records', $permissions))
					<li><a href="{{ action('InstallationRecordController@create') }}"> إنشاء محضر تركيب جديد </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
