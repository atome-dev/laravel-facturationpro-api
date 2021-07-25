<?php
namespace AtomeDev\FacturationProApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class FacturationProApiSettlements extends FacturationProApi
{
    public function __construct()
    {
        parent::__construct();
        $this->initActions();
    }

    /* Description of API structure */
    private function initActions()
    {
        // TODO
        $this->actions = [
        ];
    }
}
