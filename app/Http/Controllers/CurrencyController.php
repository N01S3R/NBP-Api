<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://api.nbp.pl/api/exchangerates/tables/A?format=json');
        $response = json_decode($request->getBody(), true);
        $table = $response[0];
        foreach ($table['rates'] as $item) {
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
        $view = Currency::all();
        return view('currency.index')->with('response', $view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
