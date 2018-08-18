<div class="form-group">
    <label for="the_date"> التاريخ  <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="datepicker" name="the_date"  placeholder=" اختر التاريخ. " value="{{$indexation->the_date or old('the_date')}}">
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

@include('indexations.form_sections.type')

@include('indexations.form_sections.parts')

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$indexation->comments or old('comments')}}</textarea>
</div>

<div class="upload_files_pdf_input_fields_wrap_1 panel panel-body panel-info">
    <div class="form-group">
        <label for="upload_files_pdf"> رفع الملفات التي بإمتداد pdf.</label>
        <input type="file" class="form-control" id="upload_files_pdf" name="upload_files_pdf[]">
        <button class="upload_files_pdf_add_field_button_1 btn btn-xs btn-success" role="button"> إضافة ملف آخر </button>
    </div>
    @if (isset($indexation->softCopies) && $indexation->softCopies->isNotEmpty())
        @foreach( $indexation->softCopies as $pdfKey=>$pdfFile)
            @if($pdfFile->type == "pdf")
                <div class="breadcrumb">
                    <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small><a href="{{url('images/project_images/'.$pdfFile->name)}}" target="_blank">{{$pdfKey+1}}.ملف المقايسة  </a> </small>
                    <a role="button" href="{{action('IndexationController@removeIndexationFile', ['id'=>$pdfFile->id])}}" class="btn btn-danger btn-xs">
                        حذف ملف المقايسة من إمتداد pdf
                    </a>
                </div>
            @endif
        @endforeach
    @endif
</div>

<div class="upload_files_img_input_fields_wrap_1 panel panel-body panel-info">
    <div class="form-group">
        <label for="upload_files_img"> رفع الملفات التي بإمتداد JPG, JPEG "صورة"</label>
        <input type="file" class="form-control" id="upload_files_img" name="upload_files_img[]">
        <button class="upload_files_img_add_field_button_1 btn btn-xs btn-success" role="button"> إضافة ملف آخر </button>
    </div>
    @if (isset($indexation->softCopies) && $indexation->softCopies->isNotEmpty())
        @foreach( $indexation->softCopies as $imgKey=>$imgFile)
            @if($imgFile->type == "img")
                <div class="breadcrumb">
                    <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small><a href="{{url('images/project_images/'.$imgFile->name)}}" target="_blank">{{$imgKey+1}}.ملف المقايسة  <img src="{{url('images/project_images/'.$imgFile->name)}}" width="300px"></a> </small>
                    <a role="button" href="{{action('IndexationController@removeIndexationFile', ['id'=>$imgFile->id])}}" class="btn btn-danger btn-xs">
                        حذف الصورة
                    </a>
                </div>
            @endif
        @endforeach
    @endif
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


 <!-- changing between type -->
<script type="text/javascript">
$(function(){
    //type
    indexationFormSelectType = $("#indexation-_form-select-type");
    //visit
    indexationFormFormGroupVisitId = $("#indexation-_form-form-group-visit-id");
    indexationFormSelectVisitId = $("#indexation-_form-select-visit-id");
    //printing machine
    indexationFormFormGroupPrintingMachineId = $("#indexation-_form-form-group-printing-machine-id");
    indexationFormInputPrintingMachineId = $("#indexation-_form-input-printing-machine-id");
    

    if (indexationFormSelectType.val() == 'تليفونية') {
        indexationFormFormGroupPrintingMachineId.css('display', 'block');
        $("#indexation-_form-select-visit-id option:selected").prop("selected", false);
        $("#indexation-_form-select-visit-id").selectpicker("refresh");
        indexationFormFormGroupVisitId.css('display', 'none');
    } else if (indexationFormSelectType.val() == 'زيارة'){
        indexationFormFormGroupPrintingMachineId.css('display', 'none');
        indexationFormFormGroupVisitId.css('display', 'block');
        indexationFormInputPrintingMachineId.val("");
    } else{
        indexationFormFormGroupPrintingMachineId.css('display', 'none');
        indexationFormFormGroupVisitId.css('display', 'none');
        
    }
        
    indexationFormSelectType.on('change', function(){

        if (this.value == 'تليفونية') {
            indexationFormFormGroupPrintingMachineId.css('display', 'block');
            $("#indexation-_form-select-visit-id option:selected").prop("selected", false);
            $("#indexation-_form-select-visit-id").selectpicker("refresh");
            indexationFormFormGroupVisitId.css('display', 'none');
        } else if (this.value == 'زيارة'){
            indexationFormFormGroupPrintingMachineId.css('display', 'none');
            indexationFormFormGroupVisitId.css('display', 'block');
            indexationFormInputPrintingMachineId.val("");
        }
    });
});
</script>
<!-- selecting printing machine ajax -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#indexation-_form-printing-machine-search-btn").on("click", function(){
            var keyword = $("#indexation-_form-printing-machine-search-field").val();
            $("#indexation-_form-printing-machine-search-p").text("");
            $("#indexation-_form-select-pm-results-table-body ").children().remove();
            var resultsTableBody = '';
            if(keyword){
                $.ajax({
                    type:"GET",
                    url:"/indexation_pm_ajax_search/"+keyword,
                    dataType:"json",
                    success:function(results){
                        $.each(results, function(key, machine){
                            resultsTableBody += "<tr><td>"+machine.code+"</td><td>"+((machine.customer)?machine.customer.name:'')+"</td><td><button type='button' class='btn btn-success btn-xs indexation-_form-select-printing-machine' data-printing-machine-id='"+machine.id+"' data-printing-machine-code='"+machine.code+"'> اختيار هذة الآلة </button></td></tr>";
                        });
                        $("#indexation-_form-select-pm-results-table-body").append(resultsTableBody);
                        $(".indexation-_form-select-printing-machine").on("click", function(){
                            printingMachineCode = $(this).attr('data-printing-machine-code');
                            printingMachineId = $(this).attr('data-printing-machine-id');
                            $("#indexation-_form-input-printing-machine-id").val(printingMachineId);
                        });
                    },
                });
            }else{
                $("#indexation-_form-printing-machine-search-p").text(" برجاء إدخال قيمة ").css('color','red');
            }
        });
    });
</script>


<!-- parts statement ajax -->
<script type="text/javascript">
    $(document).ready(function(){

        $("#search-button").on('click', function(){
            var keyword = $('#search-input').val();

            if (keyword) {
                $.ajax({
                    type:"GET",
                    url:"{{url('indexation_form_part_search')}}/"+keyword,
                    dataType:"JSON",
                    success:function(results){
                        if (results) {
                            var resultTableBody = $('#results-table-body').empty();
                            $.each(results, function(key, part){
                                resultTableBody.append("<tr><td>"+part.name+"</td><td>"+part.descriptions+"</td><td><button type='button' class='btn btn-success btn-xs part-add-button' data-part-id='"+part.id+"' data-part-name='"+part.name+"' data-part-price-without-tax='"+part.price_without_tax+"' data-part-price-with-tax='"+part.price_with_tax+"' data-part-description='"+part.descriptions+"'> اضف </button></td></tr>");
                            });

                            $(".part-add-button").on("click", function(){
                                var addButton = $(this);
                                $("#selected-parts-table-body").append("<tr><td>"+addButton.attr('data-part-name')+"<input type='hidden' name='parts_names[]' value='"+addButton.attr('data-part-name')+"' ></td><td><div class='input-group'><input type='text' class='form-control' placeholder=' ادخل الرقم المسلسل للقطعة ' name='parts_serial_numbers[]'></div></td><td><div class='input-group'><input type='text' class='form-control' placeholder='ادخل وصف القطعة' name='parts_descriptions[]' value='"+addButton.attr('data-part-description')+"'></div></td><td><div class='input-group'><input type='number' class='form-control' placeholder=' ادخل عدد القطع ' name='parts_count[]' value='1'><input type='hidden' class='form-control' name='parts_ids[]' value='"+addButton.attr('data-part-id')+"'></div></td><td><div class='input-group'><input type='number' class='form-control' placeholder='ادخل سعر القطعة بدون الضريبة' name='parts_prices_without_tax[]' value='"+addButton.attr('data-part-price-without-tax')+"'></div></td><td><div class='input-group'><input type='number' class='form-control' placeholder='ادخل سعر القطعة بالضريبة' name='parts_prices[]' value='"+addButton.attr('data-part-price-with-tax ')+"'></div></td><td><div class='input-group'><input type='number' class='form-control' name='discount_rate[]' placeholder='إدخل نسبة الخصم إن وجدت'></div></td><td><div class='input-group'><button type='button' class='btn btn-danger btn-xs delete-part-button'> حذف </button></div></td></tr>");
                                addButton.parent().parent().fadeOut('500', 'linear', function(){$(this).remove()});




                                $('.delete-part-button').on('click', function(){
                                    $(this).parent().parent().parent().fadeOut('500', 'linear', function(){$(this).remove()});
                                });
                            });


                        }
                    }
                });
            }
        });
        $('.delete-part-button').on('click', function(){
            $(this).parent().parent().parent().fadeOut('500', 'linear', function(){$(this).remove()});
        });


    });
</script>
@endsection
