<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Inmueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $urlimagenes=[];
        $id=$request->id_inmueble;
        // dd($urlimagenes);
        if ($request->hasFile('image')) {
            $urlimagenes=$request->file('image');
            foreach ($urlimagenes as $key => $value) {
                // dd($key,$value->getClientOriginalName());
                // obtener la imagen del formulario
                $fileNameWithTheExtension = $value->getClientOriginalName();

                //obtener el nombre del archivo
                $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);

                //obtener la extensión del archivo
                $extension = $value->getClientOriginalExtension();

                //crea un nuevo nombre para el archivo usando la marca de tiempo
                $newFileName = $fileName . '_' . time() . '.' . $extension;

                $img=new Foto();
                $img->img=$newFileName;
                $img->inmueble_id=$request->id_inmueble;
                // dd($img);
                //guardar la imagen en un directorio público en una carpeta separada
                // $path = request('image')->storeAs('public/images/portada_imagen_inmueble', $newFileName);
                $path = $value->storeAs('public/images/galeria_imagen_inmueble', $newFileName);
                $img->save();
            }
        }
        return redirect('/inmuebles/'. $id);
        // $inmuebles=Inmueble::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        // return view('inmueble.inmuebles.index',['inmuebles'=>$inmuebles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(4);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $foto)
    {
        dd(5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        dd(6);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foto $foto)
    {
        // dd($foto->inmueble->tipoinmueble->nombre);
        // $foto=Foto::find($foto->id);
        // dd($foto);
        $id=$foto->inmueble->id;
        $oldImage=public_path().'/storage/images/galeria_imagen_foto/'.$foto->img;

        if (file_exists($oldImage)) {
            # delete the image
            unlink($oldImage);
        }
        // $foto->servicios()->detach();

        // $ruta='/'. trim(strtolower($foto->inmueble->tipoinmueble->nombre)) . 's' ;
        // if ($foto->inmueble->tipoinmueble->nombre=='Particular') {
        //     $ruta='/inmuebles'.'/'.$foto->inmueble->id;
        // }else{

        //     $ruta=str_replace(' ', '', $ruta);
        // }
        // dd($ruta);

        //guardo
        $foto->delete();

        //redirecciono
        return redirect('/inmuebles/'. $id);
    }
}
