@extends('layouts.app')

@section('title')
	 عرض بطاقات المتابعة
@endsection

@section('content')

	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">
		    <div class="panel-heading ">


				<legend> البحث عن بطاقة متابعة </legend>

				<div class="form-group">
					<label for=""> البحث ب كود البطاقة وكود العقد. </label>
					<input type="text" class="form-control" id="follow_up_cards_search" placeholder=" إدخل الكلمة المراد البحث عنها. ">
				</div>



				<button type="button" id="search_button" class="btn btn-primary"> بحث </button>
				<a href=""  class="btn btn-success"> العودة </a>


				<h3 class="text-center"> عرض بطاقات المتابعة </h3>
		    </div>
		    <div class="panel-body">

		  		<div class="table-responsive">
			  	    <table class="table table-hover">
			  		    <thead>
			  			    <tr>
								<th>#</th>
                                <th> كود البطاقة </th>
                                <th> كود العقد </th>
			  			    </tr>
			  		    </thead>
			  		    <tbody id="my-table-body">
							<div class="">
								@foreach ($followUpCards as $k => $followUpCard)
									<tr>
										<td>
											{{$k+1}}
										</td>
										<td>
                                            <a href="{{action('FollowUpCardController@show', ['id'=>$followUpCard->id])}}" target="_blank">
                                                {{$followUpCard->code}}
                                            </a>
                                        </td>

										<td>
                                            <a href="{{action('ContractController@show', ['id'=>(isset($followUpCard->contract)?$followUpCard->contract->id:'')])}}" target="_blank">
                                                {{(isset($followUpCard->contract)?$followUpCard->contract->code:'')}}
                                            </a>
                                        </td>
									</tr>
								@endforeach

							</div>
			  		    </tbody>
			  	     </table>
					 <div class="text-center">
						 {{$followUpCards->links()}}
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
				var keyword = $('#follow_up_cards_search').val();
				var newResult = "";
                if(keyword) {
                    $.ajax({
                        type: "GET",
                        url:"follow_up_cards_search/"+keyword,
                        dataType: "json",
                        success: function(results){
                            $("#my-table-body").fadeOut();
                            $("#my-table-body").children().remove();
                            $.each(results, function(index, follow_up_cards) {
								if(follow_up_cards.contract){
									newResult += "<tr> <td>"+(index+1)+"</td><td><a href='{{url('follow_up_cards')}}/"+follow_up_cards.id+"'>"+follow_up_cards.code+"</a></td><td><a href='{{url('contracts')}}/"+follow_up_cards.contract.id+"'>"+follow_up_cards.contract.code+"</a></td></tr>"
								}else{
									newResult += "<tr> <td>"+(index+1)+"</td><td><a href='{{url('follow_up_cards')}}/"+follow_up_cards.id+"'>"+follow_up_cards.code+"</a></td></tr>"
								}

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
