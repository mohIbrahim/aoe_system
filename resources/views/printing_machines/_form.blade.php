<div class="form-group">
  <label for="folder_number"> رقم ملف الآلة <span style="color:red">*</span></label>
  <input type="text" class="form-control" id="folder_number" name="folder_number"  placeholder=" إدخل رقم ملف الآلة. " value="{{$printingMachine->folder_number or old('folder_number')}}">
</div>

<div class="form-group">
  <label for="code">كود الآلة <span style="color:red">*</span></label>
  <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل الكود الخاص بالآلة. " value="{{$printingMachine->code or old('code')}}">
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
  <label for="serial_number"> Serial Number </label>
  <input type="text" class="form-control" id="serial_number" name="serial_number"  placeholder=" إدخل ال serial number. " value="{{$printingMachine->serial_number or old('serial_number')}}">
</div>

<div class="form-group">
  <label for="product_key"> Product Key </label>
  <input type="text" class="form-control" id="product_key" name="product_key"  placeholder=" إدخل ال product key. " value="{{$printingMachine->product_key or old('product_key')}}">
</div>

<div class="form-group">
  <label for="status"> حالة الآلة </label>
  <input type="text" class="form-control" id="status" name="status"  placeholder=" إدخل حالة الآلة. " value="{{$printingMachine->status or old('status')}}">
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
  @endsection
  @section('js_footer')
  {{-- datePicker --}}
      <script src="{{asset('js/datepicker/jquery-ui.min.js')}}" charset="utf-8"></script>
      <script src="{{asset('js/datepicker/sys.js')}}" charset="utf-8"></script>
  {{-- datePicker --}}
  @endsection
