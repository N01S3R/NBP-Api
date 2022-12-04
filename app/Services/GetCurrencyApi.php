<?php

namespace App\Services;

use App\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class GetCurrencyApi
{

    protected $url = 'https://api.nbp.pl/api/exchangerates/tables/A?format=json';

    public function __construct(Client $client)
    {
        //
    }

    private function getCurrency()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get($this->url);
        $response = json_decode($request->getBody(), true);

        return $response[0];
    }
    private function saveCurrency(array $data)
    {
        foreach ($data['rates'] as $item) {
            $currency = Currency::where('currency_code', $item['code'])->first();
            if ($currency !== null) {
                $currency->update(['exchange_rate' => round($item['mid'], 2)]);
            } else {
                $currency = Currency::create([
                    'uuid' => Str::uuid(),
                    'name' => $item['currency'],
                    'currency_code' => $item['code'],
                    'exchange_rate' => round($item['mid'], 2),
                ]);
            }
        }
    }
    public function getData()
    {
        return $this->saveCurrency($this->getCurrency());
    }
}
