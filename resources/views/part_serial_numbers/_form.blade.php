@section('head')
    <link rel="stylesheet" href="{{asset('css/datepicker/jquery-ui.min.css')}}">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-select/bootstrap-select.min.css')}}">
@endsection


<div class="form-group">
    <label for="part_id"> القطعة الرئيسة <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="part_id" data-live-search="true">
        <?php $partSerialNumberPartId = isset($partSerialNumber->part_id)? $partSerialNumber->part_id:'' ;?>
        <option value=""> إختر القطعة الرئيسية التابعة لها.  </option>
        @foreach ($parts as $partId=>$partName)
            <option value="{{$partId}}" {{($partSerialNumberPartId == $partId)? 'selected' : ((old('part_id')==$partId)?'selected':'')}}> {{$partName}} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="serial_number"> الرقم المسلسل <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="serial_number" name="serial_number"  placeholder=" إدخل الرقم المسلسل. " value="{{$partSerialNumber->serial_number or old('serial_number')}}">
</div>

<div class="form-group">
    <label for="code"> كود القطعة </label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود القطعة. " value="{{$partSerialNumber->code or old('code')}}">
</div>

<div class="form-group">
    <label for="availability"> التوافر </label>
    <select class="form-control" name="availability">
        <?php $partSerialNumberAvailability = isset($partSerialNumber->availability)? $partSerialNumber->availability:'' ;?>
        <option value="">  إختر أذا كانت القطعة متوفرة أو غير متوفرة في المخزن.  </option>
        <option value="متوفرة" {{($partSerialNumberAvailability == 'متوفرة')? 'selected' : ((old('type')=='متوفرة')?'selected':'')}}> متوفرة </option>
        <option value="غير متوفرة" {{($partSerialNumberAvailability == 'غير متوفرة')? 'selected' : ((old('type')=='غير متوفرة')?'selected':'')}}> غير متوفرة </option>
    </select>
</div>

<div class="form-group">
    <label for="status"> الحالة </label>
    <select class="form-control" name="status">
        <?php $partSerialNumberStatus = isset($partSerialNumber->status)? $partSerialNumber->status:'' ;?>
        <option value="">  إختر حالة القطعة.  </option>
        <option value="جديدة" {{($partSerialNumberStatus == 'جديدة')? 'selected' : ((old('type')=='جديدة')?'selected':'')}}> جديدة </option>
        <option value="مستعملة" {{($partSerialNumberStatus == 'مستعملة')? 'selected' : ((old('type')=='مستعملة')?'selected':'')}}> مستعملة </option>
    </select>
</div>

<div class="form-group">
    <label for="date_of_entry"> تاريخ دخول القطعة </label>
    <input type="text" class="form-control" id="datepicker" name="date_of_entry"  placeholder=" إدخل تاريخ دخول القطعة. " value="{{$partSerialNumber->date_of_entry or old('date_of_entry')}}">
</div>

<div class="form-group">
    <label for="date_of_departure"> تاريخ خروج القطعة </label>
    <input type="text" class="form-control" id="datepicker2" name="date_of_departure"  placeholder=" إدخل تاريخ خروج القطعة. " value="{{$partSerialNumber->date_of_departure or old('date_of_departure')}}">
</div>

<div class="form-group">
    <label for="comments"> التعليقات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل تعليقاً. ">{{$partSerialNumber->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
@section('js_footer')
    <script src="{{asset('js/datepicker/jquery-ui.min.js')}}" charset="utf-8"></script>
@endsection
