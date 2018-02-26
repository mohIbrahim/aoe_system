@extends('layouts.app')

@section('title')
	 عرض المقايسات
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن المقايسات </legend>
				<div class="form-group">
					<label for=""> البحث بـ كود, التاريخ, موافقة العميل, موافقة مدير الأقسام الفنية, موافقة المخازن للمقايسة أو كود الإشارة. </label>
                    <p>
                        <small> البحث بالتاريخ يتم كتابة السنة ثم الشهر ثم اليوم </small>
                    </p>
                    <p>
                        <small> وإذا كان الشهر أو اليوم أقل من عشرة يوضع صفر قبل الرقم مثل هذا التنسيق 01, 02, 03 ... 09 </small>
                    </p>
					<input type="text" class="form-control" id="indexations_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="indexatoin-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center">  عرض المقايسات</h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> كود المقايسة </th>
                                <th>  التاريخ  </th>
                                <th> موافقة العميل </th>
                                <th> موافقة مدير الأقسام الفنية </th>
                                <th> موافقة المخازن </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($indexations as $k => $indexation)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('IndexationController@show', ['id'=>$indexation->id])}}" target="_blank">
                                                {{$indexation->code}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$indexation->the_date}}
                                        </td>
                                        <td>
                                            {{$indexation->customer_approval}}
                                        </td>
                                        <td>
                                            {{$indexation->technical_manager_approval}}
                                        </td>
                                        <td>
                                            {{$indexation->warehouse_approval}}
                                        </td>
                                        <td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$indexations->links()}}
					 </div>
				 </div>

		    </div>
		  </div>
	  </div>
	</div>

@endsection
