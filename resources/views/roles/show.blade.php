@extends('layouts.app')

@section('title')
	{{$role->name}}
@endsection

@section('content')	

	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Role</h3>
		</div>
			<div class="panel-body ">			

				<table class="table">
					<th>ID</th>
					<th>Name</th>
					@if(in_array('update_roles', $permissions))
						<th>Edit</th>
					@endif
					@if(in_array('delete_roles', $permissions))
						<th>Delet</th>
					@endif
					<tr>
						<td>{{$role->id}}</td>
						<td>{{$role->name}}</td>
						@if(in_array('update_roles', $permissions))
							<td><a href="{{action('RoleController@edit',['id'=>$role->id])}}"> Edit</a></td>
						@endif
						@if(in_array('delete_roles', $permissions))
							<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button></td<button></tr>
						@endif
					</tr>

				</table>
				
				


			</div>
		</div>

	</div>

	@include('partial.deleteConfirm',['name'=>$role->name,
									  'id'=> $role->id,
									  'message'=>'Are you sure you want to delete',
									  'route'=>'RoleController@destroy'])

@stop()

