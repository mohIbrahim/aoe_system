<div class="form-group">
    <label for="user_id"> اسم الموظف <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="user_id" data-live-search="true">
        <?php $selectedEmployee = isset($employee->user_id)? $employee->user_id: '' ?>
        <option value=""> اختر اسم الموظف. </option>
        @foreach($usersNames as $userId=>$userName)
            <option value="{{$userId}}" {{($selectedEmployee == $userId)? ('selected'):((old('user_id')==$userId)?'selected':'')}} >{{$userName}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="code"> كود الموظف </label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود الموظف. " value="{{$employee->code or old('code')}}">
</div>

<div class="form-group">
    <label for="job_title"> المسمى الوظيفي <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="job_title" data-live-search="true">
        <?php $selectedJobTitle = isset($employee->job_title)? $employee->job_title: '' ?>
        <option value=""> اختر المسمى الوظيفي. </option>
        @foreach($jobsTitles as $jobTitle)
            <option value="{{$jobTitle}}" {{($selectedJobTitle == $jobTitle)? ('selected'):((old('job_title')==$jobTitle)?'selected':'')}} >{{$jobTitle}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="department_id"> اسم القسم التابع له </label>
    <select class="form-control selectpicker" name="department_id" data-live-search="true">
        <?php $selectedDepartmentId = isset($employee->department_id)? $employee->department_id: '' ?>
        <option value=""> اختر اسم القسم التابع له. </option>
        @foreach($departmentsIdsNames as $departmentId=>$departmentName)
            <option value="{{$departmentId}}" {{($selectedDepartmentId == $departmentId)? ('selected'):((old('department_id')==$departmentId)?'selected':'')}} >{{$departmentName}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="managed_department_id"> اسم القسم الذي يديره </label>
    <p>
        <small style="color:red">
             في حالة أن هذا الموظف مديراّ لأحد الأقسام
        </small>
    </p>
    <select class="form-control selectpicker" name="managed_department_id" data-live-search="true">
        <?php $selectedManagedDepartmentId = isset($employee->managed_department_id)? $employee->managed_department_id: '' ?>
        <option value=""> اختر اسم القسم الذي يديره. </option>
        @foreach($managedDepartmentsIdsNames as $managedDepartmentId=>$managedDepartmentName)
            <option value="{{$managedDepartmentId}}" {{($selectedManagedDepartmentId == $managedDepartmentId)? ('selected'):((old('managed_department_id')==$managedDepartmentId)?'selected':'')}} >{{$managedDepartmentName}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="date_of_hiring"> تاريخ التعيين  </label>
    <input type="text" class="form-control datepicker" id="datepicker" name="date_of_hiring"  placeholder=" اختر تاريخ التعيين. " value="{{$employee->date_of_hiring or old('date_of_hiring')}}">
</div>

<div class="form-group">
    <label for="salary"> الراتب </label>
    <input type="text" class="form-control" id="salary" name="salary"  placeholder=" إدخل قيمة راتب الموظف. " value="{{$employee->salary or old('salary')}}">
</div>

<div class="panel panel-primary">
    <div class="panel-body">
        <div class="form-group">
            <label for="assigned_machines_ids"> كود الآلات التصوير المعينة لهذا الموظف </label>
            <p>
                <small style="color:red">
                     في حالة أن هذا الموظف احد مهندسي الصيانة يتم تعين الآلات التصوير لهم.
                </small>
            </p>
            <select class="form-control select2" name="assigned_machines_ids[]" data-live-search="true" multiple="multiple">
              <option value="" disabled> اختر اكود الآلات التصوير.  </option>
                <?php $selecteMachinesIds = isset($employee->assignedPrintingMachines)? $employee->assignedPrintingMachines->pluck('id')->toArray():[] ;?>


                @if(!empty(old('assigned_machines_ids')))

                    @foreach ($printingMachinesIdsCodes as $machineId => $machineCode)
                        <option value="{{$machineId}}" {{(in_array($machineId, old('assigned_machines_ids')))? 'selected' : ''}}> {{$machineCode}} </option>
                    @endforeach

                @elseif(!empty($selecteMachinesIds))
                    @foreach ($printingMachinesIdsCodes as $machineId => $machineCode)
                        <option value="{{$machineId}}" {{(in_array($machineId, $selecteMachinesIds))? 'selected' : ''}}> {{$machineCode}} </option>
                    @endforeach
                @else
                    @foreach ($printingMachinesIdsCodes as $machineId => $machineCode)
                        <option value="{{$machineId}}"> {{$machineCode}} </option>
                    @endforeach
                @endif

            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$employee->comments or old('comments')}}</textarea>
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

{{-- select2 --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
{{-- select2 --}}
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

{{-- select2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
{{-- select2 --}}
<script type="text/javascript">
$(document).ready(function() {
$('.select2').select2();
});
</script>
@endsection
