@extends('layouts.app')
@section('title')
    Developer Dashboard
@endsection
@section('content')
    <div class="container main_arabic_font">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" >
                        <h4 class="pull-right"> مرحباً! {{$engineerName}}  </h4>
                        <h5 class="text-left">قسم: {{ $departmentName }}</h5>
                    </div>
                    <div class="panel-body">
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            @include('dashboard.maintenance_engineers.blocks.references')
                            @include('dashboard.maintenance_engineers.blocks.visits')
                            @include('dashboard.maintenance_engineers.blocks.printing_machines')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
