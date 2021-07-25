<?php
namespace AtomeDev\FacturationProApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class FacturationProApiInvoices extends FacturationProApi
{
    public function __construct()
    {
        parent::__construct();
        $this->initActions();
    }

    /* Description of API structure */
    private function initActions()
    {
        $this->actions = [
            'list' => [
                'label' => __('Invoices list'),
                'action' => '/firms/FIRM_ID/invoices.json',
                'verb' => 'GET',
                'output' => 'JSON',
                'parameters' => ['FIRM_ID'],
                'options' => [
                    'with_details' => null,
                    'with_settlements' => null,
                    'page' => null,
                    'api_id' => null,
                    'api_custom' => null,
                    'invoice_ref' => null,
                    'full_invoice_ref' => null,
                    'title' => null,
                    'customer_id' => null,
                    'company' => null,
                    'last_name' => null,
                    'bill_type' => [
                        'CHOICES' => ['paid', 'unpaid', 'term', 'invoice', 'external', 'refund', 'down_payment', 'draft', 'nova'],
                        'VALUE' => null
                    ],
                    'category_id' => null,
                    'followup_id' => null,
                    'accounting_entry' => null,
                    'period_start' => null,
                    'period_end' => null,
                    'period_type' => null,
                ],
                'orders' => ['customer','paid', 'total', 'billed', 'term', 'created','updated'],
                'sorts' => ['asc','desc'],
            ],
            'create' => [
                'label' => __('Invoices create'),
                'action' => '/firms/FIRM_ID/invoices.json',
                'verb' => 'POST',
                'output' => 'JSON',
                'parameters' => [
                    'FIRM_ID' => null,
                ],
                'options' => [
                    'currency' => null,
                    'customer_id' => null,
                    'invoiced_on' => null,
                    'language' => null,
                    'pay_before' => null,
                    'penalty' => null,
                    'title' => null,
                    'items' => [
                        'position' => null,
                        'quantity' => null,
                        'title' => null,
                        'unit_price' => null,
                        'vat' => null
                    ]
                ],
            ],
            'details' => [
                'label' => __('Invoices details'),
                'action' => '/firms/FIRM_ID/invoices/INVOICE_ID.json',
                'verb' => 'GET',
                'output' => 'TEXT',
                'parameters' => ['FIRM_ID', 'INVOICE_ID'],
                'options' => [],
            ],
            'download' => [
                'label' => __('Invoices download'),
                'action' => '/firms/FIRM_ID/invoices/INVOICE_ID.pdf',
                'verb' => 'GET',
                'output' => 'FILE',
                'parameters' => ['FIRM_ID', 'INVOICE_ID'],
                'options' => [],
            ],
        ];
    }
}
