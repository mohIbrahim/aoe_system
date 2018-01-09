@extends('layouts.app')
@section('title')
	 إدخال قسم جديد
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إدخال قسم جديد </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('DepartmentController@store') }}" method="POST">
                            {{ csrf_field() }}
                            @include('departments._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
