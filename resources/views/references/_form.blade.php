<div class="form-group">
    <label for="code"> كود الإشارة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود الإشارة. " value="{{$reference->code or old('code')}}">
</div>

<div class="form-group">
    <label for="employee_id_who_receive_the_reference"> اسم مستلم الإشارة <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="employee_id_who_receive_the_reference" data-live-search="true">
        <?php $selectedEmployee = isset($reference->employee_id_who_receive_the_reference)? $reference->employee_id_who_receive_the_reference: '' ?>
        <option value=""> اختر اسم مستلم الإشارة. </option>
        @foreach($employeesNames as $employeeId=>$employeeName)
            <option value="{{$employeeId}}" {{($selectedEmployee == $employeeId)? ('selected'):((old('employee_id_who_receive_the_reference')==$employeeId)?'selected':'')}} >{{$employeeName}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="notebook_number"> كود الدفــتر </label>
    <input type="text" class="form-control" id="notebook_number" name="notebook_number"  placeholder=" إدخل كود دفتر  الإشارة. " value="{{$reference->notebook_number or old('notebook_number')}}">
</div>

<div class="form-group">
    <label for="type"> نوع الإشارة <span style="color:red">*</span></label>
    <select class="form-control" name="type">
        <?php $referenceType = isset($reference->type)? $reference->type:'' ;?>
        <option value="">  اختر نوع الإشارة.  </option>
        <option value="تركيب" {{($referenceType == 'تركيب')? 'selected' : ((old('type')=='تركيب')?'selected':'')}}> تركيب </option>
        <option value="ضمان" {{($referenceType == 'ضمان')? 'selected' : ((old('type')=='ضمان')?'selected':'')}}> ضمان </option>
        <option value="صيانة" {{($referenceType == 'صيانة')? 'selected' : ((old('type')=='صيانة')?'selected':'')}}> صيانة </option>
        <option value="زيارة" {{($referenceType == 'زيارة')? 'selected' : ((old('type')=='زيارة')?'selected':'')}}> زيارة </option>
        <option value="تقرير" {{($referenceType == 'تقرير')? 'selected' : ((old('type')=='تقرير')?'selected':'')}}> تقرير </option>
    </select>
</div>

<div class="form-group">
    <label for="received_date"> تاريخ الإستلام  <span style="color:red">*</span></label>
    <input type="text" class="form-control datepicker" id="datepicker" name="received_date"  placeholder=" اختر تاريخ الإستلام. " value="{{$reference->received_date or old('received_date')}}">
</div>

<div class="form-group">
    <label for="employee_id"> اسم المهندس المعيين لهذة الاشارة </label>
    <select class="form-control selectpicker" name="employee_id" data-live-search="true">
        <?php $selectedEmployee = isset($reference->employee_id)? $reference->employee_id: '' ?>
        <option value=""> اختر اسم المهندس المعيين على هذة الاشارة. </option>
        @foreach($employeesNames as $employeeId=>$employeeName)
            <option value="{{$employeeId}}" {{($selectedEmployee == $employeeId)? ('selected'):((old('employee_id')==$employeeId)?'selected':'')}} >{{$employeeName}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="malfunctions_type"> نوع العطل </label>
    <textarea name="malfunctions_type" class="form-control" placeholder=" إدخل نوع العطل. ">{{$reference->malfunctions_type or old('malfunctions_type')}}</textarea>
</div>

<div class="form-group">
    <label for="works_done_on_the_machine"> الأعمال التي تم تنفيذها على الآلة </label>
    <textarea name="works_done_on_the_machine" class="form-control" placeholder=" إدخل الأعمال التي تم تنفيذها على الآلة. ">{{$reference->works_done_on_the_machine or old('works_done_on_the_machine')}}</textarea>
</div>

<div class="form-group">
    <label for="readings_of_printing_machine"> قراءة العداد </label>
    <input type="text" class="form-control" id="readings_of_printing_machine" name="readings_of_printing_machine"  placeholder=" إدخل قراءة العداد. " value="{{$reference->readings_of_printing_machine or old('readings_of_printing_machine')}}">
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$reference->comments or old('comments')}}</textarea>
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
