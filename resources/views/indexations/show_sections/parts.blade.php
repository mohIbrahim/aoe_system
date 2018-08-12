<tr>
    <td colspan="2">
        <table class="table table-hover">
            <?php $total = 0;?>
            <h3 class="text-center"> بيان للقطع المطلوبة </h3>
            <thead>
                <tr>
                    <th> اسم القطعة </th>
                    <th> واصف القطعة </th>
                    <th> الرقم المسلسل </th>
                    <th> العدد </th>
                    <th> سعر القطعة بدون الضريبة </th>
                    <th> تسبة الخصم على القطعة الوحدة </th>
                    <th> إجمالي الصنف الواحد </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statementOfRequiredParts as $rowKey => $row)
                    <tr>
                        <td>
                            <a href="{{action('PartController@show', ['id'=>$row['id']])}}" target="_blank">
                                {{$row['name']}}
                            </a>
                        </td>
                        <td>{{$row['descriptions']}}</td>
                        <td>{{$row['serialNumber']}}</td>
                        <td>{{$row['numberOfParts']}}</td>
                        <td>{{$row['partPrice']}}</td>
                        <td>{{$row['discount']}}%</td>
                        <td>{{$row['rowPrice']}}</td>
                    </tr>
                @endforeach
                <tr>
                    
                    <th colspan="7">
                        <span class="pull-left"style="color:3d3d3d;border-top:1px solid #3d3d3d;padding:5px">
                            الإجمالــي: {{$totalPrice}} جنية بدون الضريبة
                        </span>
                    </th>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
