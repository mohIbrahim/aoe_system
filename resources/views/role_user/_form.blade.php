@if(isset($permissions) && in_array('create_roles', $permissions))
	<div class="form-group">
		<label for="name">UserName: {{$user->name}}</label>
	</div>
	<div class="form-group">
		<label for="roles" class="label label-success">Chose user Role</label>

			<select class="select_2 form-control" name="roles[]" placeholder="Select Role" multiple="multiple">
				@foreach ($rolesArray as $key => $role)
					<option value="{{$key}}" {{(in_array($key, $selectedRoles))?'selected':''}}>{{$role}}</option>
				@endforeach
			</select>

	</div>

	<div class="form-group">
		<input type="submit" name="Save" value="Save" class="btn btn-primary">
	</div>
@endif
