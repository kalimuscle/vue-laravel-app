<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CryptoController extends Controller
{
    public function coins(Request $request){
        $response = Http::get('https://api.coingecko.com/api/v3/coins/list');

        return response()->json([
            "status" => 1,
            "data" => $response->body()
        ]);
    }
}
