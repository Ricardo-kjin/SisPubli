<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Publicacion;
use App\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(2);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(3);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $publicacion=Publicacion::find($id);
        $seguimiento=new Seguimiento;
        $seguimiento->descripcion=2;
        $seguimiento->publicacion_id=$publicacion->id;
        $seguimiento->user_id=Auth::user()->id;
        $seguimiento->fechaseguimiento=date('d-m-Y');
        $seguimiento->save();
        // dd($publicacion,$seguimiento);
        $fotos=Foto::where('inmueble_id',$publicacion->inmueble->id)->paginate(3);
        // dd($fotos);
        return view('/show',['publicacion'=>$publicacion,'fotos'=>$fotos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function edit( $seguimiento)
    {
        dd(5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $seguimiento)
    {
        dd(6);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy( $seguimiento)
    {
        dd(7);
    }
}
