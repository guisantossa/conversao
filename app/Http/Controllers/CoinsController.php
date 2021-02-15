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
    public function index($id = null)
    {
        $coins = Coin::all();
        $coin = Coin::findOrFail($id);
        return view('convert',['coins' => $coins, 'coin' =>$coin]);
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
        $json = file_get_contents('https://api.exchangeratesapi.io/latest?base='.$request->moeda_convertida);
        $rates = json_decode($json, true);
        $conta = $request->valor_original*$rates["rates"][$request->moeda_original];
        $coin = new Coin;
        $coin->user_id = auth()->user()->id;
        $coin->valor_original = $request->valor_original;
        $coin->valor_convertido = round($request->valor_original*$rates["rates"][$request->moeda_original],2);
        $coin->moeda_original = $request->moeda_original;
        $coin->moeda_convertida = $request->moeda_convertida;

        $coin->save();
        return redirect('/convert/'.$coin->id);
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
