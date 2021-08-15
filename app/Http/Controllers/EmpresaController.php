<?php

namespace App\Http\Controllers;

use App\TipoUsuario;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.empresas.create');
    }

    public function empresa()
    {
        return view('admin.empresas.registrarEm');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeemp(Request $request)
    {
        //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required',
            'nombre_empresa'=>'required|max:255',
            'direccion_empresa'=>'required|max:255',
            'registro_empresa'=>'required',
            'telefono_empresa'=>'required',
            'nit_empresa'=>'required',
        ]);

        $time=new DateTime();

        $tipo=TipoUsuario::create([
            'profesion'=>'ND',
            'nit_agente'=>'ND',
            'nombre_empresa'=>$request['nombre_empresa'],
            'direccion_empresa'=>$request['direccion_empresa'],
            'registro_empresa'=>$request['registro_empresa'],
            'telefono_empresa'=>$request['telefono_empresa'],
            'nit_empresa'=>$request['nit_empresa'],
            'estado'=>'1',
        ]);

        User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
        'telefono' => $request['telefono'],
        'fecha_nac' =>$time->format('Y-m-d'),
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
            'profesion'=>'ND',
            'nit_agente'=>'ND',
            'nombre_empresa'=>$request['nombre_empresa'],
            'direccion_empresa'=>$request['direccion_empresa'],
            'registro_empresa'=>$request['registro_empresa'],
            'telefono_empresa'=>$request['telefono_empresa'],
            'nit_empresa'=>$request['nit_empresa'],
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
            'nombre_empresa'=>'required|max:255',
            'direccion_empresa'=>'required|max:255',
            'registro_empresa'=>'required',
            'telefono_empresa'=>'required',
            'nit_empresa'=>'required',
        ]);
        $tipo=TipoUsuario::find($id);
        $user=User::find($id);
        //dd($user,$tipo);
        $tipo->nombre_empresa=$request->nombre_empresa;
        $tipo->direccion_empresa=$request->direccion_empresa;
        $tipo->registro_empresa=$request->registro_empresa;
        $tipo->telefono_empresa=$request->telefono_empresa;
        $tipo->nit_empresa=$request->nit_empresa;
        $tipo->save();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        if (!$user->grupos->isEmpty()) {
            $user->grupos()->detach();
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
        $tipo->save();
        $user->grupos()->detach();
        $user->save();
        return redirect('/users');
    }
}
