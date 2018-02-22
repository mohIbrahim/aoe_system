@extends('layouts.app')
@section('title')
	 إدخال قطعة قابلة للتغير من أجزاء الماكينة
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-info main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إدخال قطعة قابلة للتغير من أجزاء الماكينة </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('PartController@store') }}" method="POST">
                            {{ csrf_field() }}
                            @include('parts._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
