@extends('layouts.app')
@section('title')
	 	 تعديل القطعة الفرعية  {{$partSerialNumber->serial_number}}
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> تعديل القطعة الفرعية {{$partSerialNumber->serial_number}} </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('PartSerialNumberController@update', ['id'=>$partSerialNumber->id]) }}" method="POST">
							<input type="hidden" name="_method" value="PATCH">
                            {{ csrf_field() }}
                            @include('part_serial_numbers._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
