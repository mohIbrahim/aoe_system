@extends('layouts.app')
@section('title')
	Assign Role
@endsection
@section('head')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Assign Role</h3>
		</div>
			<div class="panel-body ">
				@include('errors.list')
				<form class="" action="{{action('RoleUserController@update',['id'=>$user->id])}}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="_method" value="PATCH">
					@include('role_user._form')
				</form>
			</div>
		</div>

	</div>
@stop
@section('js_footer')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".select_2").select2();

		});
	</script>
@endsection
