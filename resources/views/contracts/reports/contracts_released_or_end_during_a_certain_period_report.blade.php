@extends('layouts.app')

@section('title')
    تقرير عن العقود الصادرة أو المنتهية خلال فترة معينة
@endsection

@section('content')
    <div class="row main_arabic_font">
      <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
          <div class="panel panel-default">
            <div class="panel-heading ">
                <legend> تقرير عن العقود الصادرة أو المنتهية خلال فترة معينة </legend>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="form">
                            <div class="alert alert-danger alert-dismissible" id="contract-released-or-end-during-a-certain-period-error-validator" style="display: none; text-align:center">
                                برجاء إختيار التاريخ
                            </div>

                            <div class="form-group">
                                <label for="visit-input-search"> من </label>
                                <input type="text" name="from" class="form-control" id="datepicker" autocomplete="off" placeholder=" برجاء إختيار تاريخ بداية المدة. ">
                            </div>
                            <div class="form-group">
                                <label for="visit-input-search"> إلى </label>
                                <input type="text" name="to" class="form-control" id="datepicker2" autocomplete="off" placeholder=" برجاء إختيار تاريخ نهاية المدة. ">
                            </div>
                            <div class="form-group">
                                <label for="is-end-date"> البحث بتاريخ نهاية التعاقد </label>
                                <input type="checkbox" name="is_end_date" id="is-end-date">
                            </div>
                            <button type="button" id="contract-released-or-end-during-a-certain-period-search-btn" class="btn btn-primary"> بحث </button>
                        </div>
                    </div>
                </div>
                <h3 class="text-center"> عرض العقود </h3>
            </div>
            <div class="panel-body">
                    <div id="contract-released-or-end-during-a-certain-period-loading-message" class="text-center"></div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover standard-datatable">
                            <thead>
                                  <tr>
                                    <th>#</th>
                                    <th> كود العقد </th>
                                    <th> نوع العقد </th>
                                    <th> تاريخ بداية العقد </th>
                                    <th> تاريخ نهاية العقد </th>
                                    <th> حالة التعاقد </th>
                                    <th> نظام السداد </th>
                                    <th> اسم العميل </th>
                                    <th> سعر التعاقد بدون الضريبة </th>
                                  </tr>
                              </thead>
                            <tbody id="contract-released-or-end-during-a-certain-period-table-body">
                            </tbody>
                            <tfoot>
                                  <tr>
                                    <th>#</th>
                                    <th> كود العقد </th>
                                    <th> نوع العقد </th>
                                    <th> تاريخ بداية العقد </th>
                                    <th> تاريخ نهاية العقد </th>
                                    <th> حالة التعاقد </th>
                                    <th> نظام السداد </th>
                                    <th> اسم العميل </th>
                                    <th> سعر التعاقد بدون الضريبة </th>
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
{{-- datePicker --}}
    <link rel="stylesheet" href="{{asset('css/datepicker/jquery-ui.min.css')}}">
{{-- datePicker --}}
@endsection

@section('js_footer')
{{-- Datatable --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/datatables.min.js"></script>
{{-- Datatable --}}
{{-- datePicker --}}
    <script src="{{asset('js/datepicker/jquery-ui.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/datepicker/sys.js')}}" charset="utf-8"></script>
{{-- datePicker --}}

@endsection