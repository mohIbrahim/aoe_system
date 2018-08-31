<tr>
    @if($invoice->type == 'مقايسة')
        @include('invoices.show_sections.statement_sections.indexation')
    @elseif($invoice->type == 'بيع قطع')
        @include('invoices.show_sections.statement_sections.parts')
    @elseif($invoice->type == 'تعاقد')
        @include('invoices.show_sections.statement_sections.contract')
    @endif
    
</tr>