<div class="jumbotron">
    <div class="form-group">
            <label for="type">
                نوع المقايسة
                <span style="color:red">*</span>
            </label>
        <select class="form-control" name="type" id="indexation-_form-select-type">
            <?php $indexationType = isset($indexation->type)? $indexation->type:'';?>
            <option value="">
                اختر نوع المقايسة
            </option>
            <option value="تليفونية" {{($indexationType == 'تليفونية')? 'selected' : ((old('type')=='تليفونية')?'selected':'')}}>
                تليفونية
            </option>

            <option value="زيارة" {{(($indexationType == 'زيارة')?('selected'):((old('type')=='زيارة')?('selected'):((isset($type))?(($type =='زيارة')?('selected'):('')):(''))))}}>
                زيارة
            </option>
        </select>
    </div>

    <div class="form-group" id="indexation-_form-form-group-visit-id">
        <label for="indexation-_form-select-visit-id"> رقم الزيارة <span style="color:red">*</span></label>
        <select class="form-control selectpicker" name="visit_id" data-live-search="true" id="indexation-_form-select-visit-id">
            <?php $selectedVist = isset($indexation->visit_id)? $indexation->visit_id:'' ;?>
            <option value=""> اختر رقم الزيارة.  </option>
            @foreach ($visitsIds as $id => $visitIdentifier)
                <option value="{{$id}}" {{($selectedVist == $id)? 'selected' : ((old('visit_id')==$id)?'selected':( (isset($visitIdFromPrintingMachine))?(($visitIdFromPrintingMachine == $id)?('selected'):('')):('') ))}}> {{$visitIdentifier}} </option>
            @endforeach
        </select>
    </div>


    <div class="form-gruop" id="indexation-_form-form-group-printing-machine-id">
        <label for="">
            اختيار الآلة التصوير الخاصة بهذة المقايسة<span style="color:red">*</span>
        </label>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group form-inline">
                    <label for="indexation-_form-printing-machine-search-field">  البحث عن الآلة التصوير:  </label>
                    <input type="text" class="form-control" id="indexation-_form-printing-machine-search-field" name="printing_machine_search_field" placeholder=" إدخل الكلمة المراد البحث عنها. " value="{{isset($indexation->printingMachine)? isset($indexation->printingMachine->customer)?$indexation->printingMachine->customer->name:'':'' }}">
                    <button type="button" class="btn btn-default" id="indexation-_form-printing-machine-search-btn"> ابحث </button>
                    <spna id="indexation-_form-printing-machine-search-p">  </spna>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> كود الآلة </th>
                                <th> اسم العميل </th>
                                <th> اختيار </th>
                            </tr>
                        </thead>
                        <tbody  id="indexation-_form-select-pm-results-table-body">
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="printing-machine-id"> كود الربط الخاص بالآلة التصوير:  </label>
                    <p>
                        يتم تعين قيمة هذا الكود بعد البحث والضغط على زر اختيار الآلة.
                    </p>
                    <input type="text" class="form-control" id="indexation-_form-input-printing-machine-id" name="printing_machine_id"  value="{{(isset($indexation->printing_machine_id))?($indexation->printing_machine_id):((old('printing_machine_id'))?(old('printing_machine_id')):((isset($printingMachineId))?($printingMachineId):('')))}}" readonly>
                </div>
            </div>
        </div>
    </div>
    
</div>
