@extends('layouts.app')

@section('title')
	All Roles
@endsection
			
@section('content')

	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">All Roles</h3>
		</div>
			<div class="panel-body ">	
					
				<table class="table">
					<th>ID</th>
					<th>Name</th>

						@foreach($roles as $role)
							<tr>									
								<td>{{$role->id}}</td>
								<td><a href="{{ action('RoleController@show',['id'=>$role->id]) }}"> {{$role->name}}</a></td>
							</tr>
						@endforeach

				</table>
		
				


			</div>
		</div>

	</div>
	
	

@stop()