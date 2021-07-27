<?php

namespace App\Http\Controllers;

use App\Tipopago;
use App\TipoPagos;
use Illuminate\Http\Request;

class TipopagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipopagos=TipoPagos::where('estado',1)->orderBy('id_tipo_pagos','desc')->get();
        // dd($tipopagos);
        return view('venta.tipopago.index',['tipopagos'=>$tipopagos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venta.tipopago.create');
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
        $request->validate([
            'nombre'=>'required|max:150',
            'descripcion'=>'required|max:700',
        ]);

        $tipopago=new TipoPagos();
        $tipopago->nombre=$request->nombre;
        $tipopago->descripcion=$request->descripcion;
        $tipopago->estado=1;
        $tipopago->save();
        return redirect('/tipopagos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function show(TipoPagos $tipopago)
    {
        return view('venta.tipopago.create',['tipopago'=>$tipopago]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPagos $tipopago)
    {
        //
        return view('venta.tipopago.edit',['tipopago'=>$tipopago]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPagos $tipopago)
    {
        $request->validate([
            'nombre'=>'required|max:150',
            'descripcion'=>'required|max:700',
        ]);
        $tipopago->nombre=$request->nombre;
        $tipopago->descripcion=$request->descripcion;
        $tipopago->save();
        return redirect('/tipopagos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPagos $tipopago)
    {
        //
        $tipopago->estado=0;
        $tipopago->save();
        // $tipoinmueble->delete();
        return redirect('/tipopagos');
    }
}
