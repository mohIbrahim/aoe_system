<h4 class="well well-sm" role="button" data-toggle="collapse" data-target="#assigned-printing-machines"> آلات الطباعة المعينة إليكَ </h4>
<div class="collapse table-responsive" id="assigned-printing-machines">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th> رقم الملف الآلة </th>
                <th> الرقم المسلسل </th>
                <th> كود الآلة </th>
                <th> الموديل </th>
                <th> اسم العميل </th>
                <th> آخر بطاقة متابعة للآلة </th>
            </tr>
        </thead>
        <tbody id="my-table-body">
            <div class="">
                @foreach ($assignedPrintingMachines as $k => $printingMachine)
                    <tr>
                        <td>
                            {{$k+1}}
                        </td>
                        <td>
                            <a href="{{action('PrintingMachineController@show', ['id'=>$printingMachine->id])}}" target="_blank">
                                {{$printingMachine->folder_number}}
                            </a>
                        </td>
                        <td>{{$printingMachine->serial_number}}</td>
                        <td>{{$printingMachine->code}}</td>
                        <td>{{"$printingMachine->model_prefix-$printingMachine->model_suffix"}}</td>
                        <td>
                            <a href="{{action('CustomerController@show', ['id'=>(isset($printingMachine->customer)?$printingMachine->customer->id:'')])}}" target="_blank">
                                {{isset($printingMachine->customer)?$printingMachine->customer->name:''}}
                            </a>
                        </td>
                        <td>
                            @if(!empty($printingMachine->followUpCards->last()))
                                <a href="{{ action('FollowUpCardController@show', ['id'=>$printingMachine->followUpCards->last()->id]) }}" target="_blank">
                                    {{$printingMachine->followUpCards->last()->code}}
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </div>
        </tbody>
    </table>
</div>
<button class="btn btn-xs btn-default pull-left" data-toggle="collapse" data-target="#assigned-printing-machines">+/-</button>
<span class="clearfix"></span>
<hr>