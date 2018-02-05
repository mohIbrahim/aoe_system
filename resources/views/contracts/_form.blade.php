<div class="form-group">
    <label for="code"> كود العقد <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود العقد. " value="{{$contract->code or old('code')}}">
</div>

<div class="form-group">
    <label for="printing_machine_id"> كود الآلة التصوير </label>
    <select class="form-control selectpicker" name="printing_machine_id" data-live-search="true">
        <?php $selectedPrintingMachineId = isset($contract->printing_machine_id)? $contract->printing_machine_id: '' ?>
        <option value=""> اختر كود الآلة التصوير. </option>
        @foreach($printingMachineIdsNames as $printingMachineId=>$printingMachineName)
            <option value="{{$printingMachineId}}" {{($selectedPrintingMachineId == $printingMachineId)? ('selected'):((old('printing_machine_id')==$printingMachineId)?'selected':'')}} >{{$printingMachineName}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="type">
         نوع العقد
        <span style="color:red">*</span>
     </label>
    <select class="form-control" name="type">
        <?php $contracType = isset($contract->type)? $contract->type:'';?>
        <option value="">
              اختر نوع العقد.
          </option>
        <option value="ضمان" {{($contracType == 'ضمان')? 'selected' : ((old('type')=='ضمان')?'selected':'')}}>
             ضمان
        </option>
        <option value="صيانة فقط" {{($contracType == 'صيانة فقط')? 'selected' : ((old('type')=='صيانة فقط')?'selected':'')}}>
             صيانة فقط
        </option>
        <option value="صيانة شاملة قطع الغيار" {{($contracType == 'صيانة شاملة قطع الغيار')? 'selected' : ((old('type')=='صيانة شاملة قطع الغيار')?'selected':'')}}>
             صيانة شاملة قطع الغيار
        </option>
        <option value="صيانة شاملة قطع الغيار ومستلزمات التشغيل" {{($contracType == 'صيانة شاملة قطع الغيار ومستلزمات التشغيل')? 'selected' : ((old('type')=='صيانة شاملة قطع الغيار ومستلزمات التشغيل')?'selected':'')}}>
             صيانة شاملة قطع الغيار ومستلزمات التشغيل
        </option>
        <option value="إيجار" {{($contracType == 'إيجار')? 'selected' : ((old('type')=='إيجار')?'selected':'')}}>
             إيجار
        </option>
    </select>
</div>

<div class="form-group">
    <label for="start"> تاريخ بداية العقد <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="datepicker" name="start"  placeholder=" إدخل تاريخ بداية العقد. " value="{{$contract->start or old('start')}}">
</div>

<div class="form-group">
    <label for="end"> تاريخ نهاية العقد <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="datepicker2" name="end"  placeholder=" إدخل تاريخ نهاية العقد. " value="{{$contract->end or old('end')}}">
</div>

<div class="form-group">
    <label for="status">
         حالة التعاقد
        <span style="color:red">*</span>
     </label>
    <select class="form-control" name="status">
        <?php $contractStatus = isset($contract->status)? $contract->status:'';?>
        <option value="">
              اختر حالة التعاقد.
          </option>
        <option value="ساري" {{($contractStatus == 'ساري')? 'selected' : ((old('status')=='ساري')?'selected':'')}}>
             ساري
        </option>
        <option value="منتهي" {{($contractStatus == 'منتهي')? 'selected' : ((old('status')=='منتهي')?'selected':'')}}>
             منتهي
        </option>
        <option value="لاغي" {{($contractStatus == 'لاغي')? 'selected' : ((old('status')=='لاغي')?'selected':'')}}>
             لاغي
        </option>
    </select>
</div>

<div class="form-group">
    <label for="price"> السعر عند التعاقد "بدون الضريبة" <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="price" name="price"  placeholder=" إدخل السعر عند التعاقد. " value="{{$contract->price or old('price')}}">
</div>

<div class="form-group">
    <label for="tax"> قيمة الضريبة "النسبة المئوية" <span style="color:red">*</span></label>
    <P>
        <small>
            إدخل رقم صحيح بدون العلامة المئوية.
        </small>
    </P>
    <input type="text" class="form-control" id="tax" name="tax"  placeholder=" إدخل قيمة الضريبة. " value="{{$contract->tax or old('tax')}}">
</div>

<div class="form-group">
    <label for="total_price"> السعر الكلي للتعاقد شامل الضريبة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="total_price" name="total_price"  placeholder=" إدخل السعر الكلي شامل الضريبة. " value="{{$contract->total_price or old('total_price')}}">
</div>

<div class="form-group">
    <label for="payment_system">
         نظام السداد
        <span style="color:red">*</span>
     </label>
    <select class="form-control" name="payment_system">
        <?php $contractStatus = isset($contract->payment_system)? $contract->payment_system:'';?>
        <option value="">
              اختر نظام السداد.
          </option>
        <option value="مقدم" {{($contractStatus == 'مقدم')? 'selected' : ((old('payment_system')=='مقدم')?'selected':'')}}>
             مقدم
        </option>

        <option value="ربع سنوي" {{($contractStatus == 'ربع سنوي')? 'selected' : ((old('payment_system')=='ربع سنوي')?'selected':'')}}>
             ربع سنوي
        </option>

        <option value="نصف سنوي" {{($contractStatus == 'نصف سنوي')? 'selected' : ((old('payment_system')=='نصف سنوي')?'selected':'')}}>
             نصف سنوي
        </option>

        <option value="نهاية المدة" {{($contractStatus == 'نهاية المدة')? 'selected' : ((old('payment_system')=='نهاية المدة')?'selected':'')}}>
             نهاية المدة
        </option>

    </select>
</div>

<div class="form-group">
    <label for="contract_as_pdf"> صورة العقد بأمتداد PDF </label>
    <input type="file" class="form-control" id="contract_as_pdf" name="contract_as_pdf">
        @if (isset($contract->softCopies) && $contract->softCopies->isNotEmpty())
            <div class="breadcrumb">
                <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small> حذف ملف العقد </small>
                <a role="button" href="{{action('ContractController@removeContractFile', ['id'=>$contract->softCopies->first()->id])}}" class="btn btn-danger btn-xs">
                    Delete
                </a>

            </div>
        @endif
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$contract->comments or old('comments')}}</textarea>
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
@endsection
