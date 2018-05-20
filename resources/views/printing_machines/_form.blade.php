<div class="form-group">
    <label for="customer_id"> كود العميل مالك أو مستأجر الآلة <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="customer_id" data-live-search="true">
        <?php $selectedCustomerId = isset($printingMachine->customer_id)? $printingMachine->customer_id:'' ;?>
        <option value=""> اختر كود العميل.  </option>
        @foreach ($customerIdsCodes as $id => $code)
        <option value="{{$id}}" {{($selectedCustomerId == $id)? 'selected' : ((old('customer_id')==$id)?'selected': ((isset($incommingCustomer))?(($incommingCustomer == $id)?('selected'):('')):('')) )}}> {{$code}} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="folder_number"> رقم ملف الآلة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="folder_number" name="folder_number"  placeholder=" إدخل رقم ملف الآلة. " value="{{$printingMachine->folder_number or old('folder_number')}}">
</div>

<div class="form-group">
    <label for="the_manufacture_company"> اسم الشركة المصنعة للآلة </label>
    <input type="text" class="form-control" id="the_manufacture_company" name="the_manufacture_company"  placeholder=" إدخال اسم الشركة المصنعة للآلة. " value="{{$printingMachine->the_manufacture_company or old('the_manufacture_company')}}">
</div>

<div class="form-group">
    <label for="model_prefix"> الموديل الجزء الأول <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="model_prefix" name="model_prefix"  placeholder="  إدخل موديل الآلة الجزء الأول. " value="{{$printingMachine->model_prefix or old('model_prefix')}}">
    <p> مثل SF AR JP DX DR ... </p>
</div>

<div class="form-group">
    <label for="model_suffix"> الموديل الجزء الثاني <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="model_suffix" name="model_suffix"  placeholder=" إدخل موديل الآلة الجزء الثاني. " value="{{$printingMachine->model_suffix or old('model_suffix')}}">
    <p> مثل 6026N, 564N ... </p>
</div>

<div class="form-group">
    <label for="serial_number"> الرقم المسلسل <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="serial_number" name="serial_number"  placeholder=" إدخل الرقم المسلسل. " value="{{$printingMachine->serial_number or old('serial_number')}}">
</div>

<div class="form-group">
    <label for="product_key"> Product Key </label>
    <input type="text" class="form-control" id="product_key" name="product_key"  placeholder=" إدخل ال product key. " value="{{$printingMachine->product_key or old('product_key')}}">
</div>

<div class="form-group">
    <label for="status"> حالة الآلة <span style="color:red">*</span></label>
    <select class="form-control" name="status">
        <?php $printingMachineStatus = isset($printingMachine->status)? $printingMachine->status:'' ;?>
        <option value="">  اختر حالة الآلة.  </option>
        <option value="لم يتم تركيبها بعد" {{($printingMachineStatus == 'لم يتم تركيبها بعد')? 'selected' : ((old('status')=='لم يتم تركيبها بعد')?'selected':'')}}> لم يتم تركيبها بعد </option>
        <option value="فعالة" {{($printingMachineStatus == 'فعالة')? 'selected' : ((old('status')=='فعالة')?'selected':'')}}> فعالة </option>
        <option value="موقوفة" {{($printingMachineStatus == 'موقوفة')? 'selected' : ((old('status')=='موقوفة')?'selected':'')}}> موقوفة </option>
        <option value="مكهنة" {{($printingMachineStatus == 'مكهنة')? 'selected' : ((old('status')=='مكهنة')?'selected':'')}}> مكهنة </option>
    </select>
</div>

<div class="form-group">
    <label for="manufacturing_year"> سنة التصنيع </label>
    <input type="text" class="form-control" id="datepicker6" name="manufacturing_year"  placeholder=" إدخل سنة التصنيع. " value="{{$printingMachine->manufacturing_year or old('manufacturing_year')}}">
</div>

<div class="form-group">
    <label for="description"> وصف الآلة </label>
    <textarea name="description" class="form-control" placeholder=" إدخل وصف ووظائف الآلة. ">{{$printingMachine->description or old('description')}}</textarea>
</div>

<div class="form-group">
    <label for="price_without_tax"> سعر الآلة عند البيع بدون ضريبة </label>
    <input type="text" class="form-control" id="price_without_tax" name="price_without_tax"  placeholder=" إدخل السعر بدون ضريبة. " value="{{$printingMachine->price_without_tax or old('price_without_tax')}}">
</div>


<div class="form-group">
    <label for="price_with_tax">  سعر الآلة عند البيع بالضريبة </label>
    <input type="text" class="form-control" id="price_with_tax" name="price_with_tax"  placeholder=" إدخل السعر بالضريبة. " value="{{$printingMachine->price_with_tax or old('price_with_tax')}}">
</div>

<div class="form-group">
    <label> هل هذة الآلة تم بيعها عن طريق الشركة العربية؟ </label><br>
    
    <label for="solid_by_aoe_yes"> نعم </label>
    <input type="radio" class="" id="solid_by_aoe_yes" name="is_sold_by_aoe" value="1"
    {{isset($printingMachine->is_sold_by_aoe)? (($printingMachine->is_sold_by_aoe == 1)? "checked":""):(old("is_sold_by_aoe"))}} ><br>
    <label for="solid_by_aoe_no"> لا </label>
    <input type="radio" class="" id="solid_by_aoe_no" name="is_sold_by_aoe" value="0"
    {{isset($printingMachine->is_sold_by_aoe)? (($printingMachine->is_sold_by_aoe == 0)? "checked":""):(old("is_sold_by_aoe"))}}>
</div>

<div class="form-group">
    <label for="employee_delivered_the_machine"> اسم الموظف الذي قام بتسليم الآلة </label>
    <select class="form-control selectpicker" name="employee_delivered_the_machine" data-live-search="true">
        <?php $selectedEmployeeName = isset($printingMachine->employee_delivered_the_machine)? $printingMachine->employee_delivered_the_machine: '' ?>
        <option value=""> اختر اسم الموظف الذي قام بتسليم الآلة. </option>
        @foreach($employeesNames as $employeeName)
        <option value="{{$employeeName}}" {{($selectedEmployeeName == $employeeName)? ('selected'):((old('employee_delivered_the_machine')==$employeeName)?'selected':'')}} >{{$employeeName}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="assigned_employees"> اسماء المواظفين المعينين على هذة الآلة </label>
    <select class="form-control selectpicker" name="assigned_employees[]" data-live-search="true" multiple>
        <?php $assignedEmployeesIds = ((isset($printingMachine))?(($printingMachine->assignedEmployees->isNotEmpty())?($printingMachine->assignedEmployees->pluck('id')->toArray()):([])):([]));        ?>
        <option value=""> اختر اسماء الموظفين المعينين على هذة الآلة. </option>
        @foreach($assignedEmployeesNamesIds as $empId=>$empName)
            @if(old('assigned_employees'))
                @if(in_array($empId, old('assigned_employees')))
                    <option value="{{$empId}}" selected>{{$empName}}</option>
                @else
                    <option value="{{$empId}}">{{$empName}}</option>
                @endif
            @elseif(!empty($assignedEmployeesIds))
                @if(in_array($empId, $assignedEmployeesIds))
                    <option value="{{$empId}}" selected>{{$empName}}</option>
                @else
                    <option value="{{$empId}}">{{$empName}}</option>
                @endif
            @else
                <option value="{{$empId}}">{{$empName}}</option>
            @endif
        @endforeach
    </select>
</div>

<div class="jumbotron">
    <legend>فيدر</legend>
    <div class="form-group">
        <label for="feeder_model"> Feeder Model </label>
        <input type="text" class="form-control" id="feeder_model" name="feeder_model"  placeholder="Enter feeder modle. " value="{{$printingMachine->feeder_model or old('feeder_model')}}">
    </div>
    
    <legend> فينشر </legend>
    <div class="form-group">
        <label for="finisher_model"> Finisher Model </label>
        <input type="text" class="form-control" id="finisher_model" name="finisher_model"  placeholder=" Enter finisher modle " value="{{$printingMachine->finisher_model or old('finisher_model')}}">
    </div>
    
    <legend> هارد ديسك </legend>
    <div class="form-group">
        <label for="hard_disk_model"> Hard Disk Model </label>
        <input type="text" class="form-control" id="hard_disk_model" name="hard_disk_model"  placeholder=" Enter hard disk modle " value="{{$printingMachine->hard_disk_model or old('hard_disk_model')}}">
    </div>
    
    <legend> بابير درو </legend>
    <div class="form-group">
        <label for="paper_drawer_model"> Paper Drawer Model </label>
        <input type="text" class="form-control" id="paper_drawer_model" name="paper_drawer_model"  placeholder=" Enter paper drawer modle " value="{{$printingMachine->paper_drawer_model or old('paper_drawer_model')}}">
    </div>
    
    <legend> نيتورك سكانير </legend>
    <div class="form-group">
        <label for="network_scanner_model"> Network Scanner Model </label>
        <input type="text" class="form-control" id="network_scanner_model" name="network_scanner_model"  placeholder=" Enter network scanner modle " value="{{$printingMachine->network_scanner_model or old('network_scanner_model')}}">
    </div>
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$printingMachine->comments or old('comments')}}</textarea>
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
