<?php

namespace App\Http\Livewire;

use AtomeDev\FacturationProApi\FacturationProApi;
use Livewire\Component;

class FacturationProForm extends Component
{
    public $categories;
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
        $this->categories = $FacturationApi->getCategories();
    }


    public function render()
    {
        return view('livewire.facturation-pro-form');
    }

    public function updatedCategory($category)
    {
        if (isSet($this->categories[$category])) {
            $Api = new $this->categories[$category];
            $this->actions = $Api->getActions();
        } else {
            $this->actions = [];
        }

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

    public function updatedAction($action)
    {
        $Api = new $this->categories[$this->category];
        //$this->actions = $Api->getActions();


        $this->options = $this->actions[$action]['options'] ?? [];

        if (isSet($this->actions[$action]['parameters'])) {
            foreach ($this->actions[$action]['parameters'] as $paramName) {
                switch ($paramName) {
                    case 'FIRM_ID':
                        $this->parameters[$paramName] = $this->firmId     = config('facturation-pro-api.firm');
                        break;


                        //$this->apiUrl     = config('facturation-pro-api.url');
                        //$this->accountId  = config('facturation-pro-api.id');
                        //$this->accountKey = config('facturation-pro-api.key');
                        //$this->userAgent  = config('facturation-pro-api.ua');

                    default:
                        $this->parameters[$paramName] = '';
                        break;
                }

            }
        }

        $this->orders = $this->actions[$action]['orders'] ?? [];
        $this->sorts = $this->actions[$this->category][$action]['sorts'] ?? [];

        $this->result = null;
    }

    public function callApi()
    {
        $templateApi = $this->actions[$this->action];

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

        $Api = new $this->categories[$this->category];
        $this->result = $Api->callApi($api);
    }
}
