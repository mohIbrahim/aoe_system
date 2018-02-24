@extends('layouts.app')
@section('title')
    All Permission
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">All Permissions</h3>
                </div>
                <div class="panel-body ">

                    <table class="table table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Name</th>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->title}}</td>
                                    <td><a href="{{ action('PermissionController@show',['id'=>$permission->id]) }}" >{{$permission->name}}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </div>
@endsection
