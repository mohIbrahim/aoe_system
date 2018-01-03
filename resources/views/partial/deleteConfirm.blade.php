<!-- Modal -->
<div id="myModal" class="modal fade main_arabic_font" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">تأكيد الحذف</h4>
			</div>
			<div class="modal-body bg-danger">
				<form class="" action="{{action($route, ['id'=>$id])}}" method="post">
					<input type="hidden" name="_method" value="DELETE">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6" id="wrapeDelete">
							<strong>تحذير!</strong> {{ $message}}, <span style="color:red;">{{$name}}</span>.<br><br>
							<a href="{{action($route,['id'=>$id])}}">
								<button class="btn btn-danger" style="float: right;" >حذف</button>
							</a>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer bg-danger">
				<button type="button" class="btn btn-success" data-dismiss="modal">إغلاق</button>
			</div>
		</div>

	</div>
</div>
