@extends('layouts.app')

@section('title')
	 عرض القطع القابلة للتغير من أجزاء الماكينة
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">
				<legend> البحث عن القطع القابلة للتغير من أجزاء. </legend>
				<div class="form-group">
					<label for=""> البحث بـ الاسم وكود ونوع القطعة. </label>
					<input type="text" class="form-control" id="parts_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>
				<button type="button" id="parts-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>
				<h3 class="text-center"> عرض القطع القابلة للتغير من أجزاء الماكينة </h3>
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
			  				    <th> الكمية </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($parts as $k => $part)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('PartController@show', ['id'=>$part->id])}}" target="_blank">
                                                {{$part->name}}
                                            </a>
                                        </td>
										<td>{{$part->code}}</td>
										<td>{{$part->type}}</td>
										<td>{{($part->is_serialized == '0')?($part->no_serial_qty):($part->serialNumbersCount())}}</td>
									</tr>
								@endforeach
							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$parts->links()}}
					 </div>
				 </div>
		    </div>
		  </div>
	  </div>
	</div>
@endsection
