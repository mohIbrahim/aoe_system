@extends('layouts.app')

@section('title')
	تقرير عن الآلات التي ليس لها بطاقة متابعة
@endsection

@section('content')
	<div class="row main_arabic_font">
	  <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
		  <div class="panel panel-default">	
			<div class="panel-heading text-center">
				<h3> تقرير عن الآلات التي ليس لها بطاقة متابعة </h3>
			</div>	    
		    <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover standard-datatable" id="printing-machine-index-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> رقم الملف الآلة </th>
                                <th> الرقم المسلسل </th>
                                <th> كود الآلة </th>
                                <th> الموديل </th>
                                <th> الحالة </th>
                                <th> اسم العميل </th>
                                <th> الإدارة </th>
                                <th> الموظفين المسؤولين عن الآلة </th>
                                <th> تاريخ الإنشاء </th>
                            </tr>
                        </thead>
                        <tbody id="my-table-body">
                            <div class="">
                                @foreach ($printingMachinesWithoutFollowUpCards as $k => $printingMachine)
                                    <tr>
                                        <td>
                                            {{$k+1}}
                                        </td>
                                        <td><a href="{{action('PrintingMachineController@show', ['id'=>$printingMachine->id])}}">{{$printingMachine->folder_number}}</a></td>
                                        <td>{{$printingMachine->serial_number}}</td>
                                        <td>{{$printingMachine->code}}</td>
                                        <td>{{"$printingMachine->model_prefix-$printingMachine->model_suffix"}}</td>
                                        <td>{{$printingMachine->status}}</td>
                                        <td>{{isset($printingMachine->customer)?$printingMachine->customer->name:''}}</td>
                                        <td>
                                            {{(isset($printingMachine->customer))?($printingMachine->customer->administration):('')}}
                                        </td>
                                        <td>
                                            @if(!empty($printingMachine->assignedEmployees))
                                                @foreach($printingMachine->assignedEmployees as $assignedEmployee)
                                                    <div>{{$assignedEmployee->user->name}}</div> &nbsp &nbsp
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            {{$printingMachine->created_at->format('d-m-Y')}}
                                        </td>
                                    </tr>
                                @endforeach
                            </div>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th> رقم الملف الآلة </th>
                                <th> الرقم المسلسل </th>
                                <th> كود الآلة </th>
                                <th> الموديل </th>
                                <th> الحالة </th>
                                <th> اسم العميل </th>
                                <th> الإدارة </th>
                                <th> الموظفين المسؤولين عن الآلة </th>
                                <th> تاريخ الإنشاء </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
		  </div>
	  </div>
	</div>
@endsection

@section('head')
{{-- Datatable --}}
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/datatables.min.css"/>
{{-- Datatable --}}
@endsection

@section('js_footer')
{{-- Datatable --}}
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/datatables.min.js"></script>
{{-- Datatable --}}
@endsection

