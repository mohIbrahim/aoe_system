<?php

namespace App\AOE\Repositories\Invoice;

use App\Invoice;
use App\Part;

class EloquentInvoice implements InvoiceInterface
{
    private $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
    public function getAll()
    {
        $invoices = $this->invoice->all();
        return $invoices;
    }
    public function latest()
    {
        $invoices = $this->invoice->latest();
        return $invoices;
    }
    public function oldest()
    {
        $invoices = $this->invoice->oldest();
        return $invoices;
    }
    public function getById($id)
    {
        $invoice = $this->invoice->findOrFail($id);
        return $invoice;
    }
    public function create(array $attributes)
    {
        $invoice = $this->invoice->create($attributes);
        return $invoice;
    }
    public function update($id, array $attributes)
    {
        $invoice = $this->invoice->findOrFail($id);
        $invoice->update($attributes);
        return $invoice;
    }
    public function delete($id)
    {
        $invoice = $this->invoice->findOrFail($id);
        $isDeleted = $invoice->delete();
        return $isDeleted;
    }

    public function search($keyword)
    {
        $results = $this->invoice->with('customer')->where('number', 'like', '%'.$keyword.'%')
                        ->orWhere('type', 'like', '%'.$keyword.'%')
                        ->orWhere('finance_check_out', 'like', '%'.$keyword.'%')
                        ->orWhere('release_date', 'like', '%'.$keyword.'%')
                        ->orWhereHas('customer', function($query) use($keyword){
                            $query->where('name', 'like', '%'.$keyword.'%');
                        })
                        ->get();
        return $results;
    }

    public function searchFormPart($keyword)
    {
        $results = Part::where('name', 'like', '%'.$keyword.'%')
                                ->limit(15)
                                ->get();
        return $results;
    }
}
