<?php
namespace AtomeDev\FacturationProApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class FacturationProApiAccount extends FacturationProApi
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
        ];
    }
}
