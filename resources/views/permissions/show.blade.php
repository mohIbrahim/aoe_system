@extends('layouts.app')
@section('title')
	{{$permission->name}}
@endsection
@section('content')


		<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">All Permissions</h3>
			</div>
				<div class="panel-body ">

					<table class="table table-hover">
						<th>ID</th>
						<th>Name</th>

						@if(in_array('update_permissions', $permissions))
							<th>Edit Permission</th>
						@endif

						@if(in_array('delete_permissions', $permissions))
							<th>Delete Permission</th>
						@endif
						
					
						<tr>

							<td>{{$permission->id}}</td>
							<td>{{$permission->name}}</td>

							@if(in_array('update_permissions', $permissions))
								<td><a href="{{ action('PermissionController@edit',['id'=>$permission->id]) }}">Eidt</td>
							@endif

							@if(in_array('delete_permissions', $permissions))
								<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button></td>
							@endif


						</tr>
						
		

					</table>


				</div>
			</div>

		</div>
	</div>


	@include('partial.deleteConfirm',['name'=>$permission->name,
										'id'=>$permission->id,
										'message'=>'Are you sure you want to delete',
										'route'=>'PermissionController@destroy'])

@stop()