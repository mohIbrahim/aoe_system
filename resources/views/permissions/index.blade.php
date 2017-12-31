@extends('layouts.app')
@section('title')
	All Permission
@endsection
@section('content')


		<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">All Permissions</h3>
			</div>
				<div class="panel-body ">

					<table class="table table-hover">
						<th>ID</th>
						<th>Name</th>
						

						@foreach($permissions as $permission)
						<tr>

							<td>{{$permission->id}}</td>
							<td><a href="{{ action('PermissionController@show',['id'=>$permission->id]) }}" >{{$permission->name}}</a></td>

						</tr>
						@endforeach
		

					</table>


				</div>
			</div>

		</div>
	</div>
<!-- child of the body tag -->
<span id="top-link-block" class="hidden">
    <a href="#top" class="well well-sm" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
        <i class="glyphicon glyphicon-chevron-up"></i> Back to Top
    </a>
</span><!-- /top-link-block -->
@stop()
@section('jsFooter')
<script>
// Only enable if the document has a long scroll bar
// Note the window height + offset
if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}
</script>
<style>
#top-link-block.affix-top {
    position: absolute; /* allows it to "slide" up into view */
    bottom: -82px;
    left: 10px;
}
#top-link-block.affix {
    position: fixed; /* keeps it on the bottom once in view */
    bottom: 18px;
    left: 10px;
}
</style>
@endsection