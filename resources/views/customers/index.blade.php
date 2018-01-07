@extends('layouts.app')

@section('title')
	 عرض الآلات الطباعة
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">



				<legend> البحث عن الآلات. </legend>

				<div class="form-group">
					<label for=""> البحث بـ رقم الملف الآلة، كود الآلة، الموديل. </label>
					<input type="text" class="form-control" id="printing_machyines_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>



				<button type="button" id="search_button" class="btn btn-primary"> بحث </button>


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
			  		    <tbody id="my-table-body">
							<div class="">
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

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$printingMachines->links()}}
					 </div>
				 </div>

		    </div>
		  </div>
	  </div>
	</div>

@endsection

@section('js_footer')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#search_button').on('click', function(){
				var keyword = $('#printing_machyines_search').val();
				var newResult = "";
				$.ajax({
					type: "GET",
					url:"printing_machines_search/"+keyword,
					dataType: "json",
					success: function(results){
						$("#my-table-body").fadeOut();
						$("#my-table-body").children().remove();
						$.each(results, function(index, machine) {
							newResult += "<tr> <td>"+(index+1)+"</td><td>"+machine.folder_number+"</td><td>"+machine.code+"</td><td>"+machine.model_prefix+"-"+machine.model_suffix+"</td> </tr>"
				        });
						$("#my-table-body").append(newResult);
						$("#my-table-body").fadeIn();
					}

				});

			});
		});
	</script>
@endsection
