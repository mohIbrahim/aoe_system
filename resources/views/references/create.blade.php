@extends('layouts.app')
@section('title')
	 إنشاء إشارة جديدة
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-info main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إنشاء إشارة جديدة </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('ReferenceController@store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include('references._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
