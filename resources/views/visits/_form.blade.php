<div class="jumbotron">
    <div class="form-group">
            <label for="type">
                نوع الزيارة
                <span style="color:red">*</span>
            </label>
        <select class="form-control" name="type" id="type">
            <?php $visitType = isset($visit->type)? $visit->type:'';?>
            <option value="">
                اختر نوع الزيارة
            </option>
            <option value="إشارة" {{($visitType == 'إشارة')? 'selected' : ((old('type')=='إشارة')?'selected':'')}}>
                إشارة
            </option>

            <option value="بطاقة المتابعة" {{($visitType == 'بطاقة المتابعة')? 'selected' : ((old('type')=='بطاقة المتابعة')?'selected':'')}}>
                بطاقة المتابعة
            </option>
        </select>
    </div>

    <div class="form-group" id="group-follow-up-card" style="display:none;">
        <label for="follow_up_card_id"> كود بطاقة المتابعة <span style="color:red">*</span></label>
        <select class="form-control selectpicker" name="follow_up_card_id" data-live-search="true" id="follow-up-card-id">
            <?php $selectedFollowUpCardId = isset($visit->follow_up_card_id)? $visit->follow_up_card_id:'' ;?>
            <option value=""> اختر كود بطاقة المتابعة.  </option>
            @foreach ($followUpCardsIdsCodes as $followUpCardId => $followUpCardCode)
                <option value="{{$followUpCardId}}" {!!($selectedFollowUpCardId == $followUpCardId)? ' selected="selected"' : ((old('follow_up_card_id')==$followUpCardId)?' selected="selected"':'')!!}> {{$followUpCardCode}} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group" id="group-reference" style="display:none;">
        <label for="reference_id"> كود الإشارة <span style="color:red">*</span></label>
        <select class="form-control selectpicker" name="reference_id" data-live-search="true" id="reference-id">
            <?php $selectedReferenceId = isset($visit->reference_id)? $visit->reference_id:'' ;?>
            <option value=""> اختر كود الإشارة.  </option>
            @foreach ($referencesIdsCodes as $referenceId => $referenceCode)
                <option value="{{$referenceId}}" {!!($selectedReferenceId == $referenceId)? ' selected="selected"' : ((old('reference_id')==$referenceId)?' selected="selected"':'')!!}> {{$referenceCode}} </option>
            @endforeach
        </select>
    </div>



</div>

<div class="form-group">
    <label for="printing_machine_id"> كود الآلة التصوير <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="printing_machine_id" data-live-search="true">
        <?php $selectedPrintingMachineId = isset($visit->printing_machine_id)? $visit->printing_machine_id:'' ;?>
        <option value=""> اختر كود الآلة التصوير.  </option>
        @foreach ($printingMachineIdsCodes as $id => $code)
            <option value="{{$id}}" {{($selectedPrintingMachineId == $id)? 'selected' : ((old('printing_machine_id')==$id)?'selected':'')}}> {{$code}} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="the_employee_who_made_the_visit_id"> اسم المهندس الذي قام بالزيارة <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="the_employee_who_made_the_visit_id" data-live-search="true">
        <?php $selectedEmployeeWhoMadeTheVisitId = isset($visit->the_employee_who_made_the_visit_id)? $visit->the_employee_who_made_the_visit_id:'' ;?>
        <option value=""> اختر اسم المهندس الذي قام بالزيارة.  </option>
        @foreach ($employeesIdsNames as $id => $name)
            <option value="{{$id}}" {{($selectedEmployeeWhoMadeTheVisitId == $id)? 'selected' : ((old('the_employee_who_made_the_visit_id')==$id)?'selected':'')}}> {{$name}} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="visit_date"> تاريخ الزيارة <span style="color:red">*</span></label>
    <input type="text" class="form-control datepicker" id="datepicker" name="visit_date"  placeholder=" اختر تاريخ الإصدار. " value="{{$visit->visit_date or old('visit_date')}}">
</div>

<div class="form-group">
    <label for="readings_of_printing_machine"> قراءة العداد <span style="color:red">*</span></label>
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

<script type="text/javascript">
$(function(){
    // for update view
    if ($('#type').val() == 'إشارة') {
        $('#group-reference').css('display', 'block');
        $("#follow-up-card-id option:selected").removeAttr("selected");
    }
    // for update view
    if ($('#type').val() == 'بطاقة المتابعة') {
        $('#group-follow-up-card').css('display', 'block');
        $("#reference-id option:selected").removeAttr("selected");
    }
    $('#type').on('change', function(){
        if (this.value == 'إشارة') {
            $('#group-reference').css('display', 'block');
            $("#follow-up-card-id option:selected").removeAttr("selected");
        } else {
            $('#group-reference').css('display', 'none');
        }

        if (this.value == 'بطاقة المتابعة') {
            $('#group-follow-up-card').css('display', 'block');
            $("#reference-id option:selected").removeAttr("selected");
        } else {
            $('#group-follow-up-card').css('display', 'none');
        }
    });
});
</script>


@endsection
