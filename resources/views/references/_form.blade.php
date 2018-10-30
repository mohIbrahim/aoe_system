<div class="form-group">
    <label for="code"> كود الإشارة </label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود الإشارة. " value="{{$reference->code or old('code')}}" readonly>
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
        <option value="تركيب قطع - مستلزمات" {{($referenceType == 'تركيب قطع - مستلزمات')? 'selected' : ((old('type')=='تركيب قطع - مستلزمات')?'selected':'')}}> تركيب قطع - مستلزمات </option>
        <option value="تركيب آلة" {{($referenceType == 'تركيب آلة')? 'selected' : ((old('type')=='تركيب آلة')?'selected':'')}}> تركيب آلة </option>
        <option value="عطل" {{($referenceType == 'عطل')? 'selected' : ((old('type')=='عطل')?'selected':'')}}> عطل </option>
        <option value="زيارة" {{($referenceType == 'زيارة')? 'selected' : ((old('type')=='زيارة')?'selected':'')}}> زيارة </option>
        <option value="تقرير" {{($referenceType == 'تقرير')? 'selected' : ((old('type')=='تقرير')?'selected':'')}}> تقرير </option>
    </select>
</div>

<div class="form-group">
    <label for="status"> حالة الإشارة <span style="color:red">*</span></label>
    <select class="form-control" name="status">
        <?php $referenceStatus = isset($reference->status)? $reference->status:'' ;?>
        <option value="">  اختر حالة الإشارة.  </option>
        <option value="مفتوحة" {{($referenceStatus == 'مفتوحة')? 'selected' : ((old('status')=='مفتوحة')?'selected':'')}}> مفتوحة </option>
        <option value="مغلقة" {{($referenceStatus == 'مغلقة')? 'selected' : ((old('status')=='مغلقة')?'selected':'')}}> مغلقة </option>
        <option value="معلقة لسبب ما" {{($referenceStatus == 'معلقة لسبب ما')? 'selected' : ((old('status')=='معلقة لسبب ما')?'selected':'')}}> معلقة لسبب ما </option>
    </select>
</div>

<div class="form-group">
    <label for="received_date"> تاريخ الإستلام  <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="datepicker" name="received_date"  placeholder=" اختر تاريخ الإستلام. " value="{{$reference->received_date or old('received_date')}}" autocomplete="off">
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
                            <div class='form-group'>
                                <label for='required_parts'> قطع الآلة المطلوبة </label>
                                <textarea name='required_parts[]' class='form-control' placeholder=' إدخل قطع الآلة المطلوبة. '>{{old('required_parts')[$oldMalfunctionTypeIterator]}}</textarea> 
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
                            <div class='form-group'>
                                <label for='required_parts'> قطع الآلة المطلوبة </label>
                                <textarea name='required_parts[]' class='form-control' placeholder=' إدخل قطع الآلة المطلوبة. '>{{$malfunction->required_parts}}</textarea> 
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
    <label for="informer_name"> اسم مُبلغ الإشارة </label>
    <input type="text" class="form-control" id="informer_name" name="informer_name"  placeholder=" إدخل اسم مُبلغ الإشارة. " value="{{$reference->informer_name or old('informer_name')}}">
</div>

<div class="form-group">
    <label for="informer_phone"> رقم تليفون المُبلغ عن الإشارة </label>
    <input type="text" class="form-control" id="informer_phone" name="informer_phone"  placeholder=" إدخل رقم تليفون المُبلغ عن الإشارة. " value="{{$reference->informer_phone or old('informer_phone')}}">
</div>


<div class="form-group">
        <label for="reviewed_by_the_chief_engineer"> هل تم المراجعة من كبير المهندسين؟ </label><br>
        <input type="radio" name="reviewed_by_the_chief_engineer" value="نعم" {{(  (old('reviewed_by_the_chief_engineer')=='نعم')?('checked'):((isset($reference) && (old('reviewed_by_the_chief_engineer') == ''))?(($reference->reviewed_by_the_chief_engineer == 'نعم')?('checked'):('')):(''))  )}}>
        <h4 style="display:inline"> نعم </h4><br>
        <input type="radio" name="reviewed_by_the_chief_engineer" value="لا" {{(  (old('reviewed_by_the_chief_engineer') == 'لا')?('checked'):((isset($reference) && (old('reviewed_by_the_chief_engineer') == ''))?(($reference->reviewed_by_the_chief_engineer == 'لا')?('checked'):('')):(''))  )}}>
        <h4 style="display:inline"> لا </h4><br>
    </div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$reference->comments or old('comments')}}</textarea>
</div>

<div class="upload_files_pdf_input_fields_wrap_1 panel panel-body panel-info">
    <div class="form-group">
        <label for="upload_files_pdf"> رفع الملفات التي بإمتداد pdf.</label>
        <input type="file" class="form-control" id="upload_files_pdf" name="upload_files_pdf[]">
        <button class="upload_files_pdf_add_field_button_1 btn btn-xs btn-success" role="button"> إضافة ملف آخر </button>
    </div>
    @if (isset($reference->softCopies) && $reference->softCopies->isNotEmpty())
        @foreach( $reference->softCopies as $pdfKey=>$pdfFile)
            @if($pdfFile->type == "pdf")
                <div class="breadcrumb">
                    <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small><a href="{{url('images/project_images/'.$pdfFile->name)}}" target="_blank">{{$pdfKey+1}}.ملف الإشارة  </a> </small>
                    <a role="button" href="{{action('ReferenceController@removeReferenceFile', ['id'=>$pdfFile->id])}}" class="btn btn-danger btn-xs">
                        حذف ملف الإشارة من إمتداد pdf
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
    @if (isset($reference->softCopies) && $reference->softCopies->isNotEmpty())
        @foreach( $reference->softCopies as $imgKey=>$imgFile)
            @if($imgFile->type == "img")
                <div class="breadcrumb">
                    <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small><a href="{{url('images/project_images/'.$imgFile->name)}}" target="_blank">{{$imgKey+1}}.ملف الإشارة  <img src="{{url('images/project_images/'.$imgFile->name)}}" width="300px"></a> </small>
                    <a role="button" href="{{action('ReferenceController@removeReferenceFile', ['id'=>$imgFile->id])}}" class="btn btn-danger btn-xs">
                        حذف الصورة
                    </a>
                </div>
            @endif
        @endforeach
    @endif
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
