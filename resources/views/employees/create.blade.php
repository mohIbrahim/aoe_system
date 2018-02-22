@extends('layouts.app')
@section('title')
	 إنشاء موظف جديد
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-info main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إنشاء موظف جديد </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('EmployeeController@store') }}" method="POST">
                            {{ csrf_field() }}
                            @include('employees._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
