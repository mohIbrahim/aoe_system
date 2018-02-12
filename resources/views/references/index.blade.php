@extends('layouts.app')

@section('title')
	 عرض الإشارات
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">


				<legend> البحث عن الإشارات </legend>

				<div class="form-group">
					<label for=""> البحث بـ كود, النوع , تاريخ, الإشارة أو اسم المهندس المعيين لهذة الاشارة أو كود الآلة التصوير. </label>
					<input type="text" class="form-control" id="references_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>



				<button type="button" id="search_button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>


				<h3 class="text-center">  عرض الإشارات </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> كود الإشارة </th>
                                <th> اسم مستلم الإشارة </th>
                                <th> نوع الإشارة </th>
                                <th> اسم المهندس المعيين لهذة الاشار </th>
                                <th> تاريخ الإستلام </th>
                                <th> كود الآلة التصوير </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($references as $k => $reference)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('ReferenceController@show', ['id'=>$reference->id])}}" target="_blank">
                                                {{$reference->code}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$reference->employeeWhoReceiveTheRereference->user->name or ''}}
                                        </td>
                                        <td>
                                            {{$reference->type}}
                                        </td>
                                        <td>
                                            {{isset($reference->assignedEmployee)?(isset($reference->assignedEmployee->user)?$reference->assignedEmployee->user->name:''):''}}
                                        </td>
                                        <td>
                                            {{$reference->received_date}}
                                        </td>
                                        <td>
                                            <a href="{{action('PrintingMachineController@show', ['id'=>(isset($reference->printingMachine)?$reference->printingMachine->id:'')])}}">
                                                {{$reference->printingMachine->code or ''}}
                                            </a>
                                        </td
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$references->links()}}
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
				var keyword = $('#references_search').val();
				var newResult = "";
                if(keyword) {
                    $.ajax({
                        type: "GET",
                        url:"references_search/"+keyword,
                        dataType: "json",
                        success: function(results){
                            $("#my-table-body").fadeOut();
                            $("#my-table-body").children().remove();
                            $.each(results, function(index, reference) {
								newResult += "<tr> <td>"+(index+1)+"</td><td><a href='{{url('references')}}/"+reference.id+"'>"+reference.code+"</a></td><td>"+((reference.employee_who_receive_the_rereference)?((reference.employee_who_receive_the_rereference.user)?reference.employee_who_receive_the_rereference.user.name:''):'')+"</td><td>"+reference.type+"</td><td>"+((reference.assigned_employee)?((reference.assigned_employee.user)?reference.assigned_employee.user.name:''):'')+"</td><td>"+reference.received_date+"</td><td><a href='{{url('printing_machines')}}/"+((reference.printing_machine)?reference.printing_machine.id:'')+"'>"+((reference.printing_machine)?reference.printing_machine.code:'')+"</a></td></tr>";
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
