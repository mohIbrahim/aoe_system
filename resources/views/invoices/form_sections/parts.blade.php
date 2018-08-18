<div class="panel panel-default">
    <div class="panel-body">
        <h3> القطع المختارة </h3>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th> اسم القطعة </th>
                        <th> الرقم المسلسل للقطعة </th>
                        <th> وصف القطعة </th>
                        <th> العدد </th>
                        <th> السعر القطعة بدون الضريبة </th>
                        <th> السعر القطعة بالضريبة </th>
                        <th> نسبة الخصم على القطعة الواحدة </th>
                        <th> حذف </th>
                    </tr>
                </thead>
                <tbody id="invoice-form-selected-parts-table-body">
                    @if(old('parts_ids'))
                        @for ($i = 0; $i < count(old('parts_ids')); $i++)
                            <tr>
                                <td>
                                    {{old('parts_names')[$i]}}
                                    <input type='hidden' name='parts_names[]' value='{{old('parts_names')[$i]}}'>
                                </td>
                                <td>
                                    <div class='input-group'>
                                        <input type='text' class='form-control' placeholder=' ادخل الرقم المسلسل للقطعة ' name='parts_serial_numbers[]' value="{{old('parts_serial_numbers')[$i]}}">
                                    </div>
                                </td>
                                <td>
                                    <div class='input-group'>
                                        <input type='text' class='form-control' placeholder='ادخل وصف القطعة' name='parts_descriptions[]' value="{{old('parts_descriptions')[$i]}}">
                                    </div>
                                </td>
                                <td>
                                    <div class='input-group'>
                                        <input type='number' class='form-control' placeholder=' ادخل عدد القطع ' name='parts_count[]' value="{{old('parts_count')[$i]}}">
                                        <input type='hidden' class='form-control' name='parts_ids[]' value="{{old('parts_ids')[$i]}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type='number' step='0.01' class='form-control' placeholder='ادخل سعر القطعة بدون الضريبة' name='parts_prices_without_tax[]' value="{{old('parts_prices_without_tax')[$i]}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type='number' step='0.01' class='form-control' placeholder='ادخل سعر القطعة بالضريبة' name='parts_prices[]' value="{{old('parts_prices')[$i]}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type='number' class='form-control' name='discount_rate[]' value="{{old('discount_rate')[$i]}}" placeholder='إدخل نسبة الخصم إن وجدت'>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <button type='button' class='btn btn-danger btn-xs invoice-form-delete-part-button'> حذف </button>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    @elseif(isset($parts))
                        @foreach ($parts as $i => $part)
                            <tr>
                                <td>
                                    {{$part->name}}
                                    <input type='hidden' name='parts_names[]' value='{{$part->name}}'>
                                </td>
                                <td>
                                    <div class='input-group'>
                                        <input type='text' class='form-control' placeholder=' ادخل الرقم المسلسل للقطعة ' name='parts_serial_numbers[]' value="{{$part->pivot->serial_number or ''}}">
                                    </div>
                                </td>
                                <td>
                                    <div class='input-group'>
                                        <input type='text' class='form-control' placeholder='ادخل وصف القطعة' name='parts_descriptions[]' value="{{$part->pivot->part_description or ''}}">
                                    </div>
                                </td>
                                <td>
                                    <div class='input-group'>
                                        <input type='number' class='form-control' placeholder=' ادخل عدد القطع ' name='parts_count[]' value="{{$part->pivot->number_of_parts or 1}}">
                                        <input type='hidden' class='form-control' name='parts_ids[]' value="{{$part->id or ''}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type='number' step='0.01' class='form-control' placeholder='ادخل سعر القطعة بدون الضريبة' name='parts_prices_without_tax[]' value="{{$part->pivot->price_without_tax or ''}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type='number' step='0.01' class='form-control' placeholder='ادخل سعر القطعة بالضريبة' name='parts_prices[]' value="{{$part->pivot->price or ''}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type='number' class='form-control' name='discount_rate[]' value="{{$part->pivot->discount_rate or ''}}" placeholder='إدخل نسبة الخصم إن وجدت'>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <button type='button' class='btn btn-danger btn-xs invoice-form-delete-part-button'> حذف </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>