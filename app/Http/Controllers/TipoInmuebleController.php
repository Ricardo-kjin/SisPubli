<?php

namespace App\Http\Controllers;

use App\TipoInmueble;
use Illuminate\Http\Request;

class TipoInmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoinmuebles=TipoInmueble::orderBy('id')->get();
        return view('inmueble.tipoinmuebles.index',['tipoinmuebles'=>$tipoinmuebles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inmueble.tipoinmuebles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required|max:150',
            'descripcion'=>'required|max:700',
        ]);

        $tipoinmueble=new tipoinmueble();
        $tipoinmueble->nombre=$request->nombre;
        $tipoinmueble->descripcion=$request->descripcion;
        // $tipoinmueble->estado=1;
        $tipoinmueble->save();
        return redirect('/tipoinmuebles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoInmueble  $tipoInmueble
     * @return \Illuminate\Http\Response
     */
    public function show(TipoInmueble $tipoinmueble)
    {

        return view('inmueble.tipoinmuebles.show',['tipoinmueble'=>$tipoinmueble]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoInmueble  $tipoInmueble
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoInmueble $tipoinmueble)
    {
        // dd($tipoinmueble->id);
        return view('inmueble.tipoinmuebles.edit',['tipoinmueble'=>$tipoinmueble]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoInmueble  $tipoInmueble
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoInmueble $tipoinmueble)
    {
        $request->validate([
            'nombre'=>'required|max:150',
            'descripcion'=>'required|max:700',
        ]);
        $tipoinmueble->nombre=$request->nombre;
        $tipoinmueble->descripcion=$request->descripcion;
        $tipoinmueble->save();
        return redirect('/tipoinmuebles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipoinmueble  $tipoinmueble
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipoinmueble $tipoinmueble)
    {

        $tipoinmueble->delete();
        // $tipoinmueble->delete();
        return redirect('/tipoinmuebles');
    }
}
