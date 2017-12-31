<?php
	$flag = 0;
	$bool = false;
?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>
				Role Name <span style="color: red;"> +</span>
			</th>
			<th>
				Privileges <span style="color: red;"> +</span>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="col-md-2">
				<div class="form-group">
					<input type="text" name="name" value="{{$role->name or ''}}" class="form-control" placeholder="Enter Role Name.">
				</div>
			</td>
			<td class="col-md-2">
				@foreach($permissions as $key=>$permission)
					<?php
						if(isset($role)){
							$bool = in_array($permission->name, $role->permissions->pluck('name')->toArray());
						}else{
							$bool = false;
						}
					?>
					<div class="form-group">
						<input type="checkbox" name="permission[]" value="{{$permission->id or ''}}" {{($bool)? 'checked':''}} class="checkbox-inline">
						<label for="permission">{{ $permission->name }}</label>
					</div>

					<?php $flag++; ?>
					@if($flag == 4 )
						<hr>
						<?php $flag =0;?>
					@endif

				@endforeach
			</td>
		</tr>
	</tbody>
</table>
<div class="form-group">
	<input type="submit" name="Save" value="save" class="btn btn-primary" />
</div>
