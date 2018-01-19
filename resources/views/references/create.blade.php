@extends('layouts.app')
@section('title')
	 إضافة بطاقة متابعة جديد
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إضافة بطاقة متابعة جديد </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('FollowUpCardController@store') }}" method="POST">
                            {{ csrf_field() }}
                            @include('follow_up_cards._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
