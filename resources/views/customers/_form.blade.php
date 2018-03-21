<div class="form-group">
    <label for="code"> كود العميل <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود العميل. " value="{{$customer->code or old('code')}}">
</div>

<div class="form-group">
    <label for="main_branch_id"> اسم الفرع الرئيسي </label>
    <p style="color:red; font-size:.9em">
        في حالة إدخال هذا العميل على انه فرع، نقوم باختيار الفرع الرئيسي التابع له.
    </p>
    <select class="form-control selectpicker" name="main_branch_id" data-live-search="true">
        <?php $selectedMainBranchId = isset($customer->main_branch_id)? $customer->main_branch_id:'' ;?>
        <option value=""> اختر اسم الفرع الرئيسي لهذا الفرع.  </option>
        @foreach ($customersIdsNames as $customerId => $customerName)
            <option value="{{$customerId}}" {{($selectedMainBranchId == $customerId)? 'selected' : ((old('main_branch_id')==$customerId)?'selected':'')}}> {{$customerName}} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="name"> اسم العميل <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="name" name="name"  placeholder=" إدخل اسم العميل. " value="{{$customer->name or old('name')}}">
</div>

<div class="form-group">
    <label for="type"> نوع العميل <span style="color:red">*</span></label>
    <select class="form-control" name="type">
        <?php $customerType = isset($customer->type)? $customer->type:'' ;?>
        <option value="">  اختر نوع العميل.  </option>
        <option value="أفراد" {{($customerType == 'أفراد')? 'selected' : ((old('type')=='أفراد')?'selected':'')}}> أفراد </option>
        <option value="شركات" {{($customerType == 'شركات')? 'selected' : ((old('type')=='شركات')?'selected':'')}}> شركات </option>
        <option value="هيئات حكومية" {{($customerType == 'هيئات حكومية')? 'selected' : ((old('type')=='هيئات حكومية')?'selected':'')}}> هيئات حكومية </option>
        <option value="مدارس" {{($customerType == 'مدارس')? 'selected' : ((old('type')=='مدارس')?'selected':'')}}> مدارس </option>
        <option value="مستشفيات" {{($customerType == 'مستشفيات')? 'selected' : ((old('type')=='مستشفيات')?'selected':'')}}> مستشفيات </option>
        <option value="بنوك" {{($customerType == 'بنوك')? 'selected' : ((old('type')=='بنوك')?'selected':'')}}> بنوك </option>
    </select>
</div>

<div class="input_fields_wrap_1">
    <div class="form-group">
        <label for="telecom"> التليفون <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="telecom" name="telecom[]"  placeholder=" إدخل التليفون. " value="{{isset($customer)? $customer->telecoms->first()->number : old('telecom')[0]}}">
        <button class="add_field_button_1 btn btn-xs btn-success" role="button"> إنشاء أرقام آخرى </button>
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
			@if($k != 0)
				<div class="form-group">
				    <input type="text" name="telecom[]" class="form-control" placeholder=" إدخل رقم آخر. " value="{{$telecom->number}}"/>
					<a href="#" class="remove_field btn btn-xs btn-danger">حذف</a>
				</div>
			@endif
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
    <input type="text" class="form-control" id="administration" name="administration"  placeholder=" إدخل الإدارة. " value="{{$customer->administration or old('administration')}}">
</div>

<div class="form-group">
    <label for="department"> القسم </label>
    <input type="text" class="form-control" id="department" name="department"  placeholder=" إدخل القسم. " value="{{$customer->department or old('department')}}">
</div>

<div class="form-group">
    <label for="address"> العنوان </label>
    <p><small> رقم العقار واسم الشارع. </small></p>
    <input type="text" class="form-control" id="address" name="address"  placeholder=" إدخل العنوان. " value="{{$customer->address or old('address')}}">
</div>

<div class="form-group">
    <label for="area"> المنطقة </label>
    <input type="text" class="form-control" id="area" name="area"  placeholder="  إدخل المنطقة. " value="{{$customer->area or old('area')}}">
</div>

<div class="form-group">
    <label for="district"> الحي </label>
    <input type="text" class="form-control" id="district" name="district"  placeholder=" إدخل الحي. " value="{{$customer->district or old('district')}}">
</div>

<div class="form-group">
    <label for="city"> المدينة </label>
    <select class="form-control selectpicker" name="city" data-live-search="true">
        <?php $selectedCity = isset($customer->city)? $customer->city: '' ?>
        <option value=""> اختر المدينة. </option>
        @foreach($egyptCities as $egyptCity)
            <option value="{{$egyptCity}}" {{($selectedCity == $egyptCity)? ('selected'):((old('city')==$egyptCity)?'selected':'')}} >{{$egyptCity}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="governorate"> المحافظة </label>
    <select class="form-control selectpicker" name="governorate" data-live-search="true">
        <?php $selectedGovernorate = isset($customer->governorate)? $customer->governorate: '' ?>
        <option value=""> اختر المحافظة. </option>
        @foreach($egyptGovernorate as $governorate)
            <option value="{{$governorate}}" {{($selectedGovernorate == $governorate)? ('selected'):((old('governorate')==$governorate)?'selected':'')}} >{{$governorate}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="responsible_person_name"> اسم الشخص المسؤول عن الآلة </label>
    <input type="text" class="form-control" id="responsible_person_name" name="responsible_person_name"  placeholder=" إدخل اسم الشخص المسؤول عن الآلة. " value="{{$customer->responsible_person_name or old('responsible_person_name')}}">
</div>

<div class="form-group">
    <label for="responsible_person_phone"> رقم تليفون الشخص المسؤول عن الآلة </label>
    <input type="text" class="form-control" id="responsible_person_phone" name="responsible_person_phone"  placeholder=" إدخل رقم تليفون الشخص المسؤول عن الآلة. " value="{{$customer->responsible_person_phone or old('responsible_person_phone')}}">
</div>

<div class="form-group">
    <label for="responsible_person_email"> البريد الإلكتروني للشخص المسؤول عن الآلة </label>
    <input type="text" class="form-control" id="responsible_person_email" name="responsible_person_email"  placeholder=" إدخل البريد الإلكتروني للشخص المسؤول عن الآلة. " value="{{$customer->responsible_person_email or old('responsible_person_email')}}">
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title"> بيانات قسم الحسابات الخاص بالعميل </h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
		    <label for="accounts_dep_emp_name"> اسم الموظف المسؤول </label>
		    <input type="text" class="form-control" id="accounts_dep_emp_name" name="accounts_dep_emp_name"  placeholder=" إدخل اسم الشخص المسؤول في قسم الحسابات. " value="{{$customer->accounts_dep_emp_name or old('accounts_dep_emp_name')}}">
		</div>

		<div class="form-group">
		    <label for="accounts_dep_emp_phone"> رقم التليفون </label>
		    <input type="text" class="form-control" id="accounts_dep_emp_phone" name="accounts_dep_emp_phone"  placeholder=" إدخل رقم تليفون الخاص بقسم الحسابات. " value="{{$customer->accounts_dep_emp_phone or old('accounts_dep_emp_phone')}}">
		</div>

		<div class="form-group">
		    <label for="accounts_dep_emp_email"> البريد الإلكتروني </label>
		    <input type="text" class="form-control" id="accounts_dep_emp_email" name="accounts_dep_emp_email"  placeholder=" إدخل البريد الإلكتروني الخاص بقسم الحسابات. " value="{{$customer->accounts_dep_emp_email or old('accounts_dep_emp_email')}}">
		</div>
	</div>
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$customer->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
@section('head')
    {{-- bootstrap-select --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap-select/bootstrap-select.min.css')}}">
@endsection
@section('js_footer')
    {{-- bootstrap-select --}}
    <script src="{{asset('js/bootstrap-select/bootstrap-select.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/bootstrap-select/sys.js')}}" charset="utf-8"></script>
@endsection
