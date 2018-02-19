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
            <p class="help-block">في حالة أن هذا الموظف احد مهندسي الصيانة يتم تعين الآلات التصوير لهم.</p>
        </div>
        <div class="form-group form-inline">
            <label for=""> البحث عن الآلة </label>
            <input type="text" class="form-control" id="printing-machine-search-field" placeholder=" ادخل الكلمة المراد البحث عنها. ">
            <button type="button" class="btn btn-default" id="printing-machine-search-button"> ابحث </button>
            <p id="printing-machine-message"></p>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> نتائج البحث </h3>
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
        <div class="panel panel-default">
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
                        @if (isset($employee))
                            @foreach ($employee->assignedPrintingMachines as $key => $printingMachine)
                                <tr>
                                    <td>{{isset($printingMachine->customer)?$printingMachine->customer->name:''}}</td>
                                    <td>{{$printingMachine->code}}</td>
                                    <td>
                                        <button type='button' class='btn btn-danger btn-xs printing-machine-delete-button'> حذف الآلة </button>
                                        <input type='hidden' name='assigned_machines_ids[]' value='{{$printingMachine->id}}'>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
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
    $(document).ready(function () {
        $("#printing-machine-search-button").on("click", function(){
            var keyword = $("#printing-machine-search-field").val();
            var resultsTableBody = "";
            if (keyword) {
                $("#printing-machine-message").text("");
                $("#printing-machine-search-results-table-body").children().remove();

                $.ajax({
                    type:"GET",
                    url:"{{url('employees_pm_search')}}/"+keyword,
                    dataType:"json",
                    success:function(results){
                        $.each(results, function(key, printingMachine){
                            resultsTableBody += "<tr><td>"+((printingMachine.customer)?printingMachine.customer.name:'')+"</td><td>"+printingMachine.code+"</td><td><button type='button' class='btn btn-success btn-xs printing-machine-select-button' data-priting-machine-id='"+printingMachine.id+"' data-customer-name='"+((printingMachine.customer)?printingMachine.customer.name:'')+"' data-printing-machine-code='"+printingMachine.code+"'> اختيار الآلة </button></td></tr>";
                        });
                        $("#printing-machine-search-results-table-body").append(resultsTableBody);
                        $(".printing-machine-select-button").on("click", function(){
                            pMId = $(this).attr("data-priting-machine-id");
                            pMCode = $(this).attr("data-printing-machine-code");
                            customerName = $(this).attr("data-customer-name");
                            $("#printing-machine-selected-results-table-body").append("<tr><td>"+customerName+"</td><td>"+pMCode+"</td><td><button type='button' class='btn btn-danger btn-xs printing-machine-delete-button'> حذف الآلة </button><input type='hidden' name='assigned_machines_ids[]' value='"+pMId+"'></td></tr>");
                            $(this).parent().parent().fadeOut('500', function(){
                                $(this).remove();
                            });
                            $(".printing-machine-delete-button").on("click", function(){
                                $(this).parent().parent().fadeOut('500', function(){
                                    $(this).remove();
                                });
                            });
                        });
                    },
                });
            } else {
                $("#printing-machine-message").text(" برجاء ادخال الكلمة المراد البحث عنها. ").css("color", "red");
            }
        });
        $(".printing-machine-delete-button").on("click", function(){
            $(this).parent().parent().fadeOut('500', function(){
                $(this).remove();
            });
        });
    });
</script>
@endsection
