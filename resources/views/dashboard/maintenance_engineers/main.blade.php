@extends('layouts.app')
@section('title')
    Developer Dashboard
@endsection
@section('content')
<div class="container main_arabic_font">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            
            
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    مرحباً! {{$engineerName}} 
                    <h3>قسم: {{ $departmentName }}</h3>
                </div>
                <div class="panel-body">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <h4 class="text-center">آخر الإشارات المعينة لك</h3>
                                <tr>
                                    <th>رقم الإشارة</th>
                                    <th>نوع الإشارة</th>
                                    <th>حالة الإشارة</th>
                                    <th>اسم العميل</th>
                                    <th>المنطقة</th>
                                    <th>تاريخ الإشارة</th>
                                    <th>كود الآلة</th>
                                    <th>إنشاء زيارة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lastAssignedReferences as $referenceKey => $reference)
                                    <tr>
                                        <td>
                                            <a href="{{action('ReferenceController@show', ['id'=>$reference->id])}}">
                                                {{ $reference->code }}
                                            </a>
                                        </td>
                                        <td>{{ $reference->type }}</td>
                                        <td>{{ $reference->status }}</td>
                                        <td>
                                            <a href="{{action('CustomerController@show', ['id'=>(($reference->printingMachine)?(($reference->printingMachine->customer)?($reference->printingMachine->customer->id):('')):(''))])}}">
                                                {{ ($reference->printingMachine)?(($reference->printingMachine->customer)?($reference->printingMachine->customer->name):('')):('') }}
                                            </a>
                                        </td>
                                        <td>{{ ($reference->printingMachine)?(($reference->printingMachine->customer)?($reference->printingMachine->customer->area):('')):('') }}</td>
                                        <td>{{ $reference->received_date }}</td>
                                        <td>
                                            <a href="{{ action('PrintingMachineController@show', ['id'=>(($reference->printingMachine)?(($reference->printingMachine->id)?($reference->printingMachine->id):('')):(''))]) }}">
                                                {{ ($reference->printingMachine)?(($reference->printingMachine->code)?($reference->printingMachine->code):('')):('') }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ action('VisitController@createWithPrintingMachineId', ['pm_id'=>(($reference->printingMachine)?(($reference->printingMachine->id)?($reference->printingMachine->id):('')):(''))]) }}">
                                                إنشاء زيارة جديدة
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
