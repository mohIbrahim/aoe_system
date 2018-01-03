@extends('layouts.app')

@section('title')
	 عرض الآلات الطباعة
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">

				<form action="" method="POST" role="form">
					     <legend> البحث عن الآلات. </legend>

					     <div class="form-group">
						    <label for="">label</label>
						    <input type="text" class="form-control" id="" placeholder="Input field">
					     </div>



					     <button type="submit" class="btn btn-primary">Submit</button>
				</form>

				<h3 class="text-center"> عرض الآلات الطباعة </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
			  				    <th> رقم الملف الآلة </th>
			  				    <th> كود الآلة </th>
			  				    <th> الموديل </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody>
							@foreach ($printingMachines as $k => $printingMachine)
								<tr>
									<td>
										{{$k+1}}
									</td>
									<td><a href="{{action('PrintingMachineController@show', ['id'=>$printingMachine->id])}}">{{$printingMachine->folder_number}}</a></td>
									<td>{{$printingMachine->code}}</td>
									<td>{{"$printingMachine->model_prefix-$printingMachine->model_suffix"}}</td>
								</tr>
							@endforeach
			  		    </tbody>
			  	     </table>
				 </div>

		    </div>
		  </div>
	  </div>
	</div>

@endsection

@section('js_footer')
	<script type="text/javascript">
		$(document).ready(function(){
			$ajax({
				
			});
		});
	</script>
@endsection
