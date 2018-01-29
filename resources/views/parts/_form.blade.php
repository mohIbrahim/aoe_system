<div class="form-group">
    <label for="code"> كود القطعة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود القطعة. " value="{{$part->code or old('code')}}">
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
    <label for="model"> الطراز "Model"</label>
    <input type="text" class="form-control" id="model" name="model"  placeholder=" إدخل طراز القطعة. " value="{{$part->model or old('model')}}">
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
    <label for="life"> العمر الافتراضي للقطعة </label>
    <input type="text" class="form-control" id="life" name="life"  placeholder=" إدخل العمر الافتراضي للقطعة. " value="{{$part->life or old('life')}}">
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$part->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
