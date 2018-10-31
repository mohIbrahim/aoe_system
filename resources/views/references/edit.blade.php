@extends('layouts.app')
@section('title')
	 	 تعديل الإشارة:  {{$reference->code}}
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-info main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title">  تعديل الإشارة:  {{$reference->code}} </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('ReferenceController@update', ['id'=>$reference->id]) }}" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="PATCH">
                            {{ csrf_field() }}
                            @include('references._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
