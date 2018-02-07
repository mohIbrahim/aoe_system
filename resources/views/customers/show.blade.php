@extends('layouts.app')
@section('title')
    العميل: {{$customer->name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-primary main_arabic_font">
                <div class="panel-heading">
                    <h3 class="panel-title"> العميل: {{$customer->name}}</h3>
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
                            @if ($customer->branches->isNotEmpty())
                                <li role="presentation">
                                    <a href="#branches" aria-controls="branches" role="tab" data-toggle="tab">
                                        الفروع
                                    </a>
                                </li>
                            @endif
                            <li role="presentation">
                                <a href="#machines" aria-controls="machines" role="tab" data-toggle="tab">
                                    الآلات
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="main-information">
                                <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                            <h2 class="text-center"> البيانات الآساسية للعميل </h2>
                                            <div class="text-center">
                                                @if(in_array('update_customers', $permissions))
                                                    <a href="{{action('CustomerController@edit', ['id'=>$customer->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
                                                    |
                                                @endif

                                                @if(in_array('delete_customers', $permissions))
                                                    <a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
                                                @endif

                                                <br/>
                                            </br/>
                                        </div>

                                    </thead>
                                    <tbody>
                                        @if (isset($customer->mainBranch))
                                            <tr>
                                                <th> الفرع الرئيسي </th>
                                                <td>
                                                    <a href="{{action('CustomerController@show', ['id'=>$customer->mainBranch->id])}}">
                                                        {{$customer->mainBranch->name}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th> كود العميل </th>
                                            <td>{{$customer->code}}</td>
                                        </tr>

                                        <tr>
                                            <th> اسم العميل </th>
                                            <td>{{$customer->name}}</td>
                                        </tr>

                                        <tr>
                                            <th> نوع العميل </th>
                                            <td>{{$customer->type}}</td>
                                        </tr>

                                        <tr>
                                            <th> أرقام التليفون </th>
                                            <td>
                                                @foreach ($customer->telecoms as $key => $phone)
                                                    {{$phone->number}} <br/>
                                                @endforeach
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> البريد الإلكتروني </th>
                                            <td>{{$customer->email}}</td>
                                        </tr>

                                        <tr>
                                            <th> الموقع الكتروني </th>
                                            <td>{{$customer->website}}</td>
                                        </tr>

                                        <tr>
                                            <th> الإدارة </th>
                                            <td>{{$customer->administration}}</td>
                                        </tr>

                                        <tr>
                                            <th> القسم </th>
                                            <td>{{$customer->department}}</td>
                                        </tr>

                                        <tr>
                                            <th> العنوان </th>
                                            <td>
                                                {{$customer->address}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> المنطقة </th>
                                            <td>
                                                {{$customer->area}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> الحي </th>
                                            <td>
                                                {{ $customer->district}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> المدينة </th>
                                            <td>
                                                {{$customer->city}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> المحافظة </th>
                                            <td>
                                                {{$customer->governorate}}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th> اسم الشخص المسؤول عن الآلة </th>
                                            <td>{{$customer->responsible_person_name}}</td>
                                        </tr>

                                        <tr>
                                            <th> الملاحظات </th>
                                            <td>{{$customer->comments}}</td>
                                        </tr>

                                        <tr>
                                            <th> تاريخ الإنشاء </th>
                                            <td style="direction:ltr; text-align:center">{{$customer->created_at}}</td>
                                        </tr>

                                        <tr>
                                            <th> تاريخ التعديل </th>
                                            <td style="direction:ltr; text-align:center">{{$customer->created_at}}</td>
                                        </tr>


                                    </tbody>
                                </table>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="branches">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th> الاسم </th>
                                            <th> المحافظة </th>
                                            <th> المدينة </th>
                                            <th> المنطقة </th>
                                            <th> الحي </th>
                                            <th> ارقام التليفون </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer->branches as $key1 => $branch)
                                            <tr>
                                                <td>
                                                    <a href="{{action('CustomerController@show', ['id'=>$branch->id])}}">
                                                        {{$branch->name}}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{$branch->governorate}}
                                                </td>
                                                <td>
                                                    {{$branch->city}}
                                                </td>
                                                <td>
                                                    {{$branch->area}}
                                                </td>
                                                <td>
                                                    {{$branch->district}}
                                                </td>
                                                <td>
                                                    @foreach ($branch->telecoms as $key2 => $phone)
                                                        {{$phone->number}}<br>
                                                    @endforeach
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="machines">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th> كود الآلة </th>
                                            <th> اسم الشركة المصنعّة </th>
                                            <th> رقم ملف الآلة </th>
                                            <th> الموديل  </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer->printingMachines as $key1 => $machine)
                                            <tr>
                                                <td>
                                                    <a href="{{action('PrintingMachineController@show', ['id'=>$machine->id])}}">
                                                        {{$machine->code}}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{$machine->the_manufacture_company}}
                                                </td>
                                                <td>
                                                    {{$machine->folder_number}}
                                                </td>
                                                <td>
                                                    {{$machine->model_prefix.'-'.$machine->model_suffix}}
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
    </div>
@endsection

@include('partial.deleteConfirm',['name'=>$customer->name,
'id'=> $customer->id,
'message'=>' هل أنت متأكد؟ هل تريد حذف ',
'route'=>'CustomerController@destroy'])
