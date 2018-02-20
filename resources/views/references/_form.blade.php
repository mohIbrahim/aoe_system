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

<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group form-inline">
            <label for="printing-machine-search-field">  البحث عن الآلة التصوير:  </label>
            <input type="text" class="form-control" id="printing-machine-search-field" name="printing_machine_search_field" placeholder=" إدخل الكلمة المراد البحث عنها. " value="{{isset($reference->printingMachine)? isset($reference->printingMachine->customer)?$reference->printingMachine->customer->name:'':'' }}">
            <button type="button" class="btn btn-default" id="printing-machine-search-btn"> ابحث </button>
            <spna id="printing-machine-search-p">  </spna>
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
        <div class="form-group">
            <label for="printing-machine-id"> كود الربط الخاص بالآلة التصوير:  <span style="color:red">*</span></label>
            <p>
                يتم تعين قيمة هذا الكود بعد البحث والضغط على زر اختيار الآلة، برجاء عدم ادخال اي رقم عشوائي
            </p>
            <input type="text" class="form-control" id="printing-machine-id" name="printing_machine_id"  value="{{(isset($reference->printing_machine_id))?($reference->printing_machine_id):((old('printing_machine_id'))?(old('printing_machine_id')):((isset($printingMachineId))?($printingMachineId):('')))}}">
        </div>
    </div>
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
    <label for="reference_as_pdf"> صورة للإشارة بأمتداد PDF </label>
    <input type="file" class="form-control" id="reference_as_pdf" name="reference_as_pdf">
        @if (isset($reference->softCopies) && $reference->softCopies->isNotEmpty())
            <div class="breadcrumb">
                <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small> حذف ملف الإشارة </small>
                <a role="button" href="{{action('ReferenceController@removeReferenceFile', ['id'=>$reference->softCopies->first()->id])}}" class="btn btn-danger btn-xs">
                    Delete
                </a>
            </div>
        @endif
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
                    url:"{{url('references_pm_search')}}/"+keyword,
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
