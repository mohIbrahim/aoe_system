<h4  class="well well-sm" role="button" data-toggle="collapse" data-target="#assigned-references">آخر الإشارات المعينة إليكَ</h4>
<div class="collapse table-responsive" id="assigned-references">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>رقم الإشارة</th>
                <th>نوع الإشارة</th>
                <th>حالة الإشارة</th>
                <th>اسم العميل</th>
                <th>المنطقة</th>
                <th>تاريخ الإشارة</th>
                <th>كود الآلة</th>
                <th>إنشاء زيارة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lastAssignedReferences as $referenceKey => $reference)
                <tr>
                    <td>
                        <a href="{{action('ReferenceController@show', ['id'=>$reference->id])}}">
                            {{ $reference->code }}
                        </a>
                    </td>
                    <td>{{ $reference->type }}</td>
                    <td>{{ $reference->status }}</td>
                    <td>
                        <a href="{{action('CustomerController@show', ['id'=>(($reference->printingMachine)?(($reference->printingMachine->customer)?($reference->printingMachine->customer->id):('')):(''))])}}">
                            {{ ($reference->printingMachine)?(($reference->printingMachine->customer)?($reference->printingMachine->customer->name):('')):('') }}
                        </a>
                    </td>
                    <td>{{ ($reference->printingMachine)?(($reference->printingMachine->customer)?($reference->printingMachine->customer->area):('')):('') }}</td>
                    <td>{{ $reference->received_date }}</td>
                    <td>
                        <a href="{{ action('PrintingMachineController@show', ['id'=>(($reference->printingMachine)?(($reference->printingMachine->id)?($reference->printingMachine->id):('')):(''))]) }}">
                            {{ ($reference->printingMachine)?(($reference->printingMachine->code)?($reference->printingMachine->code):('')):('') }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ action('VisitController@createWithPrintingMachineId', ['pm_id'=>(($reference->printingMachine)?(($reference->printingMachine->id)?($reference->printingMachine->id):('')):(''))]) }}">
                            إنشاء زيارة جديدة
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<button class="btn btn-xs btn-default pull-left" data-toggle="collapse" data-target="#assigned-references">+/-</button>
<span class="clearfix"></span>
<hr>