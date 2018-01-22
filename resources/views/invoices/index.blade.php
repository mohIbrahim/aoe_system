@extends('layouts.app')

@section('title')
	 عرض الفواتير
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">



				<legend> البحث عن الفواتير </legend>

				<div class="form-group">
					<label for=""> البحث ب رقم وإطلاع قسم الحسابات على الفاتورة. </label>
					<input type="text" class="form-control" id="invoice_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>



				<button type="button" id="search_button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>


				<h3 class="text-center"> عرض الفواتير </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> رقم الفاتورة </th>
                                <th> جهة الإصدار </th>
			  				    <th> أمر توريد رقم</th>
			  				    <th> إذن تسليم رقم العقد </th>
			  				    <th> إطلاع قسم الحسابات </th>
			  				    <th> تاريخ الإصدار </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($invoices as $k => $invoice)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('InvoiceController@show', ['id'=>$invoice->id])}}" target="_blank">
                                                {{$invoice->number}}
                                            </a>
                                        </td>
                                        <td>{{$invoice->issuer}}</td>
										<td>{{$invoice->order_number}}</td>
										<td>{{$invoice->delivery_permission_number}}</td>
										<td>{{$invoice->finance_check_out}}</td>
										<td>{{$invoice->release_date}}</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$invoices->links()}}
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
				var keyword = $('#invoice_search').val();
				var newResult = "";
                if(keyword) {
                    $.ajax({
                        type: "GET",
                        url:"invoices_search/"+keyword,
                        dataType: "json",
                        success: function(results){
                            $("#my-table-body").fadeOut();
                            $("#my-table-body").children().remove();
                            $.each(results, function(index, invoice) {
                                newResult += "<tr><td>"+(index+1)+"</td><td><a href='{{url('invoices')}}/"+invoice.id+"'>"+invoice.number+"</a></td><td>"+invoice.issuer+"</td><td>"+invoice.order_number+"</td><td>"+invoice.delivery_permission_number+"</td><td>"+invoice.finance_check_out+"</td><td>"+invoice.release_date+"</td></tr>"
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
