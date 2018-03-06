<div class="panel panel-danger">
    <div class="panel-body">
        <div class="form-group form-inline">
            <label for="installation-record-printing_machine_search_field">  البحث عن الآلة التصوير:  </label>
            <input type="text" class="form-control" id="installation-record-printing_machine_search_field" name="installation-record-printing_machine_search_field" placeholder=" إدخل الكلمة المراد البحث عنها. " value="{{isset($installationRecord->printingMachine)? isset($installationRecord->printingMachine->customer)?$installationRecord->printingMachine->customer->name:'':'' }}">
            <button type="button" class="btn btn-default" id="installation-record-printing-machine-search-btn"> ابحث </button>
            <spna id="printing-machine-search-p">  </spna>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th> كود الآلة </th>
                        <th> اسم العميل </th>
                        <th> اختيار </th>
                    </tr>
                </thead>
                <tbody  id="installation-record-results-table-body">
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="printing-machine-id"> كود الربط الخاص بالآلة التصوير:  <span style="color:red">*</span></label>
            <p>
                يتم تعين قيمة هذا الكود بعد البحث والضغط على زر اختيار الآلة، برجاء عدم ادخال اي رقم عشوائي
            </p>
            <input type="text" class="form-control" id="printing-machine-id" name="printing_machine_id"  value="{{(isset($installationRecord->printing_machine_id))?($installationRecord->printing_machine_id):((old('printing_machine_id'))?(old('printing_machine_id')):((isset($printingMachineId))?($printingMachineId):('')))}}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="employee_id"> اسم الموظف المسؤول </label> <p> <smale>"المهندس الذي قام بالتركيب"</smale></p>
    <select class="form-control selectpicker" name="employee_id" data-live-search="true">
        <?php $selectedEmployeeId = isset($installationRecord->employee_id)? $installationRecord->employee_id: '' ?>
        <option value=""> اختر اسم الموظف المسؤول. </option>
        @foreach($employeesIdsNames as $employeeId=>$employeeName)
            <option value="{{$employeeId}}" {{($selectedEmployeeId == $employeeId)? ('selected'):((old('employee_id')==$employeeId)?'selected':'')}} >{{$employeeName}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="trainee_name"> اسم العميل الذي تدرب <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="trainee_name" name="trainee_name"  placeholder=" إدخل كود القطعة. " value="{{$installationRecord->trainee_name or old('trainee_name')}}">
</div>

<div class="form-group">
    <label for="installation_date"> تاريخ التركيب <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="datepicker" name="installation_date"  placeholder=" إدخل تاريخ التركيب. " value="{{$installationRecord->installation_date or old('installation_date')}}">
</div>

<div class="jumbotron">
    <legend>فيدر</legend>
    <div class="form-group">
        <label for="feeder_model"> Feeder Model </label>
        <input type="text" class="form-control" id="feeder_model" name="feeder_model"  placeholder="Enter feeder modle. " value="{{$installationRecord->feeder_model or old('feeder_model')}}">
    </div>
    <div class="form-group">
        <label for="feeder_serial_number"> Feeder Serial Number </label>
        <input type="text" class="form-control" id="feeder_serial_number" name="feeder_serial_number"  placeholder=" Enter feeder serial number. " value="{{$installationRecord->feeder_serial_number or old('feeder_serial_number')}}">
    </div>
    <div class="form-group">
        <label for="feeder_product_key"> Feeder Product Key </label>
        <input type="text" class="form-control" id="feeder_product_key" name="feeder_product_key"  placeholder="Enter feeder product key. " value="{{$installationRecord->feeder_product_key or old('feeder_product_key')}}">
    </div>

    <legend> فينشر </legend>
    <div class="form-group">
        <label for="finisher_model"> Finisher Model </label>
        <input type="text" class="form-control" id="finisher_model" name="finisher_model"  placeholder=" Enter finisher modle " value="{{$installationRecord->finisher_model or old('finisher_model')}}">
    </div>
    <div class="form-group">
        <label for="finisher_serial_number"> Finisher Serial Number </label>
        <input type="text" class="form-control" id="finisher_serial_number" name="finisher_serial_number"  placeholder="Enter finisher serial number " value="{{$installationRecord->finisher_serial_number or old('finisher_serial_number')}}">
    </div>
    <div class="form-group">
        <label for="finisher_product_key"> Finisher Product Key </label>
        <input type="text" class="form-control" id="finisher_product_key" name="finisher_product_key"  placeholder="Enter finisher product key " value="{{$installationRecord->finisher_product_key or old('finisher_product_key')}}">
    </div>

    <legend> هارد ديسك </legend>
    <div class="form-group">
        <label for="hard_disk_model"> Hard Disk Model </label>
        <input type="text" class="form-control" id="hard_disk_model" name="hard_disk_model"  placeholder=" Enter hard disk modle " value="{{$installationRecord->hard_disk_model or old('hard_disk_model')}}">
    </div>
    <div class="form-group">
        <label for="hard_disk_serial_number"> Hard Disk Serial Number </label>
        <input type="text" class="form-control" id="hard_disk_serial_number" name="hard_disk_serial_number"  placeholder="Enter hard disk serial number " value="{{$installationRecord->hard_disk_serial_number or old('hard_disk_serial_number')}}">
    </div>
    <div class="form-group">
        <label for="hard_disk_product_key"> Hard Disk Product Key </label>
        <input type="text" class="form-control" id="hard_disk_product_key" name="hard_disk_product_key"  placeholder="Enter hard disk product key " value="{{$installationRecord->hard_disk_product_key or old('hard_disk_product_key')}}">
    </div>

    <legend> بابير درو </legend>
    <div class="form-group">
        <label for="paper_drawer_model"> Paper Drawer Model </label>
        <input type="text" class="form-control" id="paper_drawer_model" name="paper_drawer_model"  placeholder=" Enter paper drawer modle " value="{{$installationRecord->paper_drawer_model or old('paper_drawer_model')}}">
    </div>
    <div class="form-group">
        <label for="paper_drawer_serial_number"> Paper Drawer Serial Number </label>
        <input type="text" class="form-control" id="paper_drawer_serial_number" name="paper_drawer_serial_number"  placeholder="Enter paper drawer serial number " value="{{$installationRecord->paper_drawer_serial_number or old('paper_drawer_serial_number')}}">
    </div>
    <div class="form-group">
        <label for="paper_drawer_product_key"> Paper Drawer Product Key </label>
        <input type="text" class="form-control" id="paper_drawer_product_key" name="paper_drawer_product_key"  placeholder="Enter paper drawer product key " value="{{$installationRecord->paper_drawer_product_key or old('paper_drawer_product_key')}}">
    </div>

    <legend> نيتورك سكانير </legend>
    <div class="form-group">
        <label for="network_scanner_model"> Network Scanner Model </label>
        <input type="text" class="form-control" id="network_scanner_model" name="network_scanner_model"  placeholder=" Enter network scanner modle " value="{{$installationRecord->network_scanner_model or old('network_scanner_model')}}">
    </div>
    <div class="form-group">
        <label for="network_scanner_serial_number"> Network Scanner Serial Number </label>
        <input type="text" class="form-control" id="network_scanner_serial_number" name="network_scanner_serial_number"  placeholder="Enter network scanner serial number " value="{{$installationRecord->network_scanner_serial_number or old('network_scanner_serial_number')}}">
    </div>
    <div class="form-group">
        <label for="network_scanner_product_key"> Network Scanner Product Key </label>
        <input type="text" class="form-control" id="network_scanner_product_key" name="network_scanner_product_key"  placeholder="Enter network scanner product key " value="{{$installationRecord->network_scanner_product_key or old('network_scanner_product_key')}}">
    </div>
</div>

<div class="form-group">
    <label for="installation_record_as_pdf"> صورة لمحضر التركيب بأمتداد PDF </label>
    <input type="file" class="form-control" id="installation_record_as_pdf" name="installation_record_as_pdf">
        @if (isset($installationRecord->softCopies) && $installationRecord->softCopies->isNotEmpty())
            <div class="breadcrumb">
                <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small> حذف ملف المحضر </small>
                <a role="button" href="{{action('InstallationRecordController@removeInstallationRecordFile', ['id'=>$installationRecord->softCopies->first()->id])}}" class="btn btn-danger btn-xs">
                    Delete
                </a>

            </div>
        @endif
</div>


<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$installationRecord->comments or old('comments')}}</textarea>
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
