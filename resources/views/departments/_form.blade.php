<div class="form-group">
    <label for="name"> اسم القسم <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="name" name="name"  placeholder=" إدخل اسم القسم. " value="{{$department->name or old('name')}}">
</div>

<div class="form-group">
    <label for="manager_id"> اسم مدير القسم <span style="color:red">*</span></label>
    <select class="form-control selectpicker" name="manager_id" data-live-search="true">
        <?php $selectedManager = isset($department->manager_id)? $department->manager_id: '' ?>
        <option value=""> أختر اسم مدير القسم. </option>
        @foreach($employees as $userId=>$userName)
            <option value="{{$userId}}" {{($selectedManager == $userId)? ('selected'):((old('manager_id')==$userId)?'selected':'')}} >{{$userName}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="comments"> الملاحظات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل ملاحظاتك. ">{{$department->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
