<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\TipoUsuario;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Builder\Use_;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=DB::table('users')
        ->join('tipo_usuarios','tipo_usuarios.id','=','users.id_tipo_usuarios')
        ->where('users.estado','=','1')
        ->orderBy('users.id','desc')
        //->where('tipo_usuarios.nit_empresa','=','ND')
        //->where('tipo_usuarios.nit_agente','=','ND')
        ->get();


        $usuarios=User::where('estado','1')->orderBy('id','desc')->get();

        // $us=User::find(10);
        // dd($us->tipousuarios);
        //  dd($usuarios);
        // dd($usuarios->find('8')->grupos);
        return view('admin.users.index',["users"=>$users,"usuarios"=>$usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos=Grupo::where('estado','1')->orderBy('id_grupos')->get();
        return view('admin.users.create',['grupos'=>$grupos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->grupo);

        //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);


        $tipo=TipoUsuario::create([
            'profesion'=>'Particular',
            'nit_agente'=>'ND',
            'nombre_empresa'=>'ND',
            'direccion_empresa'=>'ND',
            'registro_empresa' =>'ND',
            'telefono_empresa'=>'ND',
            'nit_empresa'=>'ND',
            'estado'=>'1',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telefono=$request->telefono;
        $user->fecha_nac=$request->fecha_nac;
        $user->id_tipo_usuarios=$tipo->id;
        $user->estado=1;
        $user->save();
        $user->grupos()->attach($request->grupo);
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $tipo=TipoUsuario::findOrFail($user->id);
        // $var=$user->grupos->first()->accesos;
        //  dd($user->tipousuarios->nit_agente,$var);
        if ($user->tipousuarios->nit_agente=='ND') {
            if ($user->tipousuarios->nit_empresa=='ND') {
                //dd($user);
                return view('admin.users.show',['user'=>$user]);
            }else{
                //dd($user,$tipo);
                return view('admin.empresas.show',['user'=>$user]);
            }
        } else {
            //dd($user,$tipo);
            return view('admin.agentes.show',['user'=>$user]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $tipo=TipoUsuario::findOrFail($user->id);
        $grupos=Grupo::where('estado','1')->orderBy('id_grupos','asc')->get();
        //  dd($grupos['0']->nombre,$user->grupos->first()->nombre);
//  dd($user->grupos->isEmpty());
        if ($tipo->nit_agente=='ND') {
            if ($tipo->nit_empresa=='ND') {
                //dd($user);
                return view('admin.users.edit',['user'=>$user,'grupos'=>$grupos]);
            }else{
                //dd($user,$tipo);
                return view('admin.empresas.edit',['user'=>$user,'tipo'=>$tipo,'grupos'=>$grupos]);
            }
        } else {
            //dd($user,$tipo);
            return view('admin.agentes.edit',['user'=>$user,'tipo'=>$tipo,'grupos'=>$grupos]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //  dd($request,$user->grupos->isEmpty());
                //validate the fields
                $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'password' => 'confirmed',
                ]);

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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user)
    {
        // $bitacora=new Bitacora();
        // $bitacora->accion="Elimino al usuario . $user->name ";
        // $time=new DateTime();
        // $bitacora->fecha=$time->format('Y-m-d');
        // /*
        // *   $ip=$bitacora->obtenerIp();
        // */
        // $bitacora->ip_usuario=$ip;
        // $bitacora->save();

        $tipo=TipoUsuario::find($user->id);
        //dd($tipo);

        $user->grupos()->detach();
        $tipo->estado=0;
        $user->estado=0;
        $tipo->save();
        $user->save();
        return redirect('/users');
    }
}
