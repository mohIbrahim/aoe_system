<div class="form-group">
    <label for="code"> كود القطعة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود القطعة. " value="{{$part->code or old('code')}}">
</div>

<div class="form-group">
    <label for="part_number"> رقم القطعة </label>
    <input type="text" class="form-control" id="part_number" name="part_number"  placeholder=" إدخل رقم القطعة. " value="{{$part->part_number or old('part_number')}}">
</div>

<div class="form-group">
    <label for="name"> اسم القطعة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="name" name="name"  placeholder=" إدخل اسم القطعة. " value="{{$part->name or old('name')}}">
</div>

<div class="form-group">
    <label for="type"> نوع القطعة <span style="color:red">*</span></label>
    <select class="form-control" name="type">
        <?php $partType = isset($part->type)? $part->type:'' ;?>
        <option value="">  اختر نوع القطعة  </option>
        <option value="قطعة غيار" {{($partType == 'قطعة غيار')? 'selected' : ((old('type')=='قطعة غيار')?'selected':'')}}> قطعة غيار </option>
        <option value="مستهلكات" {{($partType == 'مستهلكات')? 'selected' : ((old('type')=='مستهلكات')?'selected':'')}}> مستهلكات </option>
        <option value="ملحقات" {{($partType == 'ملحقات')? 'selected' : ((old('type')=='ملحقات')?'selected':'')}}> ملحقات </option>
    </select>
</div>

<div class="form-group">
    <label for="descriptions"> وصف القطعة </label>
    <textarea name="descriptions" class="form-control" placeholder=" إدخل وصف القطعة. ">{{$part->descriptions or old('descriptions')}}</textarea>
</div>

<div class="form-group">
    <label for="is_serialized"> هل لها قطع فرعية <span style="color:red">*</span></label>
    <select class="form-control" name="is_serialized" id="is-serialized">
        <?php $isSerialized = isset($part->is_serialized)? $part->is_serialized:'' ;?>
        <option value="">  اختر نعم أو لا  </option>
        <option value="1" {{($isSerialized == '1')? 'selected' : ((old('is_serialized')=='1')?'selected':'')}}> نعم </option>
        <option value="0" {{($isSerialized == '0')? 'selected' : ((old('is_serialized')=='0')?'selected':'')}}> لا </option>
    </select>
</div>

<div class="form-group" id="no-serial-qty-group" style="display: none">
    <label for="no_serial_qty"> عدد القطع <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="no-serial-qty-input" name="no_serial_qty" placeholder=" إدخل رقم القطعة. " value="{{$part->no_serial_qty or old('no_serial_qty')}}">
</div>

<div class="form-group">
    <label for="compatible_printing_machines"> آلات الطباعة المتوافقة مع هذة القطعة </label>
    <textarea name="compatible_printing_machines" class="form-control" placeholder=" إدخل آلات الطباعة المتوافقة مع هذة القطعة. ">{{$part->compatible_printing_machines or old('compatible_printing_machines')}}</textarea>
</div>

<div class="form-group">
    <label for="location_in_warehouse"> مكان القطعة في المخزن </label>
    <textarea name="location_in_warehouse" class="form-control" placeholder=" إدخل مكان القطعة. ">{{$part->location_in_warehouse or old('location_in_warehouse')}}</textarea>
</div>

<div class="form-group">
    <label for="product_number"> رقم المنتج "Product Number"</label>
    <input type="text" class="form-control" id="product_number" name="product_number"  placeholder=" إدخل رقم المنتج لهذة القطعة. " value="{{$part->product_number or old('product_number')}}">
</div>

<div class="form-group">
    <label for="price_with_tax"> سعر القطعة بالضريبة "الحالي"</label>
    <input type="text" class="form-control" id="price_with_tax" name="price_with_tax"  placeholder=" إدخل سعر القطعة بالضريبة. " value="{{$part->price_with_tax or old('price_with_tax')}}">
</div>

<div class="form-group">
    <label for="price_without_tax"> سعر القطعة بدون الضريبة "الحالي"</label>
    <input type="text" class="form-control" id="price_without_tax" name="price_without_tax"  placeholder=" إدخل سعر القطعة بدون الضريبة. " value="{{$part->price_without_tax or old('price_without_tax')}}">
</div>

<div class="form-group">
    <label for="production_date"> تاريخ الإنتاج </label>
    <input type="text" class="form-control" id="datepicker" name="production_date"  placeholder=" اختر تاريخ الإنتاج. " value="{{$part->production_date or old('production_date')}}">
</div>

<div class="form-group">
    <label for="expiry_date"> تاريخ الإنتهاء </label>
    <input type="text" class="form-control" id="datepicker2" name="expiry_date"  placeholder=" اختر تاريخ الإنتهاء. " value="{{$part->expiry_date or old('expiry_date')}}">
</div>

<div class="form-group">
    <label for="life"> العمر الافتراضي للقطعة </label>
    <input type="text" class="form-control" id="life" name="life"  placeholder=" إدخل العمر الافتراضي للقطعة. " value="{{$part->life or old('life')}}">
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$part->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block">
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

<script>
    $(document).ready(function(){
        if ($('#is-serialized').val() == '0') {
            $('#no-serial-qty-group').css('display', 'block');
        }
        $('#is-serialized').on('change', function(){
            if ($(this).val() == '0') {
                $('#no-serial-qty-group').fadeIn('slow');
            } else {
                $('#no-serial-qty-group').css('display', 'none');
                $('#no-serial-qty-input').val(0);
            }
        });
    });
</script>
@endsection
