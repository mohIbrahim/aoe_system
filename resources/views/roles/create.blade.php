@extends('layouts/app')
@section('title')
	Create Role
@endsection
@section('content')
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Add New Role</h3>
			</div>
				<div class="panel-body ">
					<!-- validation errors -->
					@include('errors.list')
					<form class="" action="{{action('RoleController@store')}}" method="post">
						{{ csrf_field() }}
						@include('roles._form')
					</form>
				</div>
			</div>
		</div>
@endsection
