<?php

namespace App\Http\Controllers;

use App\Inmueble;
use App\Servicio;
use App\TipoInmueble;
use App\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inmuebles=Inmueble::where('user_id',Auth::user()->id)->where('proyecto_id',null)->orderBy('id','desc')->get();
        return view('inmueble.inmuebles.index',['inmuebles'=>$inmuebles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Auth::user()->name);
        $zonas=Zona::orderBy('id')->get();
        $servicios=Servicio::orderBy('id')->get();
        $tipoinmuebles=TipoInmueble::orderBy('id')->get();
        return view('inmueble.inmuebles.proyecto.create',['zonas'=>$zonas,'servicios'=>$servicios,'tipoinmuebles'=>$tipoinmuebles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->image);
        $data=request()->validate([
            'direccion' => 'required|max:255',
            'area_terreno' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'area_construida' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'area_libre' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'pisos'=>'required|integer',
            'garajes'=>'required|integer',
            'descripcion'=>'required',
            'image'=>'required|image',
            'total_cupos'=>'required|integer',
            'cupo_ocupado'=>'required|integer',

        ]);

        //get the image from the form
        $fileNameWithTheExtension = request('image')->getClientOriginalName();

        //get the name of the file
        $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);

        //get extension of the file
        $extension = request('image')->getClientOriginalExtension();

        //create a new name for the file using the timestamp
        $newFileName = $fileName . '_' . time() . '.' . $extension;

        //save the iamge onto a public directory into a separately folder
        $path = request('image')->storeAs('public/images/portada_imagen_inmueble', $newFileName);

        $tipoinm=TipoInmueble::where('nombre','like','%royecto%')->get();
        // dd($tipoinm->first()->id,$newFileName);

        $proyecto = new Inmueble();
        $proyecto->titulo = $request->titulo;
        $proyecto->direccion = $request->direccion;
        $proyecto->area_terreno = $request->area_terreno;
        $proyecto->area_construida =$request->area_construida;
        $proyecto->area_libre=$request->area_libre;
        $proyecto->pisos=$request->pisos;
        $proyecto->garajes=$request->garajes;
        $proyecto->descripcion=$request->descripcion;
        // $proyecto->foto_principal=$request->foto_principal;
        $proyecto->total_cupo=$request->total_cupos;
        $proyecto->cupo_ocupado=$request->cupo_ocupado;
        $proyecto->foto_principal=$newFileName;
        $proyecto->zona_id=$request->zona;
        $proyecto->tipoinmueble_id=$tipoinm->first()->id;
        $proyecto->user_id=Auth::user()->id;


        $proyecto->save();

        if($request->servicio != null){
            foreach ($request->servicio as $serv) {
                $proyecto->servicios()->attach($serv);
            }
        }
        // dd($proyecto->id);
        // $id=$proyecto->id;
        return redirect('/inmuebles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function show(Inmueble $inmueble)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function edit(Inmueble $inmueble)
    {
        $zonas=Zona::orderBy('id')->get();
        $servicios=Servicio::orderBy('id')->get();
        // $tipoinmuebles=TipoInmueble::orderBy('id')->get();


        return view('inmueble.inmuebles.proyecto.edit',['zonas'=>$zonas,'servicios'=>$servicios,'inmueble'=>$inmueble]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->image!=null);
        $data=request()->validate([
            'direccion' => 'required|max:255',
            'area_terreno' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'area_construida' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'area_libre' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'pisos'=>'required|integer',
            'garajes'=>'required|integer',
            'descripcion'=>'required',

            'total_cupo'=>'required|integer',
            'cupo_ocupado'=>'required|integer',

        ]);
        $inmueble = Inmueble::findOrFail($id);
        if ($request->image!=null) {
            # code...
            $oldImage=public_path().'/storage/images/portada_imagen_inmueble/'.$inmueble->foto_principal;

            if (file_exists($oldImage)) {
                # delete the image
                unlink($oldImage);
            }
                    //get the image from the form
            $fileNameWithTheExtension = request('image')->getClientOriginalName();

            //get the name of the file
            $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);

            //get extension of the file
            $extension = request('image')->getClientOriginalExtension();

            //create a new name for the file using the timestamp
            $newFileName = $fileName . '_' . time() . '.' . $extension;

            //save the iamge onto a public directory into a separately folder
            $path = request('image')->storeAs('public/images/portada_imagen_inmueble', $newFileName);
            $inmueble->foto_principal=$newFileName;
        }



        $tipoinm=TipoInmueble::where('nombre','like','%royecto%')->get();
        // dd($tipoinm->first()->id,$newFileName);

        $inmueble->titulo = $request->titulo;
        $inmueble->direccion = $request->direccion;
        $inmueble->area_terreno = $request->area_terreno;
        $inmueble->area_construida =$request->area_construida;
        $inmueble->area_libre=$request->area_libre;
        $inmueble->pisos=$request->pisos;
        $inmueble->garajes=$request->garajes;
        $inmueble->descripcion=$request->descripcion;
        // $inmueble->foto_principal=$request->foto_principal;
        $inmueble->total_cupo=$request->total_cupo;
        $inmueble->cupo_ocupado=$request->cupo_ocupado;
        // $inmueble->foto_principal=$newFileName;
        $inmueble->zona_id=$request->zona;
        $inmueble->tipoinmueble_id=$tipoinm->first()->id;

        $inmueble->save();
        $inmueble->servicios()->detach();
        if($request->servicio != null){
            foreach ($request->servicio as $serv) {
                $inmueble->servicios()->attach($serv);
            }
        }
        // dd($inmueble->servicios);
        // $post->title = request('title');
        // $post->content = request('post_content');
        // $post->image_url = $newFileName;

        // $post->save();
        return redirect('/inmuebles');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inmueble $inmueble)
    {
        //
    }
}
