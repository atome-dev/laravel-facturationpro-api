<?php

namespace App\Http\Livewire;

use AtomeDev\FacturationProApi\FacturationProApi;
use Livewire\Component;

class FacturationProForm extends Component
{
    public $apis;
    public $category = '';

    public $actions = [];
    public $action = '';

    public $options = [];

    public $orders = [];
    public $order = '';

    public $sorts = [];
    public $sort = '';

    public $parameters;

    public $result;



    public function mount()
    {
        // Retrieve the list of all available api
        $FacturationApi = new FacturationProApi();
        $this->apis = $FacturationApi->getApis();

        $this->firmId = config('facturation-pro-api.firm', '');
    }


    public function render()
    {
        return view('livewire.facturation-pro-form');
    }

    public function updatedCategory($value)
    {
        $this->actions = $this->apis[$value] ?? [];
        $this->action = "";
        $this->options = [];
        $this->orders = [];
        $this->order = "";
        $this->sorts = [];
        $this->sort = "";
        $this->parameters = [];

        //$this->needsFirmId = false;
        //$this->needsCustomerId = false;
        //$this->needsInvoiceId = false;

        $this->result = null;
    }

    public function updatedAction($value)
    {
        $this->options = $this->apis[$this->category][$value]['options'] ?? [];

        if (isSet($this->apis[$this->category][$value]['parameters'])) {
            foreach ($this->apis[$this->category][$value]['parameters'] as $paramName) {
                $this->parameters[$paramName] = '';
            }
        }

        $this->orders = $this->apis[$this->category][$value]['orders'] ?? [];
        $this->sorts = $this->apis[$this->category][$value]['sorts'] ?? [];

        $this->result = null;
    }

    public function callApi()
    {
        $FacturationApi = new FacturationProApi();
        $templateApi = $FacturationApi->getApi($this->category, $this->action);

        if ($templateApi === false) {
            return;
        }

        $api = [
            'verb' => $templateApi['verb'],
            'action' => $templateApi['action'],
            'output' => $templateApi['output'] ?? 'TEXT'
        ];

        if (count($this->parameters) > 0) {
            $api['parameters'] = $this->parameters;
        }


        /*
        if (isSet($templateApi['parameters'])) {

            if (array_key_exists('FIRM_ID', $templateApi['parameters'])) {
                $api['parameters']['FIRM_ID'] = $this->firmId ?? '';
            }

            if (array_key_exists('CUSTOMER_ID', $templateApi['parameters'])) {
                $api['parameters']['CUSTOMER_ID'] = $this->customerId ?? '';
            }

            if (array_key_exists('INVOICE_ID', $templateApi['parameters'])) {
                $api['parameters']['INVOICE_ID'] = $this->invoiceId ?? '';
            }
        }
        */
        if ($this->order != '' && $this->sort != '') {
            $api['order'] = $this->order;
            $api['sort'] = $this->sort;
        }

        if (is_array($this->options)) {
            foreach ($this->options as $k => $v) {
                if (is_array($v) && isSet($v['CHOICES'])) {
                    if ($v['VALUE']  != '') {
                        $api['data'][$k] = $v['VALUE'];
                    }
                } elseif ($v !== null) {
                    $api['data'][$k] = $v;
                }
            }
        }

        $this->result = $FacturationApi->callApi($api);
    }
}
