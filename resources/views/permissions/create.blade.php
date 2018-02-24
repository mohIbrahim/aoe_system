@extends('layouts/app')
@section('title')
	Create Permission
@endsection
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Add New Permission</h3>
			</div>
				<div class="panel-body ">
					@include('errors.list')
					<form class="" action="{{ action('PermissionController@store') }}" method="post">
						{{ csrf_field() }}
						@include('permissions._form')
					</form>
				</div>
			</div>
		</div>
	</div>
@stop()
