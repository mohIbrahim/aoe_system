@extends('layouts.app')
@section('title')
	 	 تعديل الفاتورة:  {{$invoice->number}}
@endsection
@section('content')
          <div class="col-lg-12">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary main_arabic_font">
                    <div class="panel-heading text-center">
                        <h2 class="panel-title">  تعديل الفاتورة:  {{$invoice->number}} </h2>
                    </div>
                    <div class="panel-body">
                        @include('errors.list')
                        <form class="" action="{{ action('InvoiceController@update', ['id'=>$invoice->id]) }}" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="PATCH">
                            {{ csrf_field() }}
                            @include('invoices._form')
                        </form>
                    </div>
                </div>
            </div>
          </div>
@endsection
