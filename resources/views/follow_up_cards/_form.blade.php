<div class="form-group">
    <label for="code"> كود البطاقة </label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود البطاقة. " value="{{$followUpCard->code or 'يتم تعين الرقم من النظام بعد إنشاء البطاقة.'}}" readonly>
</div>
<div class="form-group">
    <label for="old-code"> رقم البطاقة الورقي </label>
    <input type="text" class="form-control" id="old-code" name="old_code"  placeholder=" إدخل رقم البطاقة الورقي السابق. " value="{{(old('old_code'))?(old('old_code')):((isset($followUpCard->old_code))?($followUpCard->old_code):(''))}}">
</div>

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

<div class="panel panel-default">
        <div class="panel-heading">
            اختيار الآلة التصوير الخاصة بهذة البطاقة<span style="color:red;font-weight:bolder">*</span>
        </div>
    <div class="panel-body">
        <div class="form-group form-inline">
            <label for="follow-up-card-printing-machine-search-field">  البحث عن الآلة التصوير:  </label>
            <input type="text" class="form-control" id="follow-up-card-printing-machine-search-field" name="printing_machine_search_field" placeholder=" إدخل الكلمة المراد البحث عنها. " value="{{isset($followUpCard->printingMachine)? isset($followUpCard->printingMachine->customer)?$followUpCard->printingMachine->customer->name:'':'' }}">
            <button type="button" class="btn btn-default" id="follow-up-card-printing-machine-search-btn"> ابحث </button>
            <spna id="follow-up-card-printing-machine-search-p">  </spna>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th> كود الآلة </th>
                        <th> اسم العميل </th>
                        <th> اختيار </th>
                    </tr>
                </thead>
                <tbody  id="follow-up-card-results-table-body">
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="printing-machine-id"> كود الربط الخاص بالآلة التصوير:  </label>
            <p>
                يتم تعين قيمة هذا الكود بعد البحث والضغط على زر اختيار الآلة.
            </p>
            <input type="text" class="form-control" id="printing-machine-id" name="printing_machine_id"  value="{{(isset($followUpCard->printing_machine_id))?($followUpCard->printing_machine_id):((old('printing_machine_id'))?(old('printing_machine_id')):((isset($printingMachineId))?($printingMachineId):('')))}}" placeholder="لم يتم التعين بعد." readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="follow_up_card_as_pdf"> صورة بطاقة المتابعة بأمتداد PDF </label>
    <input type="file" class="form-control" id="follow_up_card_as_pdf" name="follow_up_card_as_pdf">
        @if (isset($followUpCard->softCopies) && $followUpCard->softCopies->isNotEmpty())
            <div class="breadcrumb">
                <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small> حذف ملف بطاقة المتابعة </small>
                <a role="button" href="{{action('FollowUpCardController@removeFollowUpCardFile', ['id'=>$followUpCard->softCopies->first()->id])}}" class="btn btn-danger btn-xs">
                    Delete
                </a>
            </div>
        @endif
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