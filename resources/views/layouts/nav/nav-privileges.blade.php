<ul class="nav navbar-nav">
	<li class="dropdown">
		@if(in_array('view_permissions',$permissions))
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			Privileges
			<span class="caret"></span>
		</a>
		@endif
		<ul class="dropdown-menu">
			@if(in_array('view_users', $permissions))
				<li class="dropdown-header">Users</li>
				<li><a href="{{ action('UserController@index') }}">Show All Users</a></li>
				<li role="separator" class="divider"></li>
			@endif
			@if(in_array("view_roles", $permissions))
				<li class="dropdown-header">Roles</li>

				@if(in_array("create_roles", $permissions))
					<li><a href="{{ action('RoleController@create') }}">Create Role</a></li>
				@endif

				@if(in_array('view_roles', $permissions))
					<li><a href="{{ action('RoleController@index') }}">View All Role</a></li>
				@endif

				<li role="separator" class="divider"></li>
			@endif
			@if(in_array('view_permissions', $permissions))
				<li class="dropdown-header">Permissions</li>
				@if(in_array('create_permissions', $permissions))
					<li><a href="{{ action('PermissionController@create') }}">Create Permission</a></li>
				@endif

				@if(in_array('view_permissions', $permissions))
					<li><a href="{{ action('PermissionController@index') }}" >View All Permissions</a></li>
				@endif
			@endif
		</ul>
	</li>
</ul>
