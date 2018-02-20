@extends('layouts.app')
@section('title')
    {{"$printingMachine->model_prefix - $printingMachine->model_suffix"}}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-primary main_arabic_font">
                <div class="panel-heading text-center">
                    <h4> عرض الآلة التصوير</h4>
                    <h4> التي في حيازة العميل: {{ ($printingMachine->customer)?($printingMachine->customer->name):(' لم يتم تعين العميل حتى اللآن ')}} </h4>
                </div>
                <div class="panel-body">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#main-information" aria-controls="main-information" role="tab" data-toggle="tab">
                                    البيانات الآساسية
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#readings-of-printing-machine" aria-controls="readings-of-printing-machine" role="tab" data-toggle="tab">
                                     قراءات العداد
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#visits" aria-controls="visits" role="tab" data-toggle="tab">
                                     الزيارات
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#contracts" aria-controls="contracts" role="tab" data-toggle="tab">
                                     العقود
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#references" aria-controls="references" role="tab" data-toggle="tab">
                                     الإشارات
                                </a>
                            </li>

							<li role="presentation">
                                <a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">
                                     الفواتير
                                </a>
                            </li>


                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="main-information">
                            	@include('printing_machines.show_tabs.main_informations')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="readings-of-printing-machine">
                                @include('printing_machines.show_tabs.readings_of_printing_machine')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="visits">
                                @include('printing_machines.show_tabs.visits')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="contracts">
                                @include('printing_machines.show_tabs.contracts')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="references">
                                @include('printing_machines.show_tabs.references')
                            </div>
							<div role="tabpanel" class="tab-pane" id="invoices">
                                @include('printing_machines.show_tabs.invoices')
                            </div>
                        </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@include('partial.deleteConfirm',['name'=>$printingMachine->code,
'id'=> $printingMachine->id,
'message'=>' هل أنت متأكد؟ هل تريد حذف ',
'route'=>'PrintingMachineController@destroy'])
