<?php

namespace App\Http\Controllers;

use App\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planes=Plane::where('estado','1')->orderBy('id_planes','desc')->get();
        return view('venta.planes.index',['planes'=>$planes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('venta.planes.create');
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

        $plane=new Plane();
        $plane->nombre=$request->nombre;
        $plane->descripcion=$request->descripcion;
        $plane->estado=1;
        $plane->save();
        return redirect('/planes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function show(Plane $plane)
    {
        return view('venta.planes.create',['plane'=>$plane]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function edit(Plane $plane)
    {
        return view('venta.planes.edit',['plane'=>$plane]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plane $plane)
    {
        $request->validate([
            'nombre'=>'required|max:150',
            'descripcion'=>'required|max:700',
        ]);
        $plane->nombre=$request->nombre;
        $plane->descripcion=$request->descripcion;
        $plane->save();
        return redirect('/planes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plane $plane)
    {
        $plane->estado=0;
        $plane->save();
        // $tipoinmueble->delete();
        return redirect('/planes');
    }
}
