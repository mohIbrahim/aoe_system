@php
	$userImageName = (isset($user->images->first()->name))? $user->images->first()->name : 'no_image.png';
	$userImageId = (isset($user->images->first()->id))? $user->images->first()->id : '';
@endphp
<div class="row main_arabic_font">
	<div class="col-lg-4 col-lg-offset-1">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"> الصورة الشخصية </h3>
			</div>
			<div class="panel-body">
				<div class="col-lg-offset-1 col-md-offset-1 col-xs-offset-1">
					<img src="{{ asset('images/project_images/'.$userImageName)}}" class="img-responsive"  alt="Image">
					<input type="hidden" name="project_image_id" value="{{$userImageId}}">
					@if($userImageName != 'no_image.png')
						<button type="submit" name="delete_image" class="btn btn-xs btn-danger" value="{{$userImageId}}">Delete the image</button>
					@endif
				</div>

				<div class="form-group">
					<label for="personal_image" class="label label-success"> تغير صورة الملف الشخصي </label>
					<input type="file" name="personal_image" value="" class="form-control">
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="form-group">
			<label for="current_password" class="label label-success"> كلمة السر الحالية </label>
			<input type="password" name="current_password" value="" class="form-control" placeholder="إدخل كلمة السر الحالية">
		</div>

		<div class="form-group">
			<label for="name" class="label label-success"> الاسم بالكامل </label>
			<input type="text" name="name" value="{{$user->name or ''}}" class="form-control" placeholder=" إدخل الاسم بالكامل ">
		</div>

		<div class="form-group">
			<label for="email" class="label label-success"> البريد الالكتروني </label>
			<input type="text" name="email" value="{{$user->email}}" class="form-control" placeholder=" إدخل البريد الالكتروني ">
		</div>

		<div class="form-group">
			<label for="password" class="label label-success"> كلمة السر الجديدة </label>
			<input type="password" name="password" value="" class="form-control" placeholder=" إدخل كلمة السر الجديدة ">
		</div>

		<div class="form-group">
			<label for="password_confirmation" class="label label-success"> تأكيد إدخال كلمة السر الجديدة </label>
			<input type="password" name="password_confirmation" value="" class="form-control" placeholder=" إدخل كلمة السر الجديدة مرة أخره ">
		</div>
		<div class="form-group">
			<input type="submit" name="save" value="حفظ" class="btn btn-primary form-control">
		</div>
	</div>
</div>
