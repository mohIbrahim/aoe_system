@extends('layouts.app')
@section('title')
	  تعديل الآلة {{$printingMachine->code}}  
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-info main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> تعديل الآلة {{$printingMachine->code}} </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('PrintingMachineController@update', ['id'=>$printingMachine->id]) }}" method="POST">
							<input type="hidden" name="_method" value="PATCH">
                            {{ csrf_field() }}
                            @include('printing_machines._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
