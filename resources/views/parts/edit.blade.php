@extends('layouts.app')
@section('title')
	 	 تعديل القطعة:  {{$part->name}}
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> تعديل القطعة:  {{$part->name}} </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('PartController@update', ['id'=>$part->id]) }}" method="POST">
							<input type="hidden" name="_method" value="PATCH">
                            {{ csrf_field() }}
                            @include('parts._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
