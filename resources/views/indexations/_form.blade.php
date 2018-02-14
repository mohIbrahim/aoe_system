<div class="panel panel-primary">
    <div class="panel-body">

        <div class="form-group form-inline">
            <label for=""> ابحث عن القطعة </label>
            <input type="text" class="form-control" id="search-input" placeholder="">
            <button type="button" class="btn btn-primary" id="search-button"> بحث </button>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> اسم القطعة </th>
                                <th> اضافة </th>
                            </tr>
                        </thead>
                        <tbody id="results-table-body">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> اسم القطعة </th>
                                <th> العداد </th>
                                <th> السعر القطعة </th>
                                <th> حذف </th>
                            </tr>
                        </thead>
                        <tbody id="selected-parts-table-body">
                            <tr>
                                <td>1</td>
                                <td> zzzdfasdf </td>

                                <td><div class='input-group'><input type='text' class='form-control' placeholder=' ادخل عدد القطع ' name='part_count[]'></div><input type='hidden' class='form-control' placeholder=' ادخل عدد القطع ' name='part_id[]'></div></td><td>price</td><td><button   type='button' class='btn btn-danger btn-xs'> حذف </button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>


<div class="form-group">
    <label for="code"> كود المقايسة <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="code" name="code"  placeholder=" إدخل كود المقايسة. " value="{{$indexation->code or old('code')}}">
</div>

<div class="form-group">
    <label for="the_date"> التاريخ  <span style="color:red">*</span></label>
    <input type="text" class="form-control datepicker" id="datepicker" name="the_date"  placeholder=" اختر التاريخ. " value="{{$indexation->the_date or old('the_date')}}">
</div>

<div class="form-group">
    <label for="customer_approval"> موافقة العميل </label>
    <select class="form-control" name="customer_approval">
        <?php $indexationCustomerApproval = isset($indexation->customer_approval)? $indexation->customer_approval:'' ;?>
        <option value="">  اختر موافقة العميل.  </option>
        <option value="موافق" {{($indexationCustomerApproval == 'موافق')? 'selected' : ((old('customer_approval')=='موافق')?'selected':'')}}> موافق </option>
        <option value="غير موافق" {{($indexationCustomerApproval == 'غير موافق')? 'selected' : ((old('customer_approval')=='غير موافق')?'selected':'')}}> غير موافق </option>
        <option value="ليس بعد" {{($indexationCustomerApproval == 'ليس بعد')? 'selected' : ((old('customer_approval')=='ليس بعد')?'selected':'')}}> ليس بعد </option>
    </select>
</div>

<div class="form-group">
    <label for="technical_manager_approval"> موافقة مدير الأقسام الفنية </label>
    <select class="form-control" name="technical_manager_approval">
        <?php $indexationTechnicalManagerApprovel = isset($indexation->technical_manager_approval)? $indexation->technical_manager_approval:'' ;?>
        <option value="">  اختر موافقة مدير الأقسام الفنية.  </option>
        <option value="موافق" {{($indexationTechnicalManagerApprovel == 'موافق')? 'selected' : ((old('technical_manager_approval')=='موافق')?'selected':'')}}> موافق </option>
        <option value="غير موافق" {{($indexationTechnicalManagerApprovel == 'غير موافق')? 'selected' : ((old('technical_manager_approval')=='غير موافق')?'selected':'')}}> غير موافق </option>
        <option value="ليس بعد" {{($indexationTechnicalManagerApprovel == 'ليس بعد')? 'selected' : ((old('technical_manager_approval')=='ليس بعد')?'selected':'')}}> ليس بعد </option>
    </select>
</div>

<div class="form-group">
    <label for="warehouse_approval"> موافقة المخازن </label>
    <select class="form-control" name="warehouse_approval">
        <?php $indexationWarehouseApprovel = isset($indexation->warehouse_approval)? $indexation->warehouse_approval:'' ;?>
        <option value="">  اختر موافقة المخازن.  </option>
        <option value="موافق" {{($indexationWarehouseApprovel == 'موافق')? 'selected' : ((old('warehouse_approval')=='موافق')?'selected':'')}}> موافق </option>
        <option value="غير موافق" {{($indexationWarehouseApprovel == 'غير موافق')? 'selected' : ((old('warehouse_approval')=='غير موافق')?'selected':'')}}> غير موافق </option>
        <option value="ليس بعد" {{($indexationWarehouseApprovel == 'ليس بعد')? 'selected' : ((old('warehouse_approval')=='ليس بعد')?'selected':'')}}> ليس بعد </option>
    </select>
</div>

<div class="form-group">
    <label for="reference_id"> كود الإشارة </label>
    <select class="form-control selectpicker" name="reference_id" data-live-search="true">
        <?php $selectedReferenceId = isset($indexation->reference_id)? $indexation->reference_id:'' ;?>
        <option value=""> اختر كود الإشارة التي قمت بسببها بإجراء هذة المقايسة.  </option>
        @foreach ($referencesIds as $id => $referenceCode)
            <option value="{{$id}}" {{($selectedReferenceId == $id)? 'selected' : ((old('reference_id')==$id)?'selected':'')}}> {{$referenceCode}} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="visit_id"> رقم الزيارة <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="visit_id" data-live-search="true">
        <?php $selectedVist = isset($indexation->visit_id)? $indexation->visit_id:'' ;?>
        <option value=""> اختر رقم الزيارة.  </option>
        @foreach ($visitsIds as $id => $visitIdentifier)
            <option value="{{$id}}" {{($selectedVist == $id)? 'selected' : ((old('visit_id')==$id)?'selected':'')}}> {{$visitIdentifier}} </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="indexation_as_pdf"> صورة المقايسة بأمتداد PDF </label>
    <input type="file" class="form-control" id="indexation_as_pdf" name="indexation_as_pdf">
        @if (isset($indexation->softCopies) && $indexation->softCopies->isNotEmpty())
            <div class="breadcrumb">
                <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small> حذف ملف المقايسة </small>
                <a role="button" href="{{action('IndexationController@removeIndexationFile', ['id'=>$indexation->softCopies->first()->id])}}" class="btn btn-danger btn-xs">
                    Delete
                </a>
            </div>
        @endif
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$indexation->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
@section('head')
{{-- datePicker --}}
    <link rel="stylesheet" href="{{asset('css/datepicker/jquery-ui.min.css')}}">
{{-- datePicker --}}
{{-- bootstrap-select --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap-select/bootstrap-select.min.css')}}">
{{-- bootstrap-select --}}
@endsection
@section('js_footer')
{{-- datePicker --}}
    <script src="{{asset('js/datepicker/jquery-ui.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/datepicker/sys.js')}}" charset="utf-8"></script>
{{-- datePicker --}}
{{-- bootstrap-select --}}
    <script src="{{asset('js/bootstrap-select/bootstrap-select.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/bootstrap-select/sys.js')}}" charset="utf-8"></script>
{{-- bootstrap-select --}}

<script type="text/javascript">
    $(document).ready(function(){
        $("#search-button").on('click', function(){
            var keyword = $('#search-input').val();
            var selectedPartsTableIndex = 1;
            if (keyword) {
                $.ajax({
                    type:"GET",
                    url:"{{url('indexation_form_part_search')}}/"+keyword,
                    dataType:"JSON",
                    success:function(results){
                        if (results) {
                            var resultTableBody = $('#results-table-body').empty();
                            $.each(results, function(key, part){
                                resultTableBody.append("<tr><td>"+part.name+"</td><td><button type='button' class='btn btn-success btn-xs part-add-button' data-part-id='"+part.id+"' data-part-name='"+part.name+" data-part-price='"+part.price_with_tax+"' '> اضف </button></td></tr>");
                            });
                            $(".part-add-button").on("click", function(){
                                var addButton = $(".part-add-button");
                                $("#selected-parts-table-body").append("<tr><td>"+selectedPartsTableIndex+"</td><td>"+addButton.attr('data-part-name')+"</td></tr>");
                                selectedPartsTableIndex++;
                            });
                        }
                    }
                });
            }
        });



    });
</script>
@endsection
