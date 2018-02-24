@extends('layouts.app')
@section('title')
	Edit profile
@endsection
@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title text-center"><strong>{{$user->name or ''}}</strong></h3>
		</div>
			<div class="panel-body ">
				@include('errors.list')
				<form class="" action="{{action('UserController@update',['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_method" value="PATCH">
					{{ csrf_field() }}
					@include('users._form')
				</form>
			</div>
		</div>
	</div>
@endsection
