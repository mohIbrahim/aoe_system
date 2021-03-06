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

            <option value="بطاقة المتابعة" {{(($visitType == 'بطاقة المتابعة')?('selected'):((old('type')=='بطاقة المتابعة')?('selected'):((isset($type))?(($type =='بطاقة المتابعة')?('selected'):('')):(''))))}}>
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
                <option value="{{$followUpCardId}}" {!!($selectedFollowUpCardId == $followUpCardId)?(' selected="selected"'):((old('follow_up_card_id')==$followUpCardId)?(' selected="selected"'):(''))!!}> {{$followUpCardCode}} </option>
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

<div class="panel panel-default">
        <div class="panel-heading">
            اختيار الآلة التصوير الخاصة بهذا الزيارة<span style="color:red">*</span>
        </div>
    <div class="panel-body">
        <div class="form-group form-inline">
            <label for="printing-machine-search-field">  البحث عن الآلة التصوير:  </label>
            <input type="text" class="form-control" id="printing-machine-search-field" name="printing_machine_search_field" placeholder=" إدخل الكلمة المراد البحث عنها. " value="{{isset($visit->printingMachine)? isset($visit->printingMachine->customer)?$visit->printingMachine->customer->name:'':'' }}">
            <button type="button" class="btn btn-default" id="printing-machine-search-btn"> ابحث </button>
            <span id="printing-machine-search-p">  </span>
            <div class="table-responsive table-responsive-update">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> كود الآلة </th>
                            <th> اسم العميل </th>
                            <th> اختيار </th>
                        </tr>
                    </thead>
                    <tbody  id="results-table-body">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <label for="printing-machine-id"> كود الربط الخاص بالآلة التصوير:  </label>
            <p>
                يتم تعين قيمة هذا الكود بعد البحث والضغط على زر اختيار الآلة.
            </p>
            <input type="text" class="form-control" id="printing-machine-id" name="printing_machine_id"  value="{{(isset($visit->printing_machine_id))?($visit->printing_machine_id):((old('printing_machine_id'))?(old('printing_machine_id')):((isset($printingMachineId))?($printingMachineId):('')))}}" readonly>
        </div>
    </div>
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
    <input type="text" class="form-control" id="datepicker" name="visit_date"  placeholder=" اختر تاريخ الإصدار. " value="{{$visit->visit_date or old('visit_date')}}">
</div>

<div class="form-group">
    <label for="readings_of_printing_machine"> قراءة العداد <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="readings_of_printing_machine" name="readings_of_printing_machine"  placeholder=" إدخل قراءة العداد. " value="{{$visit->readings_of_printing_machine or old('readings_of_printing_machine')}}">
</div>

<div class="form-group">
    <label for="representative_customer_name"> اسم الشخص المسؤول عن الآلة لدى العميل </label>
    <input type="text" class="form-control" id="representative_customer_name" name="representative_customer_name"  placeholder=" إدخل اسم الشخص المسؤول عن الآلة . " value="{{$visit->representative_customer_name or old('representative_customer_name')}}">
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{ $visit->comments or old('comments') }}</textarea>
</div>

<div class="upload_files_pdf_input_fields_wrap_1 panel panel-body panel-info">
    <div class="form-group">
        <label for="upload_files_pdf"> رفع الملفات التي بإمتداد pdf.</label>
        <input type="file" class="form-control" id="upload_files_pdf" name="upload_files_pdf[]">
        <button class="upload_files_pdf_add_field_button_1 btn btn-xs btn-success" role="button"> إضافة ملف آخر </button>
    </div>
    @if (isset($visit->softCopies) && $visit->softCopies->isNotEmpty())
        @foreach( $visit->softCopies as $pdfKey=>$pdfFile)
            @if($pdfFile->type == "pdf")
                <div class="breadcrumb">
                    <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small><a href="{{url('images/project_images/'.$pdfFile->name)}}" target="_blank">{{$pdfKey+1}}.ملف الزيارة  </a> </small>
                    <a role="button" href="{{action('VisitController@removeVisitFile', ['id'=>$pdfFile->id])}}" class="btn btn-danger btn-xs">
                        حذف ملف الزيارة من إمتداد pdf
                    </a>
                </div>
            @endif
        @endforeach
    @endif
</div>

<div class="upload_files_img_input_fields_wrap_1 panel panel-body panel-info">
    <div class="form-group">
        <label for="upload_files_img"> رفع الملفات التي بإمتداد JPG, JPEG "صورة"</label>
        <input type="file" class="form-control" id="upload_files_img" name="upload_files_img[]">
        <button class="upload_files_img_add_field_button_1 btn btn-xs btn-success" role="button"> إضافة ملف آخر </button>
    </div>
    @if (isset($visit->softCopies) && $visit->softCopies->isNotEmpty())
        @foreach( $visit->softCopies as $imgKey=>$imgFile)
            @if($imgFile->type == "img")
                <div class="breadcrumb">
                    <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small><a href="{{url('images/project_images/'.$imgFile->name)}}" target="_blank">{{$imgKey+1}}.ملف الزيارة  <img src="{{url('images/project_images/'.$imgFile->name)}}" width="300px"></a> </small>
                    @if($imgKey !== (count($visit->softCopies)-1))
                        <a role="button" href="{{action('VisitController@removeVisitFile', ['id'=>$imgFile->id])}}" class="btn btn-danger btn-xs">
                            حذف الصورة
                        </a>
                    @endif
                </div>
            @endif
        @endforeach
    @endif
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#printing-machine-search-btn").on("click", function(){
            var keyword = $("#printing-machine-search-field").val();
            $("#printing-machine-search-p").text("");
            $("#results-table-body ").children().remove();
            var resultsTableBody = '';
            if(keyword){
                $.ajax({
                    type:"GET",
                    url:"{{url('visits_pm_search')}}/"+keyword,
                    dataType:"json",
                    success:function(results){
                        $.each(results, function(key, machine){
                            resultsTableBody += "<tr><td>"+machine.code+"</td><td>"+((machine.customer)?machine.customer.name:'')+"</td><td><button type='button' class='btn btn-success btn-xs select-printing-machine' data-printing-machine-id='"+machine.id+"' data-printing-machine-code='"+machine.code+"'> اختيار هذة الآلة </button></td></tr>";
                        });
                        $("#results-table-body").append(resultsTableBody);
                        $(".select-printing-machine").on("click", function(){
                            printingMachineCode = $(this).attr('data-printing-machine-code');
                            printingMachineId = $(this).attr('data-printing-machine-id');
                            $("#printing-machine-id").val(printingMachineId);
                        });
                    },
                });
            }else{
                $("#printing-machine-search-p").text(" برجاء إدخال قيمة ").css('color','red');
            }
        });
    });
</script>

@endsection
