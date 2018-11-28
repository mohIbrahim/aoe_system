<h3 class="text-center"> بطاقات المتابعة </h3>
@if(in_array('create_follow_up_cards', $permissions))
    <a href="{{action('FollowUpCardController@createFromPrintingMachineShowView', ['printing_machine_id'=>$printingMachine->id, 'last_contract_id'=>$lastContractId] )}}" target="_blank"><span class="glyphicon glyphicon-plus"></span> إضافة بطاقة متابعة </a>
@endif
<hr />
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
            <tr>
                <th>#</th>
                <th> كود البطاقة </th>
                <th> رقم البطاقة الورقي </th>
                <th> اسم العميل </th>
                <th> كود العقد </th>
                <th> الرقم المسلسل لآلة الطباعة </th>
                <th> تاريخ التعديل </th>
                <th> إضافة زيارة </th>
            </tr>
        </thead>
		<tbody>

			@foreach ($printingMachine->followUpCards as $k => $followUpCard)
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
                        {{$followUpCard->old_code}}
                    </td>

                    <td>
                        {{$followUpCard->printingMachine->customer->name}}
                    </td>

                    <td>
                        <a href="{{action('ContractController@show', ['id'=>(isset($followUpCard->contract)?$followUpCard->contract->id:'')])}}"
                            target="_blank">
                            {{(isset($followUpCard->contract)?$followUpCard->contract->code:'')}}
                        </a>
                    </td>

                    <td>
                        {{$followUpCard->printingMachine->serial_number}}
                    </td>

                    <td>
                        {{$followUpCard->updated_at->format('d-m-Y')}}
                    </td>

                    <td>
                        <a href="{{action('VisitController@createWithPrintingMachineIdAndFollowUpCardId', ['printing_machine_id'=> $followUpCard->printingMachine->id,'follow_up_card_id'=>$followUpCard->id])}}" target="_blank">
                            <span class="glyphicon glyphicon-plus"></span>
								 إضافة زيارة إلى البطاقة رقم {{$followUpCard->code}} 
							</a>
                    </td>
                </tr>
            @endforeach

		</tbody>
	</table>
</div>
