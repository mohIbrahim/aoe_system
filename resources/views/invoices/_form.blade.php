<div class="form-group">
    <label for="number"> رقم الفاتورة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="number" name="number"  placeholder=" إدخل رقم الفاتورة. " value="{{$invoice->number or old('number')}}">
</div>

<div class="form-group">
    <label for="customer_id"> كود العميل <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="customer_id" data-live-search="true" id="customer_id">
        <?php $selectedCustomerId = isset($invoice->customer_id)? $invoice->customer_id:'' ;?>
        <option value=" "> اختر كود العميل الذي قمت بإجراء هذة الفاتورة له.  </option>
        @foreach ($customersIdsCodes as $customerId => $customerName)
            <option value="{{$customerId}}" {!!($selectedCustomerId == $customerId)? 'selected="selected"' : ((old('customer_id')==$customerId)?'selected="selected"':'')!!}> {{$customerName}} </option>
        @endforeach
    </select>
</div>

<div class="breadcrumb  panel panel-primary">
    <div class="form-group">
        <label for="type">
            نوع الفاتورة
            <span style="color:red">*</span>
        </label>
        <select class="form-control" name="type" id="type">
            <?php $selectedType = isset($invoice->type)? $invoice->type:'';?>
            <option value="">
                اختر نوع الفاتورة.
            </option>
            <option value="تعاقد" {{($selectedType == 'تعاقد')? 'selected="selected"' : ((old('type')=='تعاقد')?'selected':'')}}>
                تعاقد
            </option>
            <option value="مقايسة" {{($selectedType == 'مقايسة')? 'selected="selected"' : ((old('type')=='مقايسة')?'selected':'')}}>
                مقايسة
            </option>
            <option value="بيع قطع" {{($selectedType == 'بيع قطع')? 'selected="selected"' : ((old('type')=='بيع قطع')?'selected':'')}}>
                بـيع قطع الآلة
            </option>
        </select>
    </div>

    <div class="form-group" id="group-contract" style="display:none;">
        <label for="contract_id"> كود العقد <span style="color:red">*</span></label>
        <select class="form-control selectpicker" name="contract_id" data-live-search="true" id="contract-id">
            <?php $selectedContractId = isset($invoice->contract_id)? $invoice->contract_id:'' ;?>
            <option value=" "> اختر كود العقد الذي قمت بسببه بإجراء هذة الفاتورة.  </option>
            @foreach ($contractsIdsCodes as $contractId => $contractCode)
                <option value="{{$contractId}}" {!!($selectedContractId == $contractId)? 'selected="selected"' : ((old('contract_id')==$contractId)?'selected="selected"':'')!!}> {{$contractCode}} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group" id="group-indexation" style="display:none">
        <label for="indexation_id"> كود المقايسة <span style="color:red">*</span></label>
        <select class="form-control selectpicker" name="indexation_id" data-live-search="true" id="indexation-id">
            <?php $selectedIndexations = isset($invoice->indexation_id)? $invoice->indexation_id:'' ;?>
            <option value=""> اختر كود المقايسة التي قمت بسببها بإجراء هذة الفاتورة.  </option>
            @foreach ($indexationsCodes as $indexationId => $indexationCode)
                <option value="{{$indexationId}}" {!!($selectedIndexations == $indexationId)? 'selected="selected"' : ((old('indexation_id')==$indexationId)?'selected="selected"':'')!!}> {{$indexationCode}} </option>
            @endforeach
        </select>
    </div>

    <div class="panel panel-info" id="invoice-form-parts-form-wrapper" style="display:none">
        <div class="panel-body">            
            <h3> إضافة قطع الآلة للفاتورة </h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4> البحث عن القطع </h4>
                    <hr>
                    <div class="form-group form-inline">
                        <label for=""> ادخل اسم القطعة </label>
                        <input type="text" class="form-control" id="invoice-form-search-input" placeholder="">
                        <button type="button" class="btn btn-primary" id="invoice-form-search-button"> بحث </button>
                    </div>
    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <div id="invoice-form-message-span" style="color:#a5a5a5"></div>
                                <tr>
                                    <th> اسم القطعة </th>
                                    <th> اضافة </th>
                                </tr>
                            </thead>
                            <tbody id="invoice-form-results-table-body">
    
                            </tbody>
                        </table>
                    </div>
    
                </div>
            </div>
    
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3> القطع المختارة </h3>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th> اسم القطعة </th>
                                    <th> الرقم المسلسل للقطعة </th>
                                    <th> العدد </th>
                                    <th> السعر القطعة </th>
                                    <th> نسبة الخصم على القطعة الواحدة </th>
                                    <th> حذف </th>
                                </tr>
                            </thead>
                            <tbody id="invoice-form-selected-parts-table-body">
                                @if(old('parts_ids'))
                                    @for ($i = 0; $i < count(old('parts_ids')); $i++)
    
                                        <tr>
                                            <td>
                                                {{old('parts_names')[$i]}}
                                                <input type='hidden' name='parts_names[]' value='{{old('parts_names')[$i]}}'>
                                            </td>
                                            <td>
                                                <div class='input-group'>
                                                    <input type='text' class='form-control' placeholder=' ادخل الرقم المسلسل للقطعة ' name='parts_serial_numbers[]' value="{{old('parts_serial_numbers')[$i]}}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class='input-group'>
                                                    <input type='text' class='form-control' placeholder=' ادخل عدد القطع ' name='parts_count[]' value="{{old('parts_count')[$i]}}">
                                                    <input type='hidden' class='form-control' name='parts_ids[]' value="{{old('parts_ids')[$i]}}">
                                                </div>
                                            </td>
                                            <td>
                                                <input type='text' class='form-control' name='parts_prices[]' readonly value="{{old('parts_prices')[$i]}}">
                                            </td>
                                            <td>
                                                <input type='text' class='form-control' name='discount_rate[]' value="{{old('discount_rate')[$i]}}" placeholder='إدخل نسبة الخصم إن وجدت'>
                                            </td>
                                            <td>
                                                <button type='button' class='btn btn-danger btn-xs invoice-form-delete-part-button'> حذف </button>
                                            </td>
                                        </tr>
                                    @endfor
                                @elseif(isset($parts))
                                    @foreach ($parts as $i => $part)
    
                                        <tr>
                                            <td>
                                                {{$part->name}}
                                                <input type='hidden' name='parts_names[]' value='{{$part->name}}'>
                                            </td>
                                            <td>
                                                <div class='input-group'>
                                                    <input type='text' class='form-control' placeholder=' ادخل الرقم المسلسل للقطعة ' name='parts_serial_numbers[]' value="{{$part->pivot->part_serial_number or ''}}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class='input-group'>
                                                    <input type='text' class='form-control' placeholder=' ادخل عدد القطع ' name='parts_count[]' value="{{$part->pivot->number_of_parts or 1}}">
                                                    <input type='hidden' class='form-control' name='parts_ids[]' value="{{$part->id or ''}}">
                                                </div>
                                            </td>
                                            <td>
                                                <input type='text' class='form-control' name='parts_prices[]' readonly value="{{$part->pivot->price or ''}}">
                                            </td>
                                            <td>
                                                <input type='text' class='form-control' name='discount_rate[]' value="{{$part->pivot->discount_rate or ''}}" placeholder='إدخل نسبة الخصم إن وجدت'>
                                            </td>
                                            <td>
                                                <button type='button' class='btn btn-danger btn-xs invoice-form-delete-part-button'> حذف </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
    
                </div>
            </div>
    
            <div class="form-group">
                <label for="printing_machines_serial"> الأرقام التسلسلية لآلات التصوير. </label>
                <textarea name="printing_machines_serial" class="form-control" placeholder=" إدخل الأرقام التسلسلية لآلات التصوير. ">{{(old('printing_machines_serial'))?(old('printing_machines_serial')):(isset($parts)?(($parts->first())?(($parts->first()->pivot)?($parts->first()->pivot->printing_machines_serial):('')):('')):(''))}}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="issuer">
        جهة الإصدار
        <span style="color:red">*</span>
     </label>
    <select class="form-control" name="issuer">
        <?php $invoiceIssuer = isset($invoice->issuer)? $invoice->issuer:'';?>
        <option value="">
              اختر جهة الإصدار.
          </option>
        <option value="الأقسام الفنية" {{($invoiceIssuer == 'الأقسام الفنية')? 'selected' : ((old('issuer')=='الأقسام الفنية')?'selected':'')}}>
             الأقسام الفنية
        </option>
    </select>
</div>

<div class="form-group">
    <label for="order_number"> أمر توريد رقم </label>
    <input type="text" class="form-control" id="order_number" name="order_number"  placeholder=" إدخل رقم أمر التوريد. " value="{{$invoice->order_number or old('order_number')}}">
</div>

<div class="form-group">
    <label for="delivery_permission_number"> إذن تسليم رقم </label>
    <input type="text" class="form-control" id="delivery_permission_number" name="delivery_permission_number"  placeholder=" إدخل رقم إذن التسليم. " value="{{$invoice->delivery_permission_number or old('delivery_permission_number')}}">
</div>
@if (in_array('finance', $permissions))
    <div class="form-group">
        <label for="finance_check_out">
            إطلاع قسم الحسابات
        </label>
        <select class="form-control" name="finance_check_out">
            <?php $invoiceFinanceCheckOut = isset($invoice->finance_check_out)? $invoice->finance_check_out:'';?>
            <option value="">
                اختر بالاطلاع أو عدم الاطلاع على هذة الفاتورة.
            </option>
            <option value="تم الاطلاع" {{($invoiceFinanceCheckOut == 'تم الاطلاع')? 'selected' : ((old('finance_check_out')=='تم الاطلاع')?'selected':'')}}>
                تم الاطلاع
            </option>
            <option value="لم يتم الاطلاع" {{($invoiceFinanceCheckOut == 'لم يتم الاطلاع')? 'selected' : ((old('finance_check_out')=='لم يتم الاطلاع')?'selected':'')}}>
                لم يتم الاطلاع
            </option>
        </select>
    </div>
@endif

<div class="form-group">
    <label for="release_date"> تاريخ الإصدار <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="datepicker" name="release_date"  placeholder=" اختر تاريخ الإصدار. " value="{{$invoice->release_date or old('release_date')}}">
</div>

<div class="form-group" >
    <label for="collector_employee_name"> اسم الموظف الذي قام بالتحصيل </label>
    <select class="form-control selectpicker" name="collector_employee_name" data-live-search="true" id="collector-employee-name">
        <?php $selectecCollectorName = isset($invoice->collector_employee_name)? $invoice->collector_employee_name:'' ;?>
        <option value=" "> اختراسم الموظف الذي قام بالتحصيل.  </option>
        @foreach ($employeesNames as $employeeIterator => $employeeName)
            <option value="{{$employeeName}}" {!!($selectecCollectorName == $employeeName)? 'selected="selected"' : ((old('contract_id')==$employeeName)?'selected="selected"':'')!!}> {{$employeeName}} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="collect_date"> تاريخ التحصيل </label>
    <input type="text" class="form-control" id="datepicker2" name="collect_date"  placeholder=" اختر تاريخ التحصيل. " value="{{$invoice->collect_date or old('collect_date')}}">
</div>


<div class="form-group">
    <label for="descriptions"> الوصف </label>
    <textarea name="descriptions" class="form-control" placeholder=" إدخل أي تفاصيل إن وجدت. ">{{$invoice->descriptions or old('descriptions')}}</textarea>
</div>

<div class="form-group">
    <label for="invoice_as_pdf"> صورة الفاتورة بأمتداد PDF </label>
    <input type="file" class="form-control" id="invoice_as_pdf" name="invoice_as_pdf">
    @if (isset($invoice->softCopies) && $invoice->softCopies->isNotEmpty())
        <div class="breadcrumb">
            <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small> حذف ملف الفاتورة </small>
            <a role="button" href="{{action('ContractController@removeContractFile', ['id'=>$invoice->softCopies->first()->id])}}" class="btn btn-danger btn-xs">
                Delete
            </a>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="total"> إجمالي الفاتورة بعد الضريبة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="total" name="total"  placeholder=" إدخل إجمالي قيمة الفاتورة. " value="{{$invoice->total or old('total')}}">
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$invoice->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
@section('head')
{{-- datePicker --}}
    <link rel="stylesheet" href="{{asset('css/datepicker/jquery-ui.min.css')}}">
{{-- datePicker --}}
{{-- bootstrap-select --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap-select/bootstrap-select.min.css')}}">
{{-- bootstrap-select --}}
@endsection
@section('js_footer')
{{-- datePicker --}}
    <script src="{{asset('js/datepicker/jquery-ui.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/datepicker/sys.js')}}" charset="utf-8"></script>
{{-- datePicker --}}
{{-- bootstrap-select --}}
    <script src="{{asset('js/bootstrap-select/bootstrap-select.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/bootstrap-select/sys.js')}}" charset="utf-8"></script>
{{-- bootstrap-select --}}
<script type="text/javascript">
$(function(){
    if ($('#type').val() == 'تعاقد') {
        $('#group-contract').css('display', 'block');
    }
    if ($('#type').val() == 'مقايسة') {
        $('#group-indexation').css('display', 'block');
    }
    if ($('#type').val() == 'بيع قطع') {
        $('#invoice-form-parts-form-wrapper').css('display', 'block');
    }
    $('#type').on('change', function(){
        if (this.value == 'تعاقد') {
            $('#group-contract').css('display', 'block');
            $("#indexation-id option:selected").removeAttr("selected");
        } else {
            $('#group-contract').css('display', 'none');
        }

        if (this.value == 'مقايسة') {
            $('#group-indexation').css('display', 'block');
            $("#contract-id option:selected").removeAttr("selected");
        } else {
            $('#group-indexation').css('display', 'none');
        }

        if (this.value == 'بيع قطع') {
            $('#invoice-form-parts-form-wrapper').css('display', 'block');
            $("#contract-id option:selected").removeAttr("selected");
        } else {
            $('#invoice-form-parts-form-wrapper').css('display', 'none');
            $('#invoice-form-selected-parts-table-body').empty();
        }
    });
});
</script>
@endsection
