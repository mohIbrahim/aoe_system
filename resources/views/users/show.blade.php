@extends('layouts.app')

@section('title')
	{{$user->name}}
@endsection

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">All Users</h3>
		</div>
			<div class="panel-body ">

				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Role</th>
							<th>Email</th>
							<th>Assign role</th>
							@if(in_array('update_users', $permissions))
								<th>Edit</th>
							@endif

							@if(in_array('delete_users', $permissions))
								<th>Delete</th>
							@endif
						</tr>
					</thead>
					<tbody>
							<tr>
								<td>{{$user->id}}</td>
								<td> {{$user->name}}</td>
								<td>
									@if($user->roles->isNotEmpty())
										@foreach ($user->roles as $key => $role)
											{{ $role->name}}<br>
										@endforeach
									@else
										No Role Yet!
									@endif
								</td>
								<td> {{ $user->email}} </td>
								@if(in_array('update_users', $permissions))
									<td> <a href="{{ action('RoleUserController@edit', ['id'=>$user->id]) }}"> Edit </td>

									<td> <a href="{{action('UserController@edit',['id'=>$user->id])}}">Eidt</a> </td>
								@endif

								@if(in_array('delete_users', $permissions))
									<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button></td>
								@endif

							</tr>

					</tbody>
				</table>
			</div>
		</div>

	</div>

	@include('partial.deleteConfirm',['name'=>$user->name,
									  'id'=> $user->id,
									  'message'=>'Are you sure you want to delete',
									  'route'=>'UserController@destroy'])
@stop
