<td colspan="2">
    <table class="table table-hover">
        <h3 class="text-center"> بيان سعر التعاقد </h3>
        <thead>
            <tr>
                <th> # </th>
                <th> البيان </th>
                <th> العدد </th>
                <th> سعر الوحدة بدون الضريبة</th>
                <th> سعر الوحدة بالضريبة</th>
                <th> الجملة بالضريبة </th>
            </tr>
        </thead>
        <tbody>
            @foreach( $statements as $statement )
                <tr>
                    <td>
                        {{$statement['rowNumber']}}
                    </td>
                    <td>
                        <a href="{{action('ContractController@show', ['id'=>$statement['itemId']])}}">
                            {{$statement['itemName']}}
                        </a>
                    </td>
                    <td>
                        {{$statement['itemCount']}}
                    </td>
                    <td>
                        {{$statement['itemPriceWithoutTax']}} جنية
                    </td>
                    <td>
                        {{$statement['itemPrice']}} جنية
                    </td>
                    <td>
                        {{$statement['totalItemsPricePerRow']}} جنية
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</td>
