@extends('layouts.app')

@section('title')
	 عرض التقارير الخاصة ببطاقات المتابعة
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن التقارير الخاصة ببطاقات المتابعة </legend>
				<div class="form-group">
					<label for=""> البحث بـ رقم, التاريخ, قراءة العداد, رقم المقايسة, رقم الفاتورة. </label>
                    <p>
                        <small> البحث بالتاريخ يتم كتابة السنة ثم الشهر ثم اليوم </small>
                    </p>
                    <p>
                        <small> وإذا كان الشهر أو اليوم أقل من عشرة يوضع صفر قبل الرقم مثل هذا التنسيق 01, 02, 03 ... 09 </small>
                    </p>
					<input type="text" class="form-control" id="follow_up_card_special_reports_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="follow-up-card-special-report-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center"> عرض التقارير الخاصة ببطاقات المتابعة </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> رقم التقرير  </th>
                                <th> التاريخ  </th>
			  				    <th> قراءة العداد </th>
			  				    <th> رقم المقايسة </th>
			  				    <th> رقم الفاتورة </th>
			  				    <th> السداد </th>
			  			    </tr>
			  		    </thead>

			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($followUpCardSpecialReports as $k => $followUpCardSpecialReport)
									<tr>
										<td>
											{{$k+1}}
										</td>
                                        <td>{{$followUpCardSpecialReport->id}}</td>
										<td>
                                            <a href="{{action('FollowUpCardSpecialReportController@show', ['id'=>$followUpCardSpecialReport->id])}}" target="_blank">
                                                {{$followUpCardSpecialReport->the_date}}
                                            </a>
                                        </td>
										<td>{{$followUpCardSpecialReport->readings_of_printing_machine}}</td>
										<td>{{$followUpCardSpecialReport->indexation_number}}</td>
										<td>{{$followUpCardSpecialReport->invoice_number}}</td>
										<td>{{$followUpCardSpecialReport->the_payment}}</td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$followUpCardSpecialReports->links()}}
					 </div>
				 </div>

		    </div>
		  </div>
	  </div>
	</div>

@endsection
