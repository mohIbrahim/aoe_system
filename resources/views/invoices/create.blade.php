@extends('layouts.app')
@section('title')
	 إضافة فاتورة جديدة
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title"> إضافة فاتورة جديدة </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('InvoiceController@store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include('invoices._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
