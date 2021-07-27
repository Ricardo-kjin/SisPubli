<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\TipoUsuario;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos=Grupo::where('estado','1')->orderBy('id_grupos')->get();
        return view('admin.agentes.create',  ['grupos'=>$grupos]);
    }
    public function agente()
    {
        return view('admin.agentes.registrarAg');
    }
    public function storeagent(Request $request)
    {
      //  dd($request);
      $time=new DateTime();
        $tipo=TipoUsuario::create([
            'profesion'=>$request['profesion'],
            'nit_agente'=>$request['nit_agente'],
            'nombre_empresa'=>'ND',
            'direccion_empresa'=>'ND',
            'registro_empresa' =>'ND',
            'telefono_empresa'=>'ND',
            'nit_empresa'=>'ND',
            'estado'=>'1',
        ]);

       User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
        'telefono' => $request['telefono'],
        'fecha_nac' => $time->format('Y-m-d'),
        'id_tipo_usuarios'=>$tipo->id,
        'estado'=>'1',
        ]);
        return redirect('/admin');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $time=new DateTime();
        $tipo=TipoUsuario::create([
            'profesion'=>$request['profesion'],
            'nit_agente'=>$request['nit_agente'],
            'nombre_empresa'=>'ND',
            'direccion_empresa'=>'ND',
            'registro_empresa' =>'ND',
            'telefono_empresa'=>'ND',
            'nit_empresa'=>'ND',
            'estado'=>'1',
        ]);

       $user=User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
        'telefono' => $request['telefono'],
        'fecha_nac' => $time->format('Y-m-d'),
        'id_tipo_usuarios'=>$tipo->id,
        'estado'=>'1',
        ]);
        $user->grupos()->attach($request->grupo);
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'profesion'=>'required|max:255',
            'nit_agente'=>'required',
        ]);
        $tipo=TipoUsuario::find($id);
        $user=User::find($id);
        //dd($user,$tipo);
        $tipo->profesion=$request->profesion;
        $tipo->nit_agente=$request->nit_agente;

        $tipo->save();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        if (!$user->grupos->isEmpty()) {
            $user->grupos()->dettach();
        }

        $user->save();
        $user->grupos()->attach($request->grupo);
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $tipo=TipoUsuario::find($user->id);
        //dd($tipo);
        $tipo->estado=0;
        $user->estado=0;

        $user->grupos()->detach();
        $tipo->save();
        $user->save();
        return redirect('/users');
    }
}
