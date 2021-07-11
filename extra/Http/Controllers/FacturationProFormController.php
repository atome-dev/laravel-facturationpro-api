<?php

namespace App\Http\Controllers;

use AtomeDev\FacturationProApi\FacturationProApi;
use Illuminate\Http\Request;


class FacturationProFormController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        exit ('ok');
        return view('facturation-pro-form');
    }

    public function submit(Request $request)
    {
        $firmId = $request->get('firm-id') ?? null;
        $customerId = $request->get('customer-id') ?? null;
        $invoiceId = $request->get('invoice-id') ?? null;

        $FacturationApi = new FacturationProApi();

        $category = $request->get('category');
        $action = $request->get('action');

        $api = $FacturationApi->getApi($category, $action);

        if ($api === false) {
            return redirect()->back();
        }

        if ($api['parameters'] ?? false) {
            foreach ($api['parameters'] as $parameterName) {
                switch ($parameterName) {
                    case 'FIRM_ID':
                        $api['parameters']['FIRM_ID'] = $firmId ?? config('facturation-pro-api.firm');
                        break;

                    case 'CUSTOMER_ID':
                        $api['parameters']['CUSTOMER_ID'] = $customerId ?? '';
                        break;

                    case 'INVOICE_ID':
                        $api['parameters']['INVOICE_ID'] = $invoiceId ?? '';
                        break;
                }
            }
        }

        $result = $FacturationApi->callApi($api);

        return view('facturation-pro-api', compact('result', 'firmId', 'customerId', 'invoiceId'));
    }
}
