<?php

namespace App\Http\Controllers;

use App\Factura;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->id;
        $userfacturas=User::where('id',$id)->first();
        // $userfacturas->cantidad_publicaciones=0;
        // $userfacturas->save();
        // dd($userfacturas);
        //  dd($userfacturas->notaventas()->with('factura')->get());
        //  dd($userfacturas->notaventas->first()->factura);
        return view('venta.factura.index',['userfacturas'=>$userfacturas]);
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
        $factura=Factura::find($id);
        // dd($factura);
        // dd($factura->notaventa->oferta->plane);
        return view('venta.factura.show',['factura'=>$factura]);
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
    public function indexx(){
        $facturas=Factura::orderBy('id_facturas','desc')->get();
        return view('venta.factura.indexx',['facturas'=>$facturas]);
    }
}
