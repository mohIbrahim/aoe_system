@extends('layouts.app')
@section('title')
	 	 تعديل العقد:  {{$contract->code}}
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> تعديل العقد:  {{$contract->code}} </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('ContractController@update', ['id'=>$contract->id]) }}" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="PATCH">
                            {{ csrf_field() }}
                            @include('contracts._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
