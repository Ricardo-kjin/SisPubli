<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Inmueble;
use App\Publicacion;
use App\Tipopublicacion;
use App\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $publicacions=publicacion::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('publicacion.publicacion.index',['publicacions'=>$publicacions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd(2);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $inmueble=Inmueble::find($request->inmueble_id);
        $inmueble=Inmueble::find(5);
        // dd($inmueble->publicacions->isEmpty());
        // dd($request);
        //
        // throw ValidationException::withMessages([
        //     'num_publicacion'=>'No tiene publicaciones disponibles. Compre un plan para poder publicar'
        // ]);
        $fecha=date("d-m-Y");

        $data=request()->validate([
            'titulo' => 'required|max:255',
            'precio' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'tipopublicacion_id'=>'required|integer',
            'inmueble_id'=>'required|integer',
        ]);
        $UserNVentas=Auth::user()->notaventas;
        // dd(empty($UserNVentas));
        if (!empty($UserNVentas)) {
            foreach ($UserNVentas as $key => $value) {
                if (Auth::user()->cantidad_publicaciones>0 ) {
                    // dd($UserNVentas->first()->publicacions->count());
                    if ($value->oferta->numero_publicaciones>$value->publicacions->count() && $value->fecha_final>$fecha) {
                        # insertar a esta nota de venta

                        $numero_dias=$value->oferta->duracion;
                        // dd($numero_dias,date("d-m-Y",strtotime($fecha."+ $numero_dias days")));

                        $publicacion=new Publicacion();
                        $publicacion->fecha_inicio= $fecha;
                        $publicacion->fecha_fin= date("d-m-Y",strtotime($fecha."+ $numero_dias days"));
                        $publicacion->user_id= Auth::user()->id;
                        $publicacion->inmueble_id= $request->inmueble_id;
                        $publicacion->titulo= $request->titulo;
                        $publicacion->precio= $request->precio;
                        if ($request->duracion!=null) {
                            $publicacion->periodo= $request->duracion;
                        }
                        $publicacion->tipopublicacion_id= $request->tipopublicacion_id;
                        $publicacion->nota_venta_id= $value->id_nota_ventas;
                        $publicacion->save();
                        $numActual=Auth::user()->cantidad_publicaciones;
                        Auth::user()->cantidad_publicaciones=$numActual-1;
                        return redirect('/inmuebles');
                        // dd($value->id_nota_ventas,$publicacion);
                    }/*else {
                        throw ValidationException::withMessages([
                            'num_publicacion'=>'No tiene publicaciones disponibles. Compre un plan para poder publicar'
                        ]);
                    }*/
                }else {
                    throw ValidationException::withMessages([
                        'num_publicacion'=>'No tiene publicaciones disponibles. Compre un plan para poder publicar'
                    ]);
                    // dd(2);
                }
                // dd($key,$value);
            }
        } else {

            throw ValidationException::withMessages([
                'num_publicacion'=>'No tiene publicaciones disponibles. Compre un plan para poder publicar'
            ]);
            // dd($UserNVentas);
        }

        // dd($UserNVentas->first()->oferta->numero_publicaciones,$UserNVentas->first()->publicacions);
        // $tipo=Tipopublicacion::find($request->role);
        // dd($request->role,$tipo->nombre);
        // $publicacion=new Publicacion();
        // dd($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Publicacion $publicacion)
    {
        return view('publicacion.publicacion.show',['publicacion'=>$publicacion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Publicacion $publicacion)
    {
        // dd(empty($publicacion->periodo));
        $inmueble=Inmueble::find($publicacion->inmueble_id);
        $fotos=Foto::where('inmueble_id',$publicacion->inmueble_id)->paginate(3);
        $tipopublicaciones=Tipopublicacion::orderBy('id','asc')->get();
        return view('publicacion.publicacion.edit',['inmueble'=>$inmueble,'fotos'=>$fotos,'tipopublicacions'=>$tipopublicaciones,'publicacion'=>$publicacion]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publicacion $publicacion)
    {
        // dd($request,$publicacion);
        $data=request()->validate([
            'titulo' => 'required|max:255',
            'precio' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'tipopublicacion_id'=>'required|integer',
            'inmueble_id'=>'required|integer',
        ]);

        $publi=Publicacion::find($publicacion->id);
        // dd($request);
        $publi->titulo=$request->titulo;
        $publi->tipopublicacion_id=$request->tipopublicacion_id;
        $publi->precio=$request->precio;
        if ($request->tipopublicacion_id>1) {
            $publi->periodo=$request->duracion;
        }else{
            $publi->periodo=null;
        }
        // dd($publi);
        $publi->save();
        return redirect('/publicacions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicacion $publicacion)
    {
        //
        dd(7);
    }
        /**
     * Display the specified resource.
     *
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function crea(Inmueble $publicacion)
    {

        // dd($publicacion);
        $fotos=Foto::where('inmueble_id',$publicacion->id)->paginate(3);
        $tipopublicaciones=Tipopublicacion::orderBy('id','asc')->get();
        return view('publicacion.publicacion.crea',['inmueble'=>$publicacion,'fotos'=>$fotos,'tipopublicacions'=>$tipopublicaciones]);
    }

}
