<div class="form-group">
    <label for="number"> رقم الفاتورة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="number" name="number"  placeholder=" إدخل رقم الفاتورة. " value="{{$invoice->number or old('number')}}">
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
    <input type="text" class="form-control datepicker" id="datepicker" name="release_date"  placeholder=" اختر تاريخ الإصدار. " value="{{$invoice->release_date or old('release_date')}}">
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
    });
});
</script>
@endsection
