<ul class="nav navbar-nav main_arabic_font">
	<li class="dropdown">
		@if(in_array('view_invoices',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			 الفواتيـــر
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_invoices', $permissions))
				<li class="dropdown-header">  الفواتيـــر </li>
				<li><a href="{{ action('InvoiceController@index') }}"> عرض كل الفواتيـــر </a></li>
				@if(in_array('create_invoices', $permissions))
					<li><a href="{{ action('InvoiceController@create') }}"> إضافة محضر تركيب جديد </a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
