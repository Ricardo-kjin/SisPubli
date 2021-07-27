<?php

namespace App\Http\Controllers;

use App\Acceso;
use App\Grupo;
use DateTime;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos=Grupo::where('estado','1')->orderBy('id_grupos','desc')->get();
        return view('admin.grupos.index', ['grupos'=>$grupos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accesos=Acceso::where('estado','1')->orderBy('id_accesos')->get();
        return view('admin.grupos.create',['accesos'=>$accesos]);
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
            'nombre_grupo'=>'required|max:150',
            'descripcion'=>'required|max:500',
        ]);

        // $time=new DateTime();
        $grupos=new Grupo;
        $grupos->nombre=$request['nombre_grupo'];
        $grupos->descripcion=$request['descripcion'];
        $grupos->estado='1';
        //  dd($grupos);
        $grupos->save();
        $listadeAccesos=$request->acceso;
        // dd($listadeAccesos);
        // $grupos->accesos()->detach();
        $grupos->save();
        if (!empty($request->acceso)) {
            foreach ($listadeAccesos as $index=>$value) {

                $grupos->accesos()->attach($value);

            }
        }
        // $listadeAccesos=explode(',',$request->accesos_grupos);
        // //dd($listadeAccesos);

        // //dd($accesos);
        // foreach ($listadeAccesos as $acceso) {
        //     if (trim($acceso)!=null || trim($acceso," \,")!=null) {
        //         $acce=new Acceso();
        //         $acce->nombre=trim($acceso);
        //         $acce->descripcion=trim($acceso) . ' ' . $time->format('Y-m-d');
        //         $acce->estado=1;
        //         $acce->save();
        //         $grupos->accesos()->attach($acce->id_accesos);

        //     }

        // }
        // $grupos=Grupo::find('6');
        // dd($grupos,$grupos->accesos());
        return redirect('/grupos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        return view('admin.grupos.show', ['grupo'=>$grupo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        // dd(sizeof($grupo->accesos));
        // dd(empty($grupo->accesos));
        // isset($grupo->accesos)
        // if (sizeof($grupo->accesos)==0) {
        //     dd('no tiene');
        // }
        // dd('Tiene acceso');
            $accesos=Acceso::where('estado','1')->orderBy('id_accesos')->get();
        return view('admin.grupos.edit', ['grupo'=>$grupo,'accesos'=>$accesos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
        // dd($request);
        //  dd($request->acceso,$grupo->accesos,empty($request->acceso),count($grupo->accesos)==0);
        $request->validate([
            'nombre'=>'required|max:150',
            'descripcion'=>'required|max:500',
        ]);

        $grupo->nombre=$request->nombre;
        $grupo->descripcion=$request->descripcion;

        $listadeAccesos=$request->acceso;
        // dd($listadeAccesos);
        $grupo->accesos()->detach();
        $grupo->save();
        if (!empty($request->acceso)) {
            foreach ($listadeAccesos as $index=>$value) {

                $grupo->accesos()->attach($value);

            }
        }
        return redirect('/grupos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        // dd($grupo);
        $grupo->estado=0;
        $grupo->save();
        return redirect('/grupos');
    }
}
