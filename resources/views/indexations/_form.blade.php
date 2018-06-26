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

<div class="form-group">
    <label for="visit_id"> رقم الزيارة <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="visit_id" data-live-search="true">
        <?php $selectedVist = isset($indexation->visit_id)? $indexation->visit_id:'' ;?>
        <option value=""> اختر رقم الزيارة.  </option>
        @foreach ($visitsIds as $id => $visitIdentifier)
            <option value="{{$id}}" {{($selectedVist == $id)? 'selected' : ((old('visit_id')==$id)?'selected':( (isset($visitIdFromPrintingMachine))?(($visitIdFromPrintingMachine == $id)?('selected'):('')):('') ))}}> {{$visitIdentifier}} </option>
        @endforeach
    </select>
</div>



<div class="panel panel-info">
    <div class="panel-body">
        <h2> إضافة قطع الآلة للمقايسة </h2>
        <div class="panel panel-default">
            <div class="panel-body">
                <h3> البحث عن القطع </h3>
                <hr>
                <div class="form-group form-inline">
                    <label for=""> ادخل اسم القطعة </label>
                    <input type="text" class="form-control" id="search-input" placeholder="">
                    <button type="button" class="btn btn-primary" id="search-button"> بحث </button>
                </div>

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
                <h3> القطع المختارة </h3>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> اسم القطعة </th>
                                <th> الرقم المسلسل للقطعة </th>
                                <th> العدد </th>
                                <th> السعر القطعة </th>
                                <th> نسبة الخصم على القطعة الواحدة </th>
                                <th> حذف </th>
                            </tr>
                        </thead>
                        <tbody id="selected-parts-table-body">

                            @if(old('parts_ids'))
                                @for ($i = 0; $i < count(old('parts_ids')); $i++)

                                    <tr>
                                        <td>
                                            {{old('parts_names')[$i]}}
                                            <input type='hidden' name='parts_names[]' value='{{old('parts_names')[$i]}}'>
                                        </td>
                                        <td>
                                            <div class='input-group'>
                                                <input type='text' class='form-control' placeholder=' ادخل الرقم المسلسل للقطعة ' name='parts_serial_numbers[]' value="{{old('parts_serial_numbers')[$i]}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class='input-group'>
                                                <input type='text' class='form-control' placeholder=' ادخل عدد القطع ' name='parts_count[]' value="{{old('parts_count')[$i]}}">
                                                <input type='hidden' class='form-control' name='parts_ids[]' value="{{old('parts_ids')[$i]}}">
                                            </div>
                                        </td>
                                        <td>
                                            <input type='text' class='form-control' name='parts_prices[]' readonly value="{{old('parts_prices')[$i]}}">
                                        </td>
                                        <td>
                                            <input type='text' class='form-control' name='discount_rate[]' value="{{old('discount_rate')[$i]}}" placeholder='إدخل نسبة الخصم إن وجدت'>
                                        </td>
                                        <td>
                                            <button type='button' class='btn btn-danger btn-xs delete-part-button'> حذف </button>
                                        </td>
                                    </tr>
                                @endfor
                            @elseif(isset($parts))
                                @foreach ($parts as $i => $part)

                                    <tr>
                                        <td>
                                            {{$part->name}}
                                            <input type='hidden' name='parts_names[]' value='{{$part->name}}'>
                                        </td>
                                        <td>
                                            <div class='input-group'>
                                                <input type='text' class='form-control' placeholder=' ادخل الرقم المسلسل للقطعة ' name='parts_serial_numbers[]' value="{{$part->pivot->serial_number or ''}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class='input-group'>
                                                <input type='text' class='form-control' placeholder=' ادخل عدد القطع ' name='parts_count[]' value="{{$part->pivot->number_of_parts or 1}}">
                                                <input type='hidden' class='form-control' name='parts_ids[]' value="{{$part->id or ''}}">
                                            </div>
                                        </td>
                                        <td>
                                            <input type='text' class='form-control' name='parts_prices[]' readonly value="{{$part->pivot->price or ''}}">
                                        </td>
                                        <td>
                                            <input type='text' class='form-control' name='discount_rate[]' value="{{$part->pivot->discount_rate or ''}}" placeholder='إدخل نسبة الخصم إن وجدت'>
                                        </td>
                                        <td>
                                            <button type='button' class='btn btn-danger btn-xs delete-part-button'> حذف </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

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
                    <span class="glyphicon glyphicon-file" style="color:#7E8487"></span><small><a href="{{url('images/project_images/'.$imgFile->name)}}" target="_blank">{{$imgKey+1}}.ملف المقايسة  </a> </small>
                    <a role="button" href="{{action('IndexationController@removeIndexationFile', ['id'=>$imgFile->id])}}" class="btn btn-danger btn-xs">
                        حذف ملف المقايسة من إمتداد JPG, JPEG
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
                                resultTableBody.append("<tr><td>"+part.name+"</td><td><button type='button' class='btn btn-success btn-xs part-add-button' data-part-id='"+part.id+"' data-part-name='"+part.name+" ' data-part-price='"+part.price_with_tax+"' '> اضف </button></td></tr>");
                            });

                            $(".part-add-button").on("click", function(){
                                var addButton = $(this);
                                $("#selected-parts-table-body").append("<tr><td>"+addButton.attr('data-part-name')+"<input type='hidden' name='parts_names[]' value='"+addButton.attr('data-part-name')+"'></td><td><div class='input-group'><input type='text' class='form-control' placeholder=' ادخل الرقم المسلسل للقطعة ' name='parts_serial_numbers[]'></div></td><td><div class='input-group'><input type='text' class='form-control' placeholder=' ادخل عدد القطع ' name='parts_count[]' value='1'><input type='hidden' class='form-control' name='parts_ids[]' value='"+addButton.attr('data-part-id')+"'></div></td><td><input type='text' class='form-control' name='parts_prices[]' readonly value='"+addButton.attr('data-part-price')+"'></td><td><input type='text' class='form-control' name='discount_rate[]' placeholder='إدخل نسبة الخصم إن وجدت'></td><td><button type='button' class='btn btn-danger btn-xs delete-part-button'> حذف </button></td></tr>");
                                addButton.parent().parent().fadeOut('500', 'linear', function(){$(this).remove()});




                                $('.delete-part-button').on('click', function(){
                                    $(this).parent().parent().fadeOut('500', 'linear', function(){$(this).remove()});
                                });
                            });


                        }
                    }
                });
            }
        });
        $('.delete-part-button').on('click', function(){
            $(this).parent().parent().fadeOut('500', 'linear', function(){$(this).remove()});
        });


    });
</script>
@endsection
