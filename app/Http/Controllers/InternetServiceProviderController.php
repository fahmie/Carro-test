<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\InternetServiceProviderInterface;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{
    public function getMptInvoiceAmount(Request $request, Mpt $internetServiceProvider)
    {
        $internetServiceProvider->setMonth($request->get('month') ?: 1);
        $amount = $internetServiceProvider->calculateTotalAmount();

        return response()->json([
            'data' => $amount,
        ]);
    }

    public function getOoredooInvoiceAmount(Request $request, Ooredoo $internetServiceProvider)
    {
        $internetServiceProvider->setMonth($request->get('month') ?: 1);
        $amount = $internetServiceProvider->calculateTotalAmount();

        return response()->json([
            'data' => $amount,
        ]);
    }
}
