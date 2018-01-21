@extends('layouts.app')
@section('title')
	 إضافة مقايسة جديدة
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إضافة مقايسة جديدة </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('IndexationController@store') }}" method="POST">
                            {{ csrf_field() }}
                            @include('indexations._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
