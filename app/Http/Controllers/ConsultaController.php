<?php

namespace App\Http\Controllers;

use App\Consulta;
use App\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $consultas = Consulta::select('consultas.*', DB::raw('count(consultas.id) as connections'))
        //         ->leftJoin('publicacions as pub', 'consultas.publicacion_id', '=', 'pub.id')
        //         ->groupBy('consultas.id')
        //         ->get();
        // $consul=Consulta::publicacion->where()->get();
        $consultas=DB::table('consultas as con')
            ->join('publicacions as pub','con.publicacion_id','=','pub.id')
            ->join('users as u','pub.user_id','=','u.id')
            ->select('con.*','pub.user_id','pub.titulo')
            ->where('pub.user_id',Auth::user()->id)
            // ->where('con.leido',1)
            ->get();
            /*$consulta = DB::table('consultas')
            ->select(DB::raw('count(*) as consulta_count, leido'))
            ->where('leido', '=', 1)
            ->groupBy('leido')
            ->get();

            */
            // dd($consultas);
            return view('notificaciones.consultas.index',['consultas'=>$consultas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(1);
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
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
         $consulta->leido=0;
         $consulta->save();
        // $consultas=DB::table('consultas as con')
        // ->join('publicacions as pub','con.publicacion_id','=','pub.id')
        // ->join('inmuebles as in','pub.inmueble_id','=','in.id')
        // ->select('con.*','pub.titulo as pub_titulo','in.titulo')
        // ->where('pub.user_id',Auth::user()->id)
        // ->get();
        // dd($consulta);
        return view('notificaciones.consultas.show',['consulta'=>$consulta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Consulta $consulta)
    {
        dd(3);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consulta)
    {
        dd(4);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consulta $consulta)
    {
        dd(5);
    }
    public function consulta($id)
    {
        // dd($id);
        $publicacion=Publicacion::find($id);
        // dd($publicacion);
        return view('contact',['publicacion'=>$publicacion]);
    }
    public function storecon(Request $request)
    {
        $data=request()->validate([
            'nombre'=>'required',
            'email'=>'required',
            'telefono'=>'required',
            'mensaje'=>'required',
        ]);
        $publicacion=Publicacion::find($request->publicacion_id);
        $mesaje=new Consulta();
        $mesaje->nombre=$request->nombre;
        $mesaje->email=$request->email;
        $mesaje->telefono=$request->telefono;
        $mesaje->descripcion=$request->mensaje;
        $mesaje->publicacion_id=$request->publicacion_id;
        $mesaje->fechaconsulta=date('d-m-Y');
        $mesaje->leido=1;
        $mesaje->save();
        // dd($request,$mesaje);
        // dd($publicacion);
        return redirect('/');
    }
}
