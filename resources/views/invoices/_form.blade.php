<div class="form-group">
    <label for="number"> رقم الفاتورة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="number" name="number"  placeholder=" إدخل رقم الفاتورة. " value="{{$invoice->number or old('number')}}">
</div>

<div class="form-group">
    <label for="issuer">
        جهة الإصدار
        <span style="color:red">*</span>
     </label>
    <select class="form-control" name="issuer">
        <?php $invoiceIssuer = isset($invoice->issuer)? $invoice->issuer:'';?>
        <option value="">
              أختر جهة الإصدار.
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

<div class="form-group">
    <label for="finance_check_out">
         إطلاع قسم الحسابات
     </label>
    <select class="form-control" name="finance_check_out">
        <?php $invoiceFinanceCheckOut = isset($invoice->finance_check_out)? $invoice->finance_check_out:'';?>
        <option value="">
              أختر بالاطلاع أو عدم الاطلاع على هذة الفاتورة.
          </option>
        <option value="تم الاطلاع" {{($invoiceFinanceCheckOut == 'تم الاطلاع')? 'selected' : ((old('finance_check_out')=='تم الاطلاع')?'selected':'')}}>
             تم الاطلاع
        </option>

        <option value="لم يتم الاطلاع" {{($invoiceFinanceCheckOut == 'لم يتم الاطلاع')? 'selected' : ((old('finance_check_out')=='لم يتم الاطلاع')?'selected':'')}}>
             لم يتم الاطلاع
        </option>

    </select>
</div>

<div class="form-group">
    <label for="release_date"> تاريخ الإصدار <span style="color:red">*</span></label>
    <input type="text" class="form-control datepicker" id="datepicker" name="release_date"  placeholder=" أختر تاريخ الإصدار. " value="{{$invoice->release_date or old('release_date')}}">
</div>

<div class="form-group">
    <label for="descriptions"> الوصف </label>
    <textarea name="descriptions" class="form-control" placeholder=" إدخل أي تفاصيل إن وجدت. ">{{$invoice->descriptions or old('descriptions')}}</textarea>
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
@endsection
@section('js_footer')
{{-- datePicker --}}
    <script src="{{asset('js/datepicker/jquery-ui.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/datepicker/sys.js')}}" charset="utf-8"></script>
{{-- datePicker --}}
@endsection
