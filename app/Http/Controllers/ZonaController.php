<?php

namespace App\Http\Controllers;

use App\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zonas=Zona::orderBy('id','desc')->get();
        return view('inmueble.zonas.index',['zonas'=>$zonas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inmueble.zonas.create');
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
            'empresa'=>'required|max:100',
            'descripcion'=>'required',
        ]);

        $zona=new Zona();
        $zona->nombre=$request->nombre;
        $zona->descripcion=$request->descripcion;
        $zona->url='prueba';
        $zona->save();
        return redirect('/zonas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function show(Zona $zona)
    {
        return view('inmueble.zonas.show',['zona'=>$zona]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function edit(Zona $zona)
    {
        return view('inmueble.zonas.edit',['zona'=>$zona]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zona $zona)
    {
        if (Gate::allows('isAdmin')) {
            $usuario=Auth::user()->id;
            dd('es administrador' . ':' .$usuario);
        }else {
            dd('no es administrador');
        }
        $request->validate([
            'nombre'=>'required|max:150',
            //'url'=>'required',
            'descripcion'=>'required',
        ]);
        $zona->nombre=$request->nombre;
        $zona->descripcion=$request->descripcion;
        //$zona->url=$request->descripcion;
        $zona->save();
        return redirect('/zonas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zona $zona)
    {
        $zona->delete();
        return redirect('/zonas');
    }
}
