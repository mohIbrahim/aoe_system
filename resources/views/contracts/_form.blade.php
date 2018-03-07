<div class="form-group">
    <label for="code"> كود العقد <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود العقد. " value="{{$contract->code or old('code')}}">
</div>

<div class="panel panel-info">
    <div class="panel-body">
        <div class="form-group">
            <label for="assigned_machines_ids"> آلات التصوير المعينة لهذا العقد <span style="color:red">*</span></label>
        </div>
        <div class="form-group form-inline">
            <label for=""> البحث عن الآلة باسم العميل </label>
            <input type="text" class="form-control" id="printing-machine-search-field" placeholder=" ادخل الكلمة المراد البحث عنها. ">
            <button type="button" class="btn btn-default" id="contract-form-printing-machine-search-button"> ابحث </button>
            <p id="printing-machine-message"></p>
			<p style="color:#F00">
				 برجاء التأكد من الآلات المختارة بحيث تكون الآلات تحت اسم عميل واحد فقط
			</p>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5> نتائج البحث </h5>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> اسم العميل </th>
                            <th> كود الآلة </th>
                            <th> الاختيار </th>
                        </tr>
                    </thead>
                    <tbody id="printing-machine-search-results-table-body">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"> الآلات المعينة </h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> اسم العميل </th>
                            <th> كود الآلة </th>
                            <th> الحذف </th>
                        </tr>
                    </thead>
                    <tbody id="printing-machine-selected-results-table-body">
                        @if (isset($contract))
                            @foreach ($contract->printingMachines as $key => $printingMachine)
                                <tr>
                                    <td>{{isset($printingMachine->customer)?$printingMachine->customer->name:''}}</td>
                                    <td>{{$printingMachine->code}}</td>
                                    <td>
                                        <button type='button' class='btn btn-danger btn-xs printing-machine-delete-button'> حذف الآلة </button>
                                        <input type='hidden' name='assigned_machines_ids[]' value='{{$printingMachine->id}}'>
                                    </td>
                                </tr>
                            @endforeach
                        @elseif(isset($pMachine))
                            <tr>
                                <td>{{isset($pMachine->customer)?$pMachine->customer->name:''}}</td>
                                <td>{{$pMachine->code}}</td>
                                <td>
                                    <button type='button' class='btn btn-danger btn-xs printing-machine-delete-button'> حذف الآلة </button>
                                    <input type='hidden' name='assigned_machines_ids[]' value='{{$pMachine->id}}'>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    <label for="employee_id_who_edits_the_contract"> اسم الموظف الذي قام بتحرير العقد </label>
    <select class="form-control selectpicker" name="employee_id_who_edits_the_contract" data-live-search="true">
        <?php $selectedEmployeeId = isset($contract->employee_id_who_edits_the_contract)? $contract->employee_id_who_edits_the_contract: '' ?>
        <option value=""> اختر اسم الموظف الذي قام بتحرير العقد. </option>
        @foreach($employeesIdsNames as $employeeId=>$employeeName)
            <option value="{{$employeeId}}" {{($selectedEmployeeId == $employeeId)? ('selected'):((old('employee_id_who_edits_the_contract')==$employeeId)?'selected':'')}} >{{$employeeName}}</option>
        @endforeach
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

<div class="panel panel-default">
	<div class="panel-heading text-center">
		<h3> بنود خاصة </h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="add-note-btn"> إضافة بند </label>
            <button type="button" class="btn btn-success" id="contract-new-note-btb">
                إضافة
            </button>
            <p class="help-block"> قم بإضافة البند ووصفه. </p>
		</div>
        <div id="contract-notes-wrapper">
            @if(null !== old('item_name'))
                @foreach ( old('item_name') as $oldIterator => $oldNote )
                    <div class='panel panel-default'>
                        <div class='panel-heading clearfix'>
                            <button type='button' class='btn btn-danger btn-xs pull-left contract-note-delete-btn'>
                                حذف
                            </button>
                        </div>
                        <div class='panel-body'>
                            <div class='form-group'>
                                <label for='item_name'> البند </label>
                                <input type='text' class='form-control' name='item_name[]'  placeholder=' إدخل البند. ' value='{{$oldNote}}'>
                            </div>
                            <div class='form-group'>
                                <label for='item_description'> تعريف البند </label>
                                <textarea name='item_description[]' class='form-control' placeholder=' إدخل تعريف البند. '>{{old('item_description')[$oldIterator]}}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif (isset($contract->notesOnContracting) && $contract->notesOnContracting->isNotEmpty())
                @foreach ($contract->notesOnContracting as $noteIterator => $note)
                    <div class='panel panel-default'>
                        <div class='panel-heading clearfix'>
                            <button type='button' class='btn btn-danger btn-xs pull-left contract-note-delete-btn'>
                                حذف
                            </button>
                        </div>
                        <div class='panel-body'>
                            <div class='form-group'>
                                <label for='item_name'> البند </label>
                                <input type='text' class='form-control' name='item_name[]'  placeholder=' إدخل البند. ' value='{{$note->item_name}}'>
                            </div>
                            <div class='form-group'>
                                <label for='item_description'> تعريف البند </label>
                                <textarea name='item_description[]' class='form-control' placeholder=' إدخل تعريف البند. '>{{$note->item_description}}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
	</div>
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
