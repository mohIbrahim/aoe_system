<div class="form-group">
    <label for="contract_id"> رقم العقد <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="contract_id" data-live-search="true">
        <?php $selectedContract = isset($followUpCard->contract_id)? $followUpCard->contract_id: '' ?>
        <option value=""> اختر رقم العقد. </option>
        @foreach($contracts as $contractId=>$contractCode)
            <option value="{{$contractId}}" {{($selectedContract == $contractId)? ('selected'):((old('contract_id')==$contractId)?'selected':'')}} >{{$contractCode}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="code"> كود البطاقة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود البطاقة. " value="{{$followUpCard->code or old('code')}}">
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$followUpCard->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
@section('head')
{{-- bootstrap-select --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap-select/bootstrap-select.min.css')}}">
{{-- bootstrap-select --}}
@endsection
@section('js_footer')
{{-- bootstrap-select --}}
    <script src="{{asset('js/bootstrap-select/bootstrap-select.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/bootstrap-select/sys.js')}}" charset="utf-8"></script>
{{-- bootstrap-select --}}
@endsection
