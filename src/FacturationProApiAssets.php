<?php
namespace AtomeDev\FacturationProApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class FacturationProApiAssets extends FacturationProApi
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
        ];
    }
}
