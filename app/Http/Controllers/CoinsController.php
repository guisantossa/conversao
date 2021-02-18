<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coin;

class CoinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coins = Coin::orderBy("created_at", "DESC")->paginate(10);
        return view('convert',['coins' => $coins]);
    }

    public function show()
    {
        $coins = Coin::orderBy("created_at", "DESC")->paginate(20);
        return view('show',['coins' => $coins]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                
        $json = file_get_contents('https://api.exchangeratesapi.io/latest?base='.$request->moeda_original);
        $rates = json_decode($json, true);
        $conta = $request->valor_original*$rates["rates"][$request->moeda_convertida];
        
        $coin = new Coin;
        $coin->user_id = auth()->user()->id;
        $coin->valor_original = $request->valor_original;
        $coin->valor_convertido = round($conta,2);
        $coin->moeda_original = $request->moeda_original;
        $coin->moeda_convertida = $request->moeda_convertida;

        $coin->save();

        $coin->valor_original = number_format((double)$coin->valor_original, 2, ',', '.');
        $coin->valor_convertido = number_format((double)$coin->valor_convertido, 2, ',', '.');
        $coin->user_id = auth()->user()->name;
        return response()->json($coin);
    }
}
