<h4 class="well well-sm" role="button" data-toggle="collapse" data-target="#invoices"> الفواتير التي في مسؤوليتك.</h4>
<div class="collapse table-responsive" id="invoices">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th> رقم الفاتورة </th>
                <th> اسم العميل </th>
                <th> نوع الفاتورة </th>
                <th> جهة الإصدار </th>
                <th> أمر توريد رقم</th>
                <th> إذن تسليم رقم العقد </th>
                <th> إطلاع قسم الحسابات </th>
                <th> إجمالي القيمة </th>
                <th> اسماء الموظفين المسؤولين عن الفاتورة </th>
                <th> تاريخ الإصدار </th>
                <th> تاريخ التحصيل </th>
            </tr>
        </thead>
        <tbody id="my-table-body">
            <div class="">
                @foreach ($invoices as $k => $invoice)
                    <tr>
                        <td>
                            {{$k+1}}
                        </td>
                        <td>
                            <a href="{{action('InvoiceController@show', ['id'=>$invoice->id])}}" target="_blank">
                                {{$invoice->number or 'لم يتم تعين الرقم حتى الآن'}}
                            </a>
                        </td>
                        <td>{{$invoice->customer->name or ''}}</td>
                        <td>{{$invoice->type}}</td>
                        <td>{{$invoice->issuer}}</td>
                        <td>{{$invoice->order_number}}</td>
                        <td>{{$invoice->delivery_permission_number}}</td>
                        <td>{{$invoice->finance_check_out}}</td>
                        <td>{{(isset($invoice->total))?($invoice->total.' جنية'):('0جنية')}} </td>
                        <td>{{($invoice->employeesNamesThatAreResponsibleOnThisInvoice)}}</td>
                        <td>{{$invoice->release_date}}</td>
                        <td>{{$invoice->collect_date}}</td>
                    </tr>
                @endforeach

            </div>
        </tbody>
    </table>
</div>
<button class="btn btn-xs btn-default pull-left" data-toggle="collapse" data-target="#invoices">+/-</button>
<span class="clearfix"></span>
<hr>