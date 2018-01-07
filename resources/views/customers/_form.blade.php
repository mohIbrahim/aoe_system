@section('head')
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-select/bootstrap-select.min.css')}}">
@endsection
<div class="form-group">
    <label for="code"> كود العميل <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود العميل. " value="{{$customer->code or old('code')}}">
</div>

<div class="form-group">
    <label for="name"> اسم العميل <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="name" name="name"  placeholder=" إدخل اسم العميل. " value="{{$customer->name or old('name')}}">
</div>

<div class="form-group">
    <label for="type"> نوع العميل <span style="color:red">*</span></label>
    <select class="form-control" name="type">
        <?php $customerType = isset($customer->type)? $customer->type:'' ;?>
        <option value="">  أختر نوع العميل.  </option>
        <option value="أفراد" {{($customerType == 'indeviduals')? 'selected' : ((old('type')=='indeviduals')?'selected':'')}}> أفراد </option>
        <option value="شركات" {{($customerType == 'companies')? 'selected' : ((old('type')=='companies')?'selected':'')}}> شركات </option>
        <option value="هيئات حكومي" {{($customerType == 'government_authorities')? 'selected' : ((old('type')=='government_authorities')?'selected':'')}}> هيئات حكومية </option>
        <option value="مدارس" {{($customerType == 'schooles')? 'selected' : ((old('type')=='schooles')?'selected':'')}}> مدارس </option>
        <option value="مستشفيات" {{($customerType == 'hospitals')? 'selected' : ((old('type')=='hospitals')?'selected':'')}}> مستشفيات </option>
        <option value="بنوك" {{($customerType == 'banks')? 'selected' : ((old('type')=='banks')?'selected':'')}}> بنوك </option>
    </select>
</div>

<div class="input_fields_wrap_1">
    <div class="form-group">
        <label for="telecom"> التليفون </label>
        <input type="text" class="form-control" id="telecom" name="telecom[]"  placeholder=" إدخل التليفون. " value="{{$customer->telecom or old('telecom')[0]}}">
        <button class="add_field_button_1 btn btn-xs btn-success" role="button"> إضافة أرقام آخرى </button>
    </div>
    @if( null !== old('telecom'))
        @foreach (old('telecom') as $s => $oldOne)
            @if($s != 0)
                <div class="form-group">
                    <input type="text" name="telecom[]" class="form-control" placeholder=" إدخل رقم آخر. " value="{{ old('telecom')[$s] }}"/>
                    <a href="#" class="remove_field btn btn-xs btn-danger">حذف</a>
                </div>
            @endif
        @endforeach
    @elseif(isset($customer->telecoms))
        @foreach ($customer->telecoms as $k => $telecom)
            <div class="form-group">
                <input type="text" name="telecom[]" class="form-control" placeholder=" إدخل رقم آخر. " value="{{$telecom->number}}"/>
                <a href="#" class="remove_field btn btn-xs btn-danger">حذف</a>
            </div>
        @endforeach
    @endif
</div>

<div class="form-group">
    <label for="email"> البريد الإلكتروني </label>
    <input type="text" class="form-control" id="email" name="email"  placeholder=" إدخل البريد الإلكتروني. " value="{{$customer->email or old('email')}}">
</div>

<div class="form-group">
    <label for="website"> الموقع الكتروني </label>
    <input type="text" class="form-control" id="website" name="website"  placeholder=" إدخل الموقع الكتروني. " value="{{$customer->website or old('website')}}">
</div>

<div class="form-group">
    <label for="administration"> الإدارة </label>
    <input type="text" class="form-control" id="administration" name="administration"  placeholder=" إدخل الإدارة. " value="{{$customer->administration or old('address')}}">
</div>

<div class="form-group">
    <label for="department"> القسم </label>
    <input type="text" class="form-control" id="department" name="department"  placeholder=" إدخل القسم. " value="{{$customer->department or old('address')}}">
</div>

<div class="form-group">
    <label for="address"> العنوان </label>
    <p><small> رقم العقار واسم الشارع. </small></p>
    <input type="text" class="form-control" id="address" name="address"  placeholder=" إدخل العنوان. " value="{{$customer->address or old('address')}}">
</div>

<div class="form-group">
    <label for="area"> المنطقة </label>
    <input type="text" class="form-control" id="area" name="area"  placeholder="  إدخل المنطقة. " value="{{$customer->area or old('address')}}">
</div>

<div class="form-group">
    <label for="district"> الحي </label>
    <input type="text" class="form-control" id="district" name="district"  placeholder=" إدخل الحي. " value="{{$customer->district or old('address')}}">
</div>

<div class="form-group">
    <label for="city"> المدينة </label>
    <select class="form-control selectpicker" name="city" data-live-search="true">
        <?php $selectedCity = isset($customer->city)? $customer->city: '' ?>
        <option value=""> أختر المدينة. </option>
        @foreach($egyptCities as $egyptCity)
            <option value="{{$egyptCity}}" {{($selectedCity == $egyptCity)? ('selected'):((old('city')==$egyptCity)?'selected':'')}} >{{$egyptCity}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="governorate"> المحافظة </label>
    <select class="form-control selectpicker" name="governorate" data-live-search="true">
        <?php $selectedGovernorate = isset($customer->governorate)? $customer->governorate: '' ?>
        <option value=""> أختر المحافظة. </option>
        @foreach($egyptCities as $egyptCity)
            <option value="{{$egyptCity}}" {{($selectedGovernorate == $egyptCity)? ('selected'):((old('governorate')==$egyptCity)?'selected':'')}} >{{$egyptCity}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="responsible_person_name"> اسم الشخص المسؤول عن الآلة. </label>
    <input type="text" class="form-control" id="responsible_person_name" name="responsible_person_name"  placeholder=" إدخل اسم الشخص المسؤول عن الآلة. " value="{{$customer->responsible_person_name or old('responsible_person_name')}}">
</div>

<div class="form-group">
    <label for="comments"> التعليقات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل تعليقاً. ">{{$customer->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
