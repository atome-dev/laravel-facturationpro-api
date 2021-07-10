<?php
namespace AtomeDev\FacturationProApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class FacturationProApi
{
    private $apis;

    private $apiUrl;
    private $accountId;
    private $accountKey;
    private $firmId;
    private $userAgent;

    public function __construct()
    {
        $this->apiUrl     = config('facturation-pro-api.url');
        $this->accountId  = config('facturation-pro-api.id');
        $this->accountKey = config('facturation-pro-api.key');
        $this->firmId     = config('facturation-pro-api.firm');
        $this->userAgent  = config('facturation-pro-api.ua');

        $this->initApis();
    }

    /* Description of API structure */
    private function initApis()
    {
        $this->apis = [
            'customers' => [
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

            ],
            'invoices' => [
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

            ],
            'account' => [
                'infos' => [
                    'label' => __('Account informations'),
                    'action' => '/account.json',
                    'verb' => 'GET'
                ],
                'orders' => [
                    'label' => __('Account orders'),
                    'action' => '/firms/FIRM_ID/orders.json',
                    'verb' => 'GET',
                    'parameters' => ['FIRM_ID'],
                ],
            ],
            'assets' => [
                'delete' => [
                    'label' => __('File delete'),
                    'action' => '/firms/FIRM_ID/assets/FILE_ID.json',
                    'verb' => 'DELETE',
                    'parameters' => ['FIRM_ID', 'FILE_ID'],
                ],
                'orders' => [
                    'label' => __('Account orders'),
                    'action' => '/firms/FIRM_ID/orders.json',
                    'verb' => 'GET',
                    'parameters' => ['FIRM_ID'],
                ],
            ],
            /* TODO
            'quotes' => [],
            'settlements' => [],
            'suppliers' => [],
            'purchases' => [],
            */
        ];


    }


    public function getApis()
    {
        return $this->apis;
    }

    public function getApi($category, $action)
    {
        return $this->apis[$category][$action] ?? false;
    }



    public function callApi($api)
    {
        $action = $api['action'];

        if ($api['parameters'] ?? false) {
            foreach ($api['parameters'] as $k => $v) {
                $action = str_replace($k, $v, $action);
            }
        }
        $url = $this->apiUrl . $action;

        $client = new Client();

        $parameters = [
            'auth' => [$this->accountId, $this->accountKey],
            'verify' => false,
        ];

        if (($api['output'] ?? 'JSON') === 'FILE') {
            $parameters['Content-Type'] = 'application/pdf';
            $response = $client->request($api['verb'], $url, $parameters);

            $pdf = $response->getBody()->getContents();

            header('Content-Type: application/pdf');
            echo $pdf;
            exit;

        }

        if (isset($api['order']) && $api['order'] != '') {
            $parameters['query']['order'] = $api['order'];
            $parameters['query']['sort'] = $api['sort'];
        }

        if (isset($api['data']) && is_array($api['data'])) {

            if (in_array($api['verb'], ['POST', 'PUT', 'PATCH'])) {
                $parameters['Accept'] = 'application/json';
                $parameters['json'] = $api['data'];
            } else {
                foreach ($api['data'] as $k => $v) {
                    $parameters['query'][$k] = $v;
                }
            }
        }

        $parameters['Content-Type'] = 'application/json';
        //var_dump($api['verb']);
        //var_dump($url);
        //var_dump($parameters);

        $ret = [
            'request' => [
                'verb' => $api['verb'],
                'url' => $url,
                'parameters' => $parameters
            ],
            'success' => false
        ];

        try {

            $response = $client->request($api['verb'], $url, $parameters);
            //print_r(json_decode($response->getBody(), true));
        } catch (ClientException $e) {
            $ret['error'] = $e->getMessage();
            return $ret;
        }

        $json = (string) $response->getBody();
        $status = $response->getStatusCode();

        $ret['response'] = json_decode($json, true);

        if (in_array($status, [200, 201])) {
            $ret['success'] = true;
        } else {
            $ret['error'] = "Error {$status}";
        }

        return $ret;
    }

}
