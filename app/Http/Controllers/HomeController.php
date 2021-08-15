<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Publicacion;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $publicacions=Publicacion::with('NotaVenta')->get();
        // dd($publicacions->first()->user->name);
        // dd($publicacions);
        return view('welcome',['publicacions'=>$publicacions]);
    }
    public function show($id){
        $publicacion=Publicacion::find($id);
        $fotos=Foto::where('inmueble_id',$publicacion->inmueble->id)->paginate(3);
        // dd($fotos);
        return view('/show',['publicacion'=>$publicacion,'fotos'=>$fotos]);
    }
}
