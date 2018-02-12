@extends('layouts.app')
@section('title')
    {{"$printingMachine->model_prefix - $printingMachine->model_suffix"}}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-primary main_arabic_font">
                <div class="panel-heading">
                    <h3 class="panel-title"> الآلة {{": $printingMachine->code"}}</h3>
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


                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="main-information">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <h2 class="text-center"> البيانات الآساسية لآلة التصوير </h2>
                                            <div class="text-center">
                                                @if(in_array('update_printing_machines', $permissions))
                                                    <a href="{{action('PrintingMachineController@edit', ['id'=>$printingMachine->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
                                                    |
                                                @endif

                                                @if(in_array('delete_printing_machines', $permissions))
                                                    <a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
                                                @endif

                                                <br/>
                                            </br/>
                                        </div>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th> اسم العميل "حائز الآلة" </th>
                                                <td>
                                                    <a href="{{action('CustomerController@show', ['id'=>(isset($printingMachine->customer)?$printingMachine->customer->id:'')])}}">
                                                        {{isset($printingMachine->customer)?$printingMachine->customer->name:''}}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> كود العميل </th>
                                                <td>
                                                    {{isset($printingMachine->customer)?$printingMachine->customer->code:''}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th> رقم ملف الآلة </th>
                                                <td>{{$printingMachine->folder_number}}</td>
                                            </tr>

                                            <tr>
                                                <th> كود الآلة </th>
                                                <td>{{$printingMachine->code}}</td>
                                            </tr>

                                            <tr>
                                                <th> اسم الشركة المصنعة للآلة </th>
                                                <td>{{$printingMachine->the_manufacture_company}}</td>
                                            </tr>

                                            <tr>
                                                <th> الموديل الجزء الأول  </th>
                                                <td>{{$printingMachine->model_prefix}}</td>
                                            </tr>

                                            <tr>
                                                <th> الموديل الجزء الثاني </th>
                                                <td>{{$printingMachine->model_suffix}}</td>
                                            </tr>

                                            <tr>
                                                <th> Serial Number </th>
                                                <td>{{$printingMachine->serial_number}}</td>
                                            </tr>

                                            <tr>
                                                <th> حالة الآلة </th>
                                                <td>{{$printingMachine->status}}</td>
                                            </tr>

                                            <tr>
                                                <th> Product Key </th>
                                                <td>{{$printingMachine->product_key}}</td>
                                            </tr>

                                            <tr>
                                                <th> سنة التصنيع </th>
                                                <td>{{$printingMachine->manufacturing_year}}</td>
                                            </tr>

                                            <tr>
                                                <th> وصف الآلة </th>
                                                <td>{{$printingMachine->description}}</td>
                                            </tr>


                                            <tr>
                                                <th> سعر الآلة عند البيع بدون ضريبة </th>
                                                <td>{{$printingMachine->price_without_tax}}</td>
                                            </tr>

                                            <tr>
                                                <th> سعر الآلة عند البيع بالضريبة </th>
                                                <td>{{$printingMachine->price_with_tax}}</td>
                                            </tr>

                                            <tr>
                                                <th> هل هذة الآلة تم بيعها عن طريق الشركة العربية؟ </th>
                                                <td>{{($printingMachine->is_sold_by_aoe)? "نعم":"لا"}}</td>
                                            </tr>

                                            <tr>
                                                <th> الملاحظات </th>
                                                <td>{{$printingMachine->comments}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="readings-of-printing-machine">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <h2 class="text-center"> قراءات العداد </h2>
                                            <tr>
                                                <th> القراءة </th>
                                                <th> تاريخ أخذ القراءة </th>
                                                <th> رقم الزيارة </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($printingMachine->readings as $key => $reading)
                                                <tr>
                                                    <td>{{$reading->value}}</td>
                                                    <td>{{$reading->reading_date}}</td>
                                                    <td>
                                                        <a href="{{action('VisitController@show', ['id'=>$reading->visit_id])}}">
                                                            {{$reading->visit_id}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="visits">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <h2 class="text-center"> الزيارات </h2>
                                            <tr>
                                                <th> رقم الزيارة </th>
                                                <th> تاريخ الزيارة </th>
                                                <th> نوع الزيارة </th>
                                                <th> قراءة العداد </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($printingMachine->visits as $key1 => $visit)
                                                <tr>
                                                    <td>
                                                        <a href="{{action('VisitController@show', ['id'=>$visit->id])}}">
                                                            {{$visit->id}}
                                                        </a>
                                                    </td>
                                                    <td>{{$visit->visit_date}}</td>
                                                    <td>{{$visit->type}}</td>
                                                    <td>{{$visit->readings_of_printing_machine}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="contracts">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <h2 class="text-center"> العقود </h2>
                                            <tr>
                                                <th> # </th>
                                                <th> كود العقد </th>
                                                <th> نوع العقد </th>
                                                <th> بداية التعاقد </th>
                                                <th> نهاية التعاقد </th>
                                                <th> حالة التعاقد </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($printingMachine->contracts as $key2 => $contract)
                                                <tr>
                                                    <td>{{$key2+1}}</td>
                                                    <td>
                                                        <a href="{{action('ContractController@show', ['id'=>$contract->id])}}">
                                                            {{$contract->code}}
                                                        </a>
                                                    </td>
                                                    <td>{{$contract->type}}</td>
                                                    <td>{{$contract->start}}</td>
                                                    <td>{{$contract->end}}</td>
                                                    <td>{{$contract->status}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="references">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <h2 class="text-center"> الإشارات </h2>
                                            <tr>
                                                <th> # </th>
                                                <th> كود الإشارة </th>
                                                <th> نوع الإشارة </th>
                                                <th> تاريخ الاستلام </th>
                                                <th> المهندس المعين </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($printingMachine->references as $key2 => $reference)
                                                <tr>
                                                    <td>{{$key2+1}}</td>
                                                    <td>
                                                        <a href="{{action('ReferenceController@show', ['id'=>$reference->id])}}">
                                                            {{$reference->code}}
                                                        </a>
                                                    </td>
                                                    <td>{{$reference->type}}</td>
                                                    <td>{{$reference->received_date}}</td>
                                                    <td>{{$reference->assignedEmployee->user->name or ''}}</td>
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
    </div>
</div>
@endsection

@include('partial.deleteConfirm',['name'=>$printingMachine->code,
'id'=> $printingMachine->id,
'message'=>' هل أنت متأكد؟ هل تريد حذف ',
'route'=>'PrintingMachineController@destroy'])
