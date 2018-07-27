<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_installation_record',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			توريد / محاضر التراكيب
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_installation_record', $permissions))
				<li class="dropdown-header"> توريد | محاضر التراكيب </li>
				@if(in_array('view_installation_records', $permissions))
					<li><a href="{{ action('InstallationRecordController@index') }}"> عرض كل محاضر التراكيب </a></li>
				@endif
				@if(in_array('create_installation_records', $permissions))
					<li><a href="{{ action('InstallationRecordController@create') }}"> إنشاء محضر تركيب جديد </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
