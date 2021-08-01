<?php
namespace AtomeDev\FacturationProApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;

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

    public function test()
    {
        echo "<h1>LIST</h1>";
        $list = $this->list();

        if ($list['success']) {
            echo "<pre>";
            print_r($list['response']);
            echo "</pre>";
        }
        echo "<hr>";


        echo "<h1>DETAIL</h1>";
        foreach ($list['response'] as $customer) {
            $detail = $this->get($customer['id'], true);

            if ($detail['success']) {
                echo "<pre>";
                print_r($detail['response']);
                echo "</pre>";
            }

        }
        echo "<hr>";



        echo "<h1>NEW</h1>";

        $customer = new Collection([
            'account_code'      => null,
            'api_custom'        => null,
            'api_id'            => null,
            'category_id'       => null,
            'city'              => 'Palaiseau',
            'civility'          => 'Mme',
            'company_name'      => date('Y-m-d H:i:s'),
            'country'           => 'France',
            'currency'          => 'EUR',
            'default_vat'       => '20',
            'discount'          => null,
            'email'             => null,
            'fax'               => null,
            'first_name'        => date('D'),
            'id'                => null,
            'individual'        => null,
            'language'          => 'fr',
            'last_invoiced_on'  => null,
            'last_name'         => date('F'),
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
            'zip_code'          => '91120'
        ]);

       $new = $this->save($customer);
       var_dump($new);
       echo "<hr>";

    }



    public function list()
    {
        $api = [
            'verb'   => $this->actions['list']['verb'],
            'action' => $this->actions['list']['action'],
            'output' => 'TEXT',
            'parameters' => ['FIRM_ID' => $this->firmId]
        ];

        return $this->callApi($api);
    }

    public function find($filter)
    {

    }

    public function get($id, $withInvoices=false)
    {
        $api = [
            'verb'   => $this->actions['details']['verb'],
            'action' => $this->actions['details']['action'],
            'output' => 'TEXT',
            'parameters' => [
                'FIRM_ID' => $this->firmId,
                'CUSTOMER_ID' => $id
            ]
        ];

        $detail = $this->callApi($api);
        if ($detail['success'] && $withInvoices) {
            $invoices = $this->getInvoices($id);
            if ($invoices['success']) {
                $detail['response']['invoices'] = $invoices['response'];
            }
        }
        return $detail;
    }

    public function save(Collection $customer)
    {
        $api = [
            'verb'   => $this->actions['create']['verb'],
            'action' => $this->actions['create']['action'],
            'output' => 'TEXT',
            'parameters' => [
                'FIRM_ID' => $this->firmId
            ],
            'data' => $customer->toArray()
        ];

        return $this->callApi($api);

    }

    public function getInvoices($id) {
        $api = [
            'verb'   => $this->actions['invoices']['verb'],
            'action' => $this->actions['invoices']['action'],
            'output' => 'TEXT',
            'parameters' => [
                'FIRM_ID' => $this->firmId,
                'CUSTOMER_ID' => $id
            ]
        ];

        return $this->callApi($api);
    }

}
