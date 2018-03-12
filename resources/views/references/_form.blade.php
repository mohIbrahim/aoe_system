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
    <label for="status"> حالة الإشارة <span style="color:red">*</span></label>
    <select class="form-control" name="status">
        <?php $referencestatus = isset($reference->status)? $reference->status:'' ;?>
        <option value="">  اختر حالة الإشارة.  </option>
        <option value="مفتوحة" {{($referenceType == 'مفتوحة')? 'selected' : ((old('type')=='مفتوحة')?'selected':'')}}> مفتوحة </option>
        <option value="مغلقة" {{($referenceType == 'مغلقة')? 'selected' : ((old('type')=='مغلقة')?'selected':'')}}> مغلقة </option>
        <option value="معلقة لسبب ما" {{($referenceType == 'معلقة لسبب ما')? 'selected' : ((old('type')=='معلقة لسبب ما')?'selected':'')}}> معلقة لسبب ما </option>
    </select>
</div>

<div class="form-group">
    <label for="received_date"> تاريخ الإستلام  <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="datepicker" name="received_date"  placeholder=" اختر تاريخ الإستلام. " value="{{$reference->received_date or old('received_date')}}">
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
        <div class="panel-heading">
            اختيار الآلة التصوير الخاصة بهذة الإشارة<span style="color:red">*</span>
        </div>
    <div class="panel-body">
        <div class="form-group form-inline">
            <label for="reference-printing-machine-search-field">  البحث عن الآلة التصوير:  </label>
            <input type="text" class="form-control" id="reference-printing-machine-search-field" name="printing_machine_search_field" placeholder=" إدخل الكلمة المراد البحث عنها. " value="{{isset($reference->printingMachine)? isset($reference->printingMachine->code)?$reference->printingMachine->code:'':'' }}">
            <button type="button" class="btn btn-default" id="reference-printing-machine-search-btn"> ابحث </button>
            <spna id="reference-printing-machine-search-p">  </spna>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th> كود الآلة </th>
                        <th> اسم العميل </th>
                        <th> اسم الموظف المسؤول عن الآلة </th>
                        <th> اختيار </th> 
                    </tr>
                </thead>
                <tbody  id="reference-results-table-body">
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="printing-machine-id"> كود الربط الخاص بالآلة التصوير:  </label>
            <p>
                يتم تعين قيمة هذا الكود بعد البحث والضغط على زر اختيار الآلة.
            </p>
            <input type="text" class="form-control" id="printing-machine-id" name="printing_machine_id"  value="{{(isset($reference->printing_machine_id))?($reference->printing_machine_id):((old('printing_machine_id'))?(old('printing_machine_id')):((isset($printingMachineId))?($printingMachineId):('')))}}" readonly>
        </div>
    </div>
</div>

<div class="panel panel-default">
	<div class="panel-heading text-center">
		<h3> الأعطال </h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="add-note-btn"> إضافة عطل </label>
            <button type="button" class="btn btn-success" id="reference-new-malfunction-btb">
                إضافة
            </button>
            <p class="help-block"> قم بإضافة العطل والعمل الذي تم تنفيذه عليه. </p>
		</div>
        <div id="reference-malfunction-wrapper">
            @if(null !== old('malfunction_type'))
                @foreach ( old('malfunction_type') as $oldMalfunctionTypeIterator => $oldMalfunctionType )
                    <div class='panel panel-default'>
                        <div class='panel-heading clearfix'>
                            <button type='button' class='btn btn-danger btn-xs pull-left reference-malfunction-delete-btn'>
                                حذف
                            </button>
                        </div>
                        <div class='panel-body'>
                            <div class='form-group'>
                                <label for='malfunction_type'> نوع العطل </label>
                                <input type='text' class='form-control' name='malfunction_type[]'  placeholder=' إدخل نوع العطل. ' value='{{$oldMalfunctionType}}'>
                            </div>
                            <div class='form-group'>
                                <label for='works_were_done'> الأعمال التي تم تنفيذها </label>
                                <textarea name='works_were_done[]' class='form-control' placeholder=' إدخل الأعمال التي تم تنفيذها. '>{{old('works_were_done')[$oldMalfunctionTypeIterator]}}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif (isset($reference->malfunctions) && $reference->malfunctions->isNotEmpty())
                @foreach ($reference->malfunctions as $malfunctionIterator => $malfunction)
                    <div class='panel panel-default'>
                        <div class='panel-heading clearfix'>
                            <button type='button' class='btn btn-danger btn-xs pull-left reference-malfunction-delete-btn'>
                                حذف
                            </button>
                        </div>
                        <div class='panel-body'>
                            <div class='form-group'>
                                <label for='malfunction_type'> نوع العطل </label>
                                <input type='text' class='form-control' name='malfunction_type[]'  placeholder=' إدخل نوع العطل. ' value='{{$malfunction->malfunction_type}}'>
                            </div>
                            <div class='form-group'>
                                <label for='works_were_done'> الأعمال التي تم تنفيذها </label>
                                <textarea name='works_were_done[]' class='form-control' placeholder=' إدخل الأعمال التي تم تنفيذها. '>{{$malfunction->works_were_done}}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
	</div>
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

@if(isset($reference))
    <div class="clearfix pull-left text-center">
        <a role="button" href="{{action('ReferenceController@closeTheReference', ['refrence_id'=>$reference->id])}}" class="btn btn-success btn-md">غلــق الإشارة</a>
        <p >تاريخ الغلق: {{$reference->closing_date or 'لم يتم الغلق بعد'}}</p>
    </div>
    <div class="clearfix">
    </div>
@endif

<button type="submit" class="btn btn-primary btn-lg center-block">
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
