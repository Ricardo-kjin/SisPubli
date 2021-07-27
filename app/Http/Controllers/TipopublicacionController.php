<?php

namespace App\Http\Controllers;

use App\Tipopublicacion;
use Illuminate\Http\Request;

class TipopublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipopublicacions=Tipopublicacion::orderBy('id')->get();
        return view('publicacion.tipopublicacion.index',['tipopublicacions'=>$tipopublicacions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publicacion.tipopublicacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nombre'=>'required|max:150',
            'descripcion'=>'required|max:700',
        ]);

        $tipopublicacion=new Tipopublicacion();
        $tipopublicacion->nombre=$request->nombre;
        $tipopublicacion->descripcion=$request->descripcion;
        // $tipopublicacion->estado=1;
        $tipopublicacion->save();
        return redirect('/tipopublicacions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipopublicacion  $tipopublicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Tipopublicacion $tipopublicacion)
    {
        return view('publicacion.tipopublicacion.show',['tipopublicacion'=>$tipopublicacion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipopublicacion  $tipopublicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipopublicacion $tipopublicacion)
    {
        return view('publicacion.tipopublicacion.edit',['tipopublicacion'=>$tipopublicacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipopublicacion  $tipopublicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipopublicacion $tipopublicacion)
    {
        $request->validate([
            'nombre'=>'required|max:150',
            'descripcion'=>'required|max:700',
        ]);
        $tipopublicacion->nombre=$request->nombre;
        $tipopublicacion->descripcion=$request->descripcion;
        $tipopublicacion->save();
        return redirect('/tipopublicacions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipopublicacion  $tipopublicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipopublicacion $tipopublicacion)
    {
        $tipopublicacion->delete();
        // $tipopublicacion->delete();
        return redirect('/tipopublicacions');
    }
}
