<?php

namespace App\Http\Controllers;

use App\Oferta;
use App\Plane;
use Illuminate\Http\Request;

class OfertaController extends Controller
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
        $ofertas=Oferta::where('estado','1')->orderBy('id_ofertas','desc')->get();
        return view('venta.oferta.index',['ofertas'=>$ofertas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $planes=Plane::where('estado',1)->orderBy('id_planes')->get();
        return view('venta.oferta.create',['planes'=>$planes]);
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
            'nombre' => 'required|max:150',
            'costo' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'duracion' => 'required',
            'descripcion' => 'required|max:255',
            'numero_publicaciones' => 'required|integer',
            'plane' => 'required|integer',
        ]);
        $oferta=new Oferta();
        $oferta->nombre=$request->nombre;
        $oferta->duracion=$request->duracion;
        $oferta->costo=$request->costo;
        $oferta->numero_publicaciones=$request->numero_publicaciones;
        $oferta->descripcion=$request->descripcion;
        $oferta->id_planes=$request->plane;
        $oferta->estado=1;
        $oferta->save();
        // dd($oferta);
        return redirect('/ofertas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function show(Oferta $oferta)
    {
        return view('venta.oferta.show',['oferta'=>$oferta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function edit(Oferta $oferta)
    {
        $planes=Plane::where('estado',1)->orderBy('id_planes')->get();
        return view('venta.oferta.edit',['oferta'=>$oferta,'planes'=>$planes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oferta $oferta)
    {
        // dd($oferta,$request);
        $request->validate([
            'nombre' => 'required|max:150',
            'costo' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'duracion' => 'required',
            'descripcion' => 'required|max:255',
            'numero_publicaciones' => 'required|integer',
            'plane' => 'required|integer',
        ]);
        $oferta->nombre=$request->nombre;
        $oferta->duracion=$request->duracion;
        $oferta->costo=$request->costo;
        $oferta->numero_publicaciones=$request->numero_publicaciones;
        $oferta->descripcion=$request->descripcion;
        $oferta->id_planes=$request->plane;
        $oferta->save();
        // dd($oferta);
        return redirect('/ofertas');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oferta $oferta)
    {
        $oferta->estado=0;
        $oferta->save();
        return redirect('/ofertas');
    }
}
