@extends('layouts.app')
@section('title')
	 لوحة التحكم
@endsection
@section('content')
<div class="container main_arabic_font">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> لوحة التحكم </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    لقد سجلت الدخول!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
