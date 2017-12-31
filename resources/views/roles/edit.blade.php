@extends('layouts.app')
@section('title')
	Edit Role
@endsection
@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Role</h3>
				</div>
				<div class="panel-body ">
					<!-- validation errors -->
					@include('errors.list')
					<form class="" action="{{action('RoleController@update', ['id'=>$role->id])}}" method="post">
						<input type="hidden" name="_method" value="PATCH">
						{{ csrf_field() }}
						@include('roles._form')
					</form>
				</div>
			</div>

		</div>
	</div>
@endsection
