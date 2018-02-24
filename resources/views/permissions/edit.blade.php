@extends('layouts.app')
@section('title')
	Edit Permission
@endsection
@section('content')
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Update Permission</h3>
		</div>
			<div class="panel-body ">
				@include('errors.list')
				<form class="form" action="{{action('PermissionController@update', [ 'id'=>$permission->id])}}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="_method" value="PATCH">
					@include('permissions._form')
				</form>
			</div>
		</div>

	</div>
</div>
@stop
