@extends('layouts.app')
@section('title')
	 إضافة محضر تركيب جديد
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إضافة محضر تركيب جديد </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('InstallationRecordController@store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include('installation_records._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
