@extends('layouts.app')
@section('title')
    الزيارة: {{$visit->id }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-info main_arabic_font">
                <div class="panel-heading">
                    <h3 class="panel-title"> الزيارة: {{$visit->id }}</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <h2 class="text-center"> البيانات الآساسية للزيارة </h2>
                                <div class="text-center">
                                    @if(in_array('update_visits', $permissions))
                                        <a href="{{action('VisitController@edit', ['id'=>$visit->id])}}" class=" btn btn-success btn-xs"><span class="glyphicon glyphicon-wrench"></span> تعديل</a>
                                        |
                                    @endif

                                    @if(in_array('delete_visits', $permissions))
                                        <a href="#" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> حذف</a>
                                    @endif

                                    <br/>
                                </br/>
                            </div>

                        </thead>
                        <tbody>
                            <tr>
                                <th> رقم الزيارة </th>
                                <td>{{$visit->id}}</td>
                            </tr>
                            <tr>
                                <th> كود الآلة التصوير </th>
                                <td>
                                    <a href="{{action('PrintingMachineController@show', ['id'=>(isset($visit->printingMachine)?$visit->printingMachine->id:'')])}}">
                                        {{isset($visit->printingMachine)?$visit->printingMachine->code:''}}
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th> تاريخ الزيارة </th>
                                <td>{{$visit->visit_date}}</td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <table class="table table-hover">
                                             <thead>
                                                <tr>
                                                    <th> نوع الزيارة </th>
                                                    <th> الكود </th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                    <td>{{$visit->type}}</td>
                                                    <td>
                                                        <a href="{{action('FollowUpCardController@show', ['id'=>(isset($visit->followUpCard)?$visit->followUpCard->id:'')])}}">
                                                            {{$visit->followUpCard->code or ''}}
                                                        </a>
                                                        <a href="{{action('ReferenceController@show', ['id'=>(isset($visit->reference)?$visit->reference->id:'')])}}">
                                                            {{$visit->reference->code or ''}}
                                                        </a>
                                                    </td>
                                                </tr>
                                             </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <th> المهندس الذي قام بالزيارة </th>
                                <td>
                                    {{$visit->theEmployeeWhoMadeTheVisit->user->name or ''}}
                                </td>
                            </tr>

                            <tr>
                                <th> اسم الشخص المسؤول عن الآلة </th>
                                <td>{{$visit->representative_customer_name}}</td>
                            </tr>


                            <tr>
                                <th> قراءة العداد </th>
                                <td>
                                    {{$visit->readings_of_printing_machine}}
                                </td>
                            </tr>

                            <tr>
                                <th> رقم المقايسة </th>
                                <td>
                                    <a href="{{action('IndexationController@show', ['id'=>(isset($visit->indexation)?$visit->indexation->id:'')])}}">
                                        {{isset($visit->indexation)?$visit->indexation->id:''}}
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th> الملاحظات </th>
                                <td>{{$visit->comments}}</td>
                            </tr>

                            <tr>
                                <th> تاريخ الإنشاء </th>
                                <td style="direction:ltr; text-align:center">{{$visit->created_at}}</td>
                            </tr>

                            <tr>
                                <th> تاريخ التعديل </th>
                                <td style="direction:ltr; text-align:center">{{$visit->created_at}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('partial.deleteConfirm',['name'=>$visit->id,
'id'=> $visit->id,
'message'=>' هل أنت متأكد؟ هل تريد حذف ',
'route'=>'VisitController@destroy'])
