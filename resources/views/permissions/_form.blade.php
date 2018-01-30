<div class="form-group">
	<label for="title">Title:</label>
	<input type="text" name="title" value="{{$permission->title or ''}}" class="form-control" placeholder="Enter Permission Title">
</div>

<div class="form-group">
	<label for="name">Name:</label>
	<input type="text" name="name" value="{{$permission->name or ''}}" class="form-control" placeholder="Enter Permission Name">
</div>

<div class="form-group">
	<input type="submit" name="" value="Save" class="btn btn-primary">
</div>
