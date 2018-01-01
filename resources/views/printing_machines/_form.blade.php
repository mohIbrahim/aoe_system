<div class="form-group">
  <label for="folder_number"> رقم الملف الآلة </label>
  <input type="text" class="form-control" id="folder_number" name="folder_number"  placeholder=" إدخل رقم ملف الآلة. " value="{{$printingMachine->folder_number or old('folder_number')}}">
</div>

<div class="form-group">
  <label for="code">كود الآلة</label>
  <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل الكود الخاص بالآلة. ">
</div>

<div class="form-group">
  <label for="the_manufacture_company"> اسم الشركة المصنعة للآلة </label>
  <input type="text" class="form-control" id="the_manufacture_company" name="the_manufacture_company"  placeholder=" إدخال اسم الشركة المصنعة للآلة. ">
</div>

<div class="form-group">
  <label for="model_prefix"> الموديل الجزء الأول </label>
  <input type="text" class="form-control" id="model_prefix" name="model_prefix"  placeholder="  إدخل موديل الآلة الجزء الأول. ">
  <p> مثل SF AR JP DX DR ... </p>
</div>

<div class="form-group">
  <label for="model_suffix"> الموديل الجزء الثاني </label>
  <input type="text" class="form-control" id="model_suffix" name="model_suffix"  placeholder=" إدخل موديل الآلة الجزء الثاني. ">
  <p> مثل 6026N, 564N ... </p>
</div>

<div class="form-group">
  <label for="serial_number"> Serial Number </label>
  <input type="text" class="form-control" id="serial_number" name="serial_number"  placeholder=" إدخل ال serial number. ">
</div>

<div class="form-group">
  <label for="product_key"> Product Key </label>
  <input type="text" class="form-control" id="product_key" name="product_key"  placeholder=" إدخل ال product key. ">
</div>

<div class="form-group">
  <label for="manufacturing_year"> سنة التصنيع </label>
  <input type="text" class="form-control" id="manufacturing_year" name="manufacturing_year"  placeholder=" إدخل سنة التصنيع. ">
</div>

<div class="form-group">
  <label for="price_without_tax"> سعر الآلة عند البيع بدون ضريبة </label>
  <input type="text" class="form-control" id="price_without_tax" name="price_without_tax"  placeholder=" إدخل السعر بدون ضريبة. ">
</div>


<div class="form-group">
  <label for="price_with_tax">  سعر الآلة عند البيع بالضريبة </label>
  <input type="text" class="form-control" id="price_with_tax" name="price_with_tax"  placeholder=" إدخل السعر بالضريبة. ">
</div>

<div class="form-group">
  <label> هل هذة الآلة تم بيعها عن طريق الشركة العربية؟ </label><br>

  <label for="solid_by_aoe_yes"> نعم </label>
  <input type="radio" class="" id="solid_by_aoe_yes" name="solid_by_aoe" value="1"><br>
  <label for="solid_by_aoe_no"> لا </label>
  <input type="radio" class="" id="solid_by_aoe_no" name="solid_by_aoe" value="0">
</div>

<div class="form-group">
  <label for="comments"> التعليقات </label>
  <textarea name="comments" class="form-control" placeholder=" إدخل تعليقاً. "></textarea>
</div>


  <button type="submit" class="btn btn-primary btn-lg center-block" >
      حفظ
  </button>
