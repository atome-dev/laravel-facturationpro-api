<?php
namespace AtomeDev\FacturationProApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class FacturationProApi
{
    private $categories;
    protected $actions;

    private $apiUrl;
    private $accountId;
    private $accountKey;
    protected $firmId;
    private $userAgent;

    public function __construct()
    {
        $this->apiUrl     = config('facturation-pro-api.url');
        $this->accountId  = config('facturation-pro-api.id');
        $this->accountKey = config('facturation-pro-api.key');
        $this->firmId     = config('facturation-pro-api.firm');
        $this->userAgent  = config('facturation-pro-api.ua');

        $this->categories = [
            'customers' => FacturationProApiCustomer::class,
            'invoices' => FacturationProApiInvoices::class,
            'account' => FacturationProApiAccount::class,
            'assets' => FacturationProApiAssets::class,
        ];

    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function getAction($action)
    {
        return $this->actions[$action];
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
