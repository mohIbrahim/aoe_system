<td colspan="2">
    <table class="table table-hover">
        <h3 class="text-center"> بيان أسعار القطع المطلوبة  </h3>
        <thead>
            <tr>
                <th> البيان </th>
                <th> واصف القطعة </th>
                <th> الرقم المسلسل </th>
                <th> العدد </th>
                <th> سعر القطعة بدون الضريبة </th>
                <th> تسبة الخصم على القطعة الوحدة </th>
                <th> قيمة الخصم على القطعة الوحدة </th>
                <th> نسبة الضريبة </th>
                <th> سعر القطعة بالضريبة </th>
                <th> إجمالي الصنف الواحد بالضريبة </th>
                <th> الأرقام المسلسلة للآلات </th>
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
                    <td style="white-space:pre-line">{{$row['descriptions']}}</td>
                    <td>{{$row['serialNumber']}}</td>
                    <td>{{$row['numberOfParts']}} ق</td>
                    <td>{{$row['partPriceWithoutTax']}} جنية</td>
                    <td>{{$row['discountRate']}}%</td>
                    <td>{{$row['discountOnPart']}} جنية</td>
                    <td>{{$row['taxPercentage']}}%</td>
                    <td>{{$row['partPriceWithTax']}} جنية</td>
                    <td>{{$row['rowPriceWithTax']}} جنية</td>
                    <td style="white-space: pre-wrap;">{{$row['printingMachinesSerial']}}</td>
                </tr>
            @endforeach
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                <td>
                    <span class=""style="color:3d3d3d;border-top:1px solid #3d3d3d;padding:5px; font-weight: bold; display:block">
                        الإجمالــي: {{$totalPriceWithTax}} جنية بالضريبة
                    </span>
                    <span class=""style="color:3d3d3d;padding:5px; font-weight: bold; display:block">
                        الإجمالــي: {{$totalPriceWithoutTax}} جنية بدون الضريبة
                    </span>
                    <span class=""style="color:3d3d3d;padding:5px; font-weight: bold; display:block">
                        قيمة الضريبة: {{$totalTax}} جنية 
                    </span>
                    
                </td>
            </tr>
        </tbody>
    </table>
</td>