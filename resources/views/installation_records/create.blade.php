@extends('layouts.app')
@section('title')
	 إنشاء محضر تركيب جديد
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-info main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إنشاء محضر تركيب جديد </h2>
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
