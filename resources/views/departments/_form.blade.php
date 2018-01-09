<div class="form-group">
    <label for="name"> اسم القسم <span style="color:red">*</span></label>
    <input type="text" class="form-control" id="name" name="name"  placeholder=" إدخل اسم القسم. " value="{{$department->name or old('name')}}">
</div>

<div class="form-group">
    <label for="comments"> التعليقات </label>
    <textarea name="comments" class="form-control" placeholder=" إدخل تعليقاً. ">{{$department->comments or old('comments')}}</textarea>
</div>

<button type="submit" class="btn btn-primary btn-lg center-block" >
    حفظ
</button>
