<div class="form-group">
    <label for="code"> كود المقايسة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود الإشارة. " value="{{$indexation->code or old('code')}}">
</div>

<div class="form-group">
    <label for="the_date"> التاريخ  <span style="color:red">*</span></label>
    <input type="text" class="form-control datepicker" id="datepicker" name="the_date"  placeholder=" أختر التاريخ. " value="{{$indexation->the_date or old('the_date')}}">
</div>

<div class="form-group">
    <label for="customer_approval"> موافقة العميل <span style="color:red">*</span></label>
    <select class="form-control" name="customer_approval">
        <?php $indexationCustomerApproval = isset($indexation->customer_approval)? $indexation->customer_approval:'' ;?>
        <option value="">  أختر موافقة العميل.  </option>
        <option value="موافق" {{($indexationCustomerApproval == 'موافق')? 'selected' : ((old('customer_approval')=='موافق')?'selected':'')}}> موافق </option>
        <option value="غير موافق" {{($indexationCustomerApproval == 'غير موافق')? 'selected' : ((old('customer_approval')=='غير موافق')?'selected':'')}}> غير موافق </option>
        <option value="ليس بعد" {{($indexationCustomerApproval == 'ليس بعد')? 'selected' : ((old('customer_approval')=='ليس بعد')?'selected':'')}}> ليس بعد </option>
    </select>
</div>

<div class="form-group">
    <label for="technical_manager_approval"> موافقة مدير الأقسام الفنية <span style="color:red">*</span></label>
    <select class="form-control" name="technical_manager_approval">
        <?php $indexationTechnicalManagerApprovel = isset($indexation->technical_manager_approval)? $indexation->technical_manager_approval:'' ;?>
        <option value="">  أختر موافقة مدير الأقسام الفنية.  </option>
        <option value="موافق" {{($indexationTechnicalManagerApprovel == 'موافق')? 'selected' : ((old('technical_manager_approval')=='موافق')?'selected':'')}}> موافق </option>
        <option value="غير موافق" {{($indexationTechnicalManagerApprovel == 'غير موافق')? 'selected' : ((old('technical_manager_approval')=='غير موافق')?'selected':'')}}> غير موافق </option>
        <option value="ليس بعد" {{($indexationTechnicalManagerApprovel == 'ليس بعد')? 'selected' : ((old('technical_manager_approval')=='ليس بعد')?'selected':'')}}> ليس بعد </option>
    </select>
</div>

<div class="form-group">
    <label for="warehouse_approval"> موافقة المخازن <span style="color:red">*</span></label>
    <select class="form-control" name="warehouse_approval">
        <?php $indexationWarehouseApprovel = isset($indexation->warehouse_approval)? $indexation->warehouse_approval:'' ;?>
        <option value="">  أختر موافقة المخازن.  </option>
        <option value="موافق" {{($indexationWarehouseApprovel == 'موافق')? 'selected' : ((old('warehouse_approval')=='موافق')?'selected':'')}}> موافق </option>
        <option value="غير موافق" {{($indexationWarehouseApprovel == 'غير موافق')? 'selected' : ((old('warehouse_approval')=='غير موافق')?'selected':'')}}> غير موافق </option>
        <option value="ليس بعد" {{($indexationWarehouseApprovel == 'ليس بعد')? 'selected' : ((old('warehouse_approval')=='ليس بعد')?'selected':'')}}> ليس بعد </option>
    </select>
</div>

<div class="form-group">
    <label for="comments"> التعليقات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل تعليقاً. ">{{$indexation->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
@section('head')
{{-- datePicker --}}
    <link rel="stylesheet" href="{{asset('css/datepicker/jquery-ui.min.css')}}">
{{-- datePicker --}}
@endsection
@section('js_footer')
{{-- datePicker --}}
    <script src="{{asset('js/datepicker/jquery-ui.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/datepicker/sys.js')}}" charset="utf-8"></script>
{{-- datePicker --}}
@endsection
