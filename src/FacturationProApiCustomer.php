<?php
namespace AtomeDev\FacturationProApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class FacturationProApiCustomer extends FacturationProApi
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
                'label' => __('Customers list'),
                'action' => '/firms/FIRM_ID/customers.json',
                'verb' => 'GET',
                'parameters' => ['FIRM_ID'],
                'options' => [
                    'page'          => null,
                    'api_id'        => null,
                    'api_custom'    => null,
                    'company'       => null,
                    'last_name'     => null,
                    'email'         => null,
                    'category_id'   => null,
                    'with_sepa'     => null,
                    'account_code'  => null,
                    'account_entry' => null,
                    'mode' => [
                        'CHOICES' => ['all','company','individual','archived'],
                        'VALUE' => null
                    ],
                ],
                'orders' => ['last_invoice','last_paid','created','updated'],
                'sorts' => ['asc','desc'],
            ],
            'create' => [
                'label' => __('Customers create'),
                'action' => '/firms/FIRM_ID/customers.json',
                'verb' => 'POST',
                'parameters' => ['FIRM_ID'],
                'options' => [
                    'account_code'      => null,
                    'api_custom'        => null,
                    'api_id'            => null,
                    'category_id'       => null,
                    'city'              => null,
                    'civility'          => null,
                    'company_name'      => null,
                    'country'           => null,
                    'currency'          => null,
                    'default_vat'       => null,
                    'discount'          => null,
                    'email'             => null,
                    'fax'               => null,
                    'first_name'        => null,
                    'id'                => null,
                    'individual'        => null,
                    'language'          => null,
                    'last_invoiced_on'  => null,
                    'last_name'         => null,
                    'mobile'            => null,
                    'pay_before'        => null,
                    'penalty'           => null,
                    'phone'             => null,
                    'short_name'        => null,
                    'siret'             => null,
                    'street'            => null,
                    'validity'          => null,
                    'vat_exemption'     => null,
                    'vat_number'        => null,
                    'website'           => null,
                    'zip_code'          => null
                ]
            ],
            'details' => [
                'label' => __('Customers details'),
                'action' => '/firms/FIRM_ID/customers/CUSTOMER_ID.json',
                'verb' => 'GET',
                'parameters' => ['FIRM_ID', 'CUSTOMER_ID'],
                'options' => [
                    'with_sepa' => null
                ]
            ],
            'modify' => [
                'label' => __('Customers modify'),
                'action' => '/firms/FIRM_ID/customers/CUSTOMER_ID.json',
                'verb' => 'PATCH',
                'parameters' => ['FIRM_ID', 'CUSTOMER_ID'],
                'options' => [
                    'account_code'      => null,
                    'api_custom'        => null,
                    'api_id'            => null,
                    'category_id'       => null,
                    'city'              => null,
                    'civility'          => null,
                    'company_name'      => null,
                    'country'           => null,
                    'currency'          => null,
                    'default_vat'       => null,
                    'discount'          => null,
                    'email'             => null,
                    'fax'               => null,
                    'first_name'        => null,
                    'id'                => null,
                    'individual'        => null,
                    'language'          => null,
                    'last_invoiced_on'  => null,
                    'last_name'         => null,
                    'mobile'            => null,
                    'pay_before'        => null,
                    'penalty'           => null,
                    'phone'             => null,
                    'short_name'        => null,
                    'siret'             => null,
                    'street'            => null,
                    'validity'          => null,
                    'vat_exemption'     => null,
                    'vat_number'        => null,
                    'website'           => null,
                    'zip_code'          => null,
                ]
            ],
            'delete' => [
                'label' => __('Customers delete'),
                'action' => '/firms/FIRM_ID/customers/CUSTOMER_ID.json',
                'verb' => 'DELETE',
                'parameters' => ['FIRM_ID', 'CUSTOMER_ID'],
            ],
            'archive' => [
                'label' => __('Customers archive'),
                'action' => '/firms/FIRM_ID/customers/CUSTOMER_ID/archive.json',
                'verb' => 'POST',
                'parameters' => ['FIRM_ID', 'CUSTOMER_ID'],
            ],
            'unarchive' => [
                'label' => __('Customers unarchive'),
                'action' => '/firms/FIRM_ID/customers/CUSTOMER_ID/unarchive.json',
                'verb' => 'POST',
                'output' => 'TEXT',
                'parameters' => ['FIRM_ID', 'CUSTOMER_ID'],
            ],
            /* TODO
            'upload' => [
                'label' => __('Customers upload file'),
                'action' => '/firms/FIRM_ID/customers/CUSTOMER_ID/upload.json',
                'verb' => 'POST',
                'output' => 'TEXT',
                'parameters' => ['FIRM_ID', 'CUSTOMER_ID', 'upload_file'],
            ],
            */
            'invoices' => [
                'label' => __('Customers invoices'),
                'action' => '/firms/FIRM_ID/customers/CUSTOMER_ID/invoices.json',
                'verb' => 'GET',
                'output' => 'TEXT',
                'parameters' => ['FIRM_ID', 'CUSTOMER_ID'],
            ],
            'quotes' => [
                'label' => __('Customers quotes'),
                'action' => '/firms/FIRM_ID/customers/CUSTOMER_ID/quotes.json',
                'verb' => 'GET',
                'output' => 'TEXT',
                'parameters' => ['FIRM_ID','CUSTOMER_ID'],
            ],
        ];
    }

    public function get($id)
    {

    }



}
