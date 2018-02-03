@extends('layouts.app')
@section('title')
	 	 تعديل الموظف:  {{$employee->user->name or ''}}
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title">  تعديل الموظف:  {{$employee->user->name or ''}} </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('EmployeeController@update', ['id'=>$employee->id]) }}" method="POST">
							<input type="hidden" name="_method" value="PATCH">
                            {{ csrf_field() }}
                            @include('employees._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
