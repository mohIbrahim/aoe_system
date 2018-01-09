@extends('layouts.app')

@section('title')
	 عرض العملاء
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">



				<legend> البحث عن العملاء. </legend>

				<div class="form-group">
					<label for=""> البحث بـ الاسم وكود العميل. </label>
					<input type="text" class="form-control" id="customer_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>



				<button type="button" id="search_button" class="btn btn-primary"> بحث </button>


				<h3 class="text-center"> عرض العملاء </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> الاسم </th>
			  				    <th> الكود </th>
			  				    <th> النوع </th>
			  				    <th> المحافظة </th>
			  				    <th> المنطقة </th>
			  				    <th> التليفون </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($customers as $k => $customer)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('CustomerController@show', ['id'=>$customer->id])}}" target="_blank">
                                                {{$customer->name}}
                                            </a>
                                        </td>
										<td>{{$customer->code}}</td>
										<td>{{$customer->type}}</td>
										<td>{{$customer->governorate}}</td>
										<td>{{$customer->area}}</td>
										<td>{{$customer->telecoms()->first()->number}}</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$customers->links()}}
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
				var keyword = $('#customer_search').val();
				var newResult = "";
				$.ajax({
					type: "GET",
					url:"customers_search/"+keyword,
					dataType: "json",
					success: function(results){
						$("#my-table-body").fadeOut();
						$("#my-table-body").children().remove();
						$.each(results, function(index, customer) {
							newResult += "<tr> <td>"+(index+1)+"</td><td>"+customer.name+"</td><td>"+customer.code+"</td><td>"+customer.type+"</td><td>"+customer.governorate+"</td><td>"+customer.area+"</td><td>"+customer.telecoms[0].number+"</td></tr>"
				        });
						$("#my-table-body").append(newResult);
						$("#my-table-body").fadeIn();
					}

				});

			});
		});
	</script>
@endsection
