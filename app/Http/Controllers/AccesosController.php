<?php

namespace App\Http\Controllers;

use App\Acceso;
use Illuminate\Http\Request;

class AccesosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acceso=Acceso::where('estado','1')->orderBy('id_accesos')->get();
        return view('admin.accesos.index',['accesos'=>$acceso]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.accesos.create');
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
            'descripcion'=>'required|max:500',
        ]);

        $acceso=new Acceso();
        $acceso->nombre=$request->nombre;
        $acceso->descripcion=$request->descripcion;
        $acceso->estado=1;
        $acceso->save();
        return redirect('/accesos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function show(Acceso $acceso)
    {
        return view('admin.accesos.show',['acceso'=>$acceso]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Acceso $acceso)
    {
        return view('admin.accesos.edit',['acceso'=>$acceso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acceso $acceso)
    {
        // dd($acceso,$request);
        $request->validate([
            'nombre'=>'required|max:150',
            'descripcion'=>'required|max:500',
        ]);
        $acceso->nombre=$request->nombre;
        $acceso->descripcion=$request->descripcion;
        $acceso->save();
        return redirect('/accesos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Acceso  $acceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acceso $acceso)
    {
        $acceso->estado=0;
        $acceso->save();
        // $acceso->delete();
        return redirect('/accesos');
    }
}
