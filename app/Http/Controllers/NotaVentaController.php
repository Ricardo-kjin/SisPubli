<?php

namespace App\Http\Controllers;

use App\Factura;
use App\NotaVenta;
use App\Oferta;
use App\TipoPagos;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaVentaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->id;
        $userfacturas=User::where('id',$id)->first();

        // dd($userfacturas->grupos->first()->nombre);
        if ($userfacturas->grupos->first()->nombre=='Particular') {
            $ofertas=Oferta::where('id_planes','<=','2')->where('estado',1)->orderBy('id_ofertas')->get();
            // dd($ofertas);
            return view('venta.notaventa.index',['ofertas'=>$ofertas]);
        }
        if ($userfacturas->grupos->first()->nombre=='Agente') {
            $ofertas=Oferta::where('id_planes','<=','3')->where('estado',1)->orderBy('id_ofertas')->get();
            // dd($ofertas);
            return view('venta.notaventa.index',['ofertas'=>$ofertas]);
        }
        if ($userfacturas->grupos->first()->nombre=='Empresa') {
            $ofertas=Oferta::where('id_planes','=','4')->where('estado',1)->orderBy('id_ofertas')->get();
            // dd($ofertas);
            return view('venta.notaventa.index',['ofertas'=>$ofertas]);
        }
        $ofertas=Oferta::where('estado',1)->orderBy('id_ofertas')->get();
            // dd($ofertas);
        return view('venta.notaventa.index',['ofertas'=>$ofertas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($var=Oferta::find($request->id_ofertas));
        //  dd($request);
        $data=request()->validate([
            'num_comprobante' => 'required',
            // 'area_terreno' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'tipopago' => 'required',
        ]);
        $oferta=Oferta::where('nombre','=',$request->nombre_oferta)->first();
        // dd($oferta->id_ofertas);
        // dd($oferta->costo * 0.13);
        // $time=new DateTime();
        //  dd($time->format('Y-m-d'));
        $factura=new Factura();
        $factura->fecha_emicion=$request->fecha_emicion;
        $factura->impuesto_iva=13;
        $factura->costo_bruto=$request->costo_bruto;
        $factura->costo_neto=$request->costo_neto;
        $factura->num_comprobante=$request->num_comprobante;
        $factura->id_tipo_pagos=$request->tipopago;
        $factura->num_factura=$request->num_factura;
        $factura->estado=1;
        //         dd($factura);
        $factura->save();

        $notaventa=new NotaVenta;
        $notaventa->fecha_inicio=$request->fecha_inicio;
        $notaventa->fecha_final=$request->fecha_fin;
        $notaventa->estado=1;
        $notaventa->id_usuarios=Auth::user()->id;
        $notaventa->id_facturas=Factura::orderBy('id_facturas', 'desc')->first()->id_facturas;
        $notaventa->id_ofertas=$oferta->id_ofertas;
        // dd($notaventa);
        $notaventa->save();

        $sum=0 + Auth::user()->cantidad_publicaciones;
        $id=Auth::user()->id;
        $userfacturas = User::find($id);
        $userfacturas->cantidad_publicaciones=$sum + $oferta->numero_publicaciones;
        $userfacturas->save();

        return redirect('/facturas');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotaVenta  $notaVenta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  dd($var=Oferta::find($request->id_ofertas));
        // dd($request);

        $oferta=Oferta::find($id);
        // dd($oferta->costo * 0.13);
        $time=new DateTime();
        //  dd($time->format('Y-m-d'));
        $factura=new Factura();

        $factura->fecha_emicion=$time->format('Y-m-d');
        $factura->impuesto_iva=$oferta->costo * 0.13;
        $factura->costo_bruto=$oferta->costo * 0.87;
        $factura->costo_neto=$oferta->costo;
        $factura->num_factura=uniqid();
        $factura->num_comprobante=uniqid();
        // dd($factura);
        $notaventa=new NotaVenta;
        $notaventa->fecha_inicio=date("d-m-Y");
        $notaventa->fecha_fin=date("d-m-Y",strtotime(date("d-m-Y")."+ "."$oferta->duracion"." days"));
        $notaventa->id_usuarios=Auth::user()->id;
        $notaventa->id_facturas=1;
        $notaventa->id_ofertas=$oferta->id_ofertas;

        $array=[
            'fecha_emicion'=>$time->format('Y-m-d'),//
            'impuesto_iva'=>$oferta->costo * 0.13,
            'costo_bruto'=>$oferta->costo * 0.87,
            'costo_neto'=>$oferta->costo,
            'num_factura'=>$factura->num_factura,//
            'fecha_inicio'=>date("d-m-Y"),
            'fecha_fin'=>date("d-m-Y",strtotime(date("d-m-Y")."+ "."$oferta->duracion"." days")),
            'nombre_oferta'=>$oferta->nombre,
            'duracion'=>$oferta->duracion,
            'descripcion'=>$oferta->descripcion,
            'numero_publicaciones'=>$oferta->numero_publicaciones,
            'usuario'=>Auth::user()->name,//
            'nit'=>Auth::user()->tipousuarios->nit_agente
        ];
        // dd($array);
        $tipopagos=TipoPagos::where('estado',1)->orderBy('id_tipo_pagos')->get();
        // dd($tipopagos);
        return view('venta.notaventa.show',['array'=>$array,'tipopagos'=>$tipopagos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotaVenta  $notaVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaVenta $notaVenta)
    {
        dd(2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaVenta  $notaVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaVenta $notaVenta)
    {
        dd(3);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotaVenta  $notaVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaVenta $notaVenta)
    {
        dd(6);
    }
}
