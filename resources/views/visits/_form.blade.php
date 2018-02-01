<div class="jumbotron">
    <div class="form-group">
            <label for="type">
                نوع الزيارة
                <span style="color:red">*</span>
            </label>
        <select class="form-control" name="type">
            <?php $visitType = isset($visit->type)? $visit->type:'';?>
            <option value="">
                اختر نوع الزيارة
            </option>
            <option value="إشارة" {{($visitType == 'إشارة')? 'selected' : ((old('type')=='إشارة')?'selected':'')}}>
                إشارة
            </option>

            <option value="كارت المتابعة" {{($visitType == 'كارت المتابعة')? 'selected' : ((old('type')=='كارت المتابعة')?'selected':'')}}>
                كارت المتابعة
            </option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="printing_machine_id"> كود الآلة التصوير <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="printing_machine_id" data-live-search="true">
        <?php $selectedPrintingMachineId = isset($visit->printing_machine_id)? $visit->printing_machine_id:'' ;?>
        <option value=""> اختر كود العميل.  </option>
        @foreach ($printingMachineIdsCodes as $id => $code)
            <option value="{{$id}}" {{($selectedPrintingMachineId == $id)? 'selected' : ((old('printing_machine_id')==$id)?'selected':'')}}> {{$code}} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="visit_date"> تاريخ الزيارة <span style="color:red">*</span></label>
    <input type="text" class="form-control datepicker" id="datepicker" name="visit_date"  placeholder=" اختر تاريخ الإصدار. " value="{{$visit->visit_date or old('visit_date')}}">
</div>

<div class="form-group">
    <label for="readings_of_printing_machine"> قراءة العداد </label>
    <input type="text" class="form-control" id="readings_of_printing_machine" name="readings_of_printing_machine"  placeholder=" إدخل قراءة العداد. " value="{{$visit->readings_of_printing_machine or old('readings_of_printing_machine')}}">
</div>

<div class="form-group">
    <label for="representative_customer_name"> اسم الشخص المسؤول عن الآلة </label>
    <input type="text" class="form-control" id="representative_customer_name" name="representative_customer_name"  placeholder=" إدخل اسم الشخص المسؤول عن الآلة . " value="{{$visit->representative_customer_name or old('representative_customer_name')}}">
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{ $visit->comments or old('comments') }}</textarea>
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
