@extends('layouts.app')
@section('title')
	 إدخال قطعة فرعية جديدة
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إدخال قطعة فرعية جديدة </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('PartSerialNumberController@store') }}" method="POST">
                            {{ csrf_field() }}
                            @include('part_serial_numbers._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
