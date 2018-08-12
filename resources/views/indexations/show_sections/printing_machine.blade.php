<tr>
    <td colspan="2">
        <table class="table table-hover">
            <h3 class="text-center"> بيانات الآلة </h3>
            <thead>
                <tr>
                    <th> الرقم المسلسل </th>
                    <th> موديل </th>
                    <th> كود الآلة </th>
                    <th> اسم العميل </th>
                    <th> الادارة </th>
                </tr>
            </thead>
            <tbody>
                @if($indexation->type == 'تليفونية')

                    <tr>
                        <td>
                            <a href="{{action('PrintingMachineController@show', ['id'=>$indexation->printingMachine->id])}}" target="_blank">
								{{$indexation->printingMachine->serial_number}}
							</a>
                        </td>
                        <td>
                            {{(isset($indexation)?(isset($indexation->printingMachine)?$indexation->printingMachine->model_prefix:''):'')}} -
                            {{(isset($indexation)?(isset($indexation->printingMachine)?$indexation->printingMachine->model_suffix:''):'')}}
                        </td>
                        <td>
                            {{(isset($indexation)?(isset($indexation->printingMachine)?$indexation->printingMachine->code:''):'')}}
                        </td>
                        <td>
                            @if(isset($indexation) &&
                                isset($indexation->printingMachine) &&
                                isset($indexation->printingMachine->customer))
                                <a href="{{ action('CustomerController@show', ['id'=>$indexation->printingMachine->customer->id]) }}" target="">
                                    {{$indexation->printingMachine->customer->name}}
                                </a>
                            @endif
                        </td>
                        <td>
                            {{(isset($indexation)?(isset($indexation->printingMachine)?(isset($indexation->printingMachine->customer)?$indexation->printingMachine->customer->administration:''):''):'')}}
                        </td>
                    </tr>

                @elseif ($indexation->type == 'زيارة')
                    <tr>
                        <td>
                            {{(isset($indexation->visit)?(isset($indexation->visit->printingMachine)?$indexation->visit->printingMachine->model_prefix:''):'')}} -
                            {{(isset($indexation->visit)?(isset($indexation->visit->printingMachine)?$indexation->visit->printingMachine->model_suffix:''):'')}}
                        </td>
                        <td>
                            {{(isset($indexation->visit)?(isset($indexation->visit->printingMachine)?$indexation->visit->printingMachine->code:''):'')}}
                        </td>
                        <td>
                            <a href="{{action('PrintingMachineController@show', ['id'=>$indexation->visit->printingMachine->id])}}" target="_blank">
                                {{$indexation->visit->printingMachine->serial_number}}
                            </a>
                        </td>
                        <td>
                            @if(isset($indexation) &&
                                isset($indexation->visit) &&
                                isset($indexation->visit->printingMachine) &&
                                isset($indexation->visit->printingMachine->customer))
                                <a href="{{ action('CustomerController@show', ['id'=>$indexation->visit->printingMachine->customer->id]) }}" target="">
                                    {{$indexation->visit->printingMachine->customer->name}}
                                </a>
                            @endif
                        </td>
                        <td>
                            {{(isset($indexation->visit)?(isset($indexation->visit->printingMachine)?(isset($indexation->visit->printingMachine->customer)?$indexation->visit->printingMachine->customer->administration:''):''):'')}}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </td>
</tr>