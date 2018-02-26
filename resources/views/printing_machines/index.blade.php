@extends('layouts.app')

@section('title')
	 عرض الآلات التصوير
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">



				<legend> البحث عن الآلات. </legend>

				<div class="form-group">
					<label for="printing_machyines_search"> البحث بـ رقم الملف الآلة، كود الآلة، الموديل أو اسم العميل. </label>
					<input type="text" class="form-control" id="printing_machyines_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>



				<button type="button" id="printing-machine-search-button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>


				<h3 class="text-center"> عرض الآلات التصوير </h3>
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
			  				    <th> اسم العميل </th>
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
										<td>{{isset($printingMachine->customer)?$printingMachine->customer->name:''}}</td>
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
