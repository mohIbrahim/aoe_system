<h4 class="well well-sm" role="button" data-toggle="collapse" data-target="#visits"> الزيارات والمقايسات التي قمت بها.</h4>
<div class="collapse table-responsive" id="visits">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th> رقم الزيارة </th>
                <th> تاريخ الزيارة </th>
                <th> نوع الزيارة </th>
                <th> كود آلة التصوير </th>
                <th> قراءة العداد </th>
                <th> اسم المهندس الذي قام بالزيارة </th>
                <th> المقايسة </th>
            </tr>
        </thead>
        <tbody id="visit-index-my-table-body">
            <div class="">
                @foreach ($visits as $k => $visit)
                    <tr>
                        <td>
                            {{$k+1}}
                        </td>
                        <td>
                            <a href="{{action('VisitController@show', ['id'=>$visit->id])}}" target="_blank">
                                {{$visit->id}}
                            </a>
                        </td>
                        <td>
                            {{$visit->visit_date}}
                        </td>
                        <td>{{$visit->type}}</td>
                        <td>
                            <a href="{{action('PrintingMachineController@show', ['id'=>(isset($visit->printingMachine)?$visit->printingMachine->id:'')])}}">
                                {{isset($visit->printingMachine)?$visit->printingMachine->code:''}}
                            </a>
                        </td>
                        <td>{{$visit->readings_of_printing_machine}}</td>
                        <td>{{$visit->theEmployeeWhoMadeTheVisit->user->name or ''}}</td>
                        <td>
                            @if(!empty($visit->indexation))
                                <a href="{{action('IndexationController@show', ['id'=>$visit->indexation->id])}}" target="_blank">
                                    {{$visit->indexation->code}}
                                </a>
                            @else
                                لا يوجد
                            @endif
                        </td>
                    </tr>
                @endforeach

            </div>
        </tbody>
    </table>
</div>
<button class="btn btn-xs btn-default pull-left" data-toggle="collapse" data-target="#visits">+/-</button>
<span class="clearfix"></span>
<hr>