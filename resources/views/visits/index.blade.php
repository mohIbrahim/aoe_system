@extends('layouts.app')

@section('title')
	 عرض الزيارات
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">



				<legend> البحث عن الزيارات </legend>

				<div class="form-group">
					<label for=""> البحث بـ تاريخ الزيارة. </label>
                    <p>
                        <small> البحث بالتاريخ يتم كتابة السنة ثم الشهر ثم اليوم </small>
                    </p>
                    <p>
                        <small> وإذا كان الشهر أو اليوم أقل من عشرة يوضع صفر قبل الرقم مثل هذا التنسيق 01, 02, 03 ... 09 </small>
                    </p>

					<input type="text" class="form-control" id="visit_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>



				<button type="button" id="search_button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>


				<h3 class="text-center"> عرض الزيارات </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> تاريخ الزيارة </th>
			  				    <th> اسم الشخص المسؤول عن الآلة  </th>
			  				    <th> قراءة العداد </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($visits as $k => $visit)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('VisitController@show', ['id'=>$visit->id])}}" target="_blank">
                                                {{$visit->visit_date}}
                                            </a>
                                        </td>
										<td>{{$visit->representative_customer_name}}</td>
										<td>{{$visit->readings_of_printing_machine}}</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$visits->links()}}
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
				var keyword = $('#visit_search').val();
				var newResult = "";
                if(keyword) {
                    $.ajax({
                        type: "GET",
                        url:"visits_search/"+keyword,
                        dataType: "json",
                        success: function(results){
                            $("#my-table-body").fadeOut();
                            $("#my-table-body").children().remove();
                            $.each(results, function(index, visit) {
                                newResult += "<tr> <td>"+(index+1)+"</td><td><a href='{{url('visits')}}/"+visit.id+"'>"+visit.visit_date+"</a></td><td>"+visit.representative_customer_name+"</td><td>"+visit.readings_of_printing_machine+"</td></tr>"
                            });
                            $("#my-table-body").append(newResult);
                            $("#my-table-body").fadeIn();
                        }

                    });
                }
			});
		});
	</script>
@endsection