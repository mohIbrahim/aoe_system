@extends('layouts.app')
@section('title')
    Developer Dashboard
@endsection
@section('content')
    <div class="container main_arabic_font">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="font-size:0.7em">
                <div class="panel panel-default">
                    <div class="panel-heading" >
                        <h5 class="pull-left">قسم: {{ $departmentName }}</h5>
                        <h4 class="pull-right"> مرحباً! {{$engineerName}}  </h4>
                        <h2 class="text-center"> لوحة التحكم </h2>
                        <span class="clearfix"></span>
                    </div>
                    <div class="panel-body">
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            @include('dashboard.maintenance_engineers.blocks.references')
                            @include('dashboard.maintenance_engineers.blocks.visits')
                            @include('dashboard.maintenance_engineers.blocks.invoices')
                            @include('dashboard.maintenance_engineers.blocks.printing_machines')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
