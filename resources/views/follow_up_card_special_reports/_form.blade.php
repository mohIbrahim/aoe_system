<div class="form-group">
    <label for="the_date"> التاريخ <span style="color:red">*</span></label>
    <input type="text" class="form-control datepicker" id="datepicker" name="the_date"  placeholder=" اختر التاريخ. " value="{{$followUpCardSpecialReport->the_date or old('the_date')}}">
</div>

<div class="form-group">
    <label for="readings_of_printing_machine"> قراءة العداد </label>
    <input type="text" class="form-control" id="readings_of_printing_machine" name="readings_of_printing_machine"  placeholder=" إدخل قراءة العداد. " value="{{$followUpCardSpecialReport->readings_of_printing_machine or old('readings_of_printing_machine')}}">
</div>

<div class="form-group">
    <label for="indexation_number"> رقم المقايسة </label>
    <input type="text" class="form-control" id="indexation_number" name="indexation_number"  placeholder=" إدخل رقم المقايسة. " value="{{$followUpCardSpecialReport->indexation_number or old('indexation_number')}}">
</div>

<div class="form-group">
    <label for="invoice_number"> رقم الفاتورة </label>
    <input type="text" class="form-control" id="invoice_number" name="invoice_number"  placeholder=" إدخل رقم الفاتورة. " value="{{$followUpCardSpecialReport->invoice_number or old('invoice_number')}}">
</div>

<div class="form-group">
    <label for="the_payment"> السداد </label>
    <input type="text" class="form-control" id="the_payment" name="the_payment"  placeholder=" إدخل السداد. " value="{{$followUpCardSpecialReport->the_payment or old('the_payment')}}">
</div>

<div class="form-group">
    <label for="report"> التقرير <span style="color:red">*</span></label>
    <textarea name="report" class="form-control" placeholder=" إدخل التقرير. ">{{$followUpCardSpecialReport->report or old('report')}}</textarea>
</div>

<div class="form-group">
    <label for="auditor_name"> اسم المراجع </label>
    <input type="text" class="form-control" id="auditor_name" name="auditor_name"  placeholder=" إدخل اسم المراجع. " value="{{$followUpCardSpecialReport->auditor_name or old('auditor_name')}}">
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$followUpCardSpecialReport->comments or old('comments')}}</textarea>
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
