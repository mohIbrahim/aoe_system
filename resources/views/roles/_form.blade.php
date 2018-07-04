<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">
                Role Name <span style="color: red;"> +</span>
            </th>
            <th class="text-center">
                Privileges <span style="color: red;"> +</span>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="col-md-2">
                <div class="form-group text-left" style="direction:ltr; text-align:left">
                    <label for="name">Role Name</label>
                    @if((old('name')))
                        <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Role Name.">
                    @else
                        @if(!empty($role->name))
                            <input type="text" id="name" name="name" value="{{$role->name}}" class="form-control" placeholder="Enter Role Name.">
                        @else
                            <input type="text" id="name" name="name" value="" class="form-control" placeholder="Enter Role Name.">
                        @endif
                    @endif
                </div>
            </td>
            <td class="col-md-2">
                @foreach($permissionsGroupedByTitle as $permissionGroupByTitleKey=>$permissionGroupByTitle)
                    
                    <div class="form-group">
                        <h3 class="text-center">{{$permissionGroupByTitleKey}}</h3>
                        @foreach($permissionGroupByTitle as $permissionKey=>$permission)

                            <div class="form-group text-left ltr">
                                <label for="permissions{{$permission->id}}">{{ $permission->name }}</label>
                                @if (in_array($permission->id, (old('permissions'))?(old('permissions')):([])))
                                    <input type="checkbox" id="permissions{{$permission->id}}" name="permissions[]" value="{{$permission->id}}" checked>
                                @else
                                    @if (in_array($permission->id, (isset($selectedPermissionsIds))?($selectedPermissionsIds):([])))
                                        <input type="checkbox" id="permissions{{$permission->id}}" name="permissions[]" value="{{$permission->id}}" checked>
                                    @else
                                        <input type="checkbox" id="permissions{{$permission->id}}" name="permissions[]" value="{{$permission->id}}">
                                    @endif
                                @endif
                            <div>

                        @endforeach
                    </div>
                    <hr>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>
<div class="form-group">
    <input type="submit" name="Save" value="save" class="btn btn-primary" />
</div>
