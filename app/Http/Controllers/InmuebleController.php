<?php

namespace App\Http\Controllers;

use App\Inmueble;
use App\Servicio;
use App\TipoInmueble;
use App\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //->where('proyecto_id',!null)
        $inmuebles=Inmueble::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('inmueble.inmuebles.index',['inmuebles'=>$inmuebles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zonas=Zona::orderBy('id')->get();
        $servicios=Servicio::orderBy('id')->get();
        // $tipoinmuebles=TipoInmueble::orderBy('id')->get();
        $proyectos=Inmueble::where('user_id',Auth::user()->id)->where('proyecto_id',null)->where('total_cupo','!=',null)->orderBy('id','desc')->get();
        // dd($proyectos);
        return view('inmueble.inmuebles.create',['zonas'=>$zonas,'servicios'=>$servicios,'proyectos'=>$proyectos]);
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
        // dd($request->image);
        $data=request()->validate([
            'direccion' => 'required|max:255',
            // 'area_terreno' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'area_construida' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'area_libre' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'pisos'=>'required|integer',
            'garajes'=>'required|integer',
            'descripcion'=>'required',
            'image'=>'required|image',
            // 'total_cupos'=>'required|integer',
            // 'cupo_ocupado'=>'required|integer',

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

        $tipoinm=TipoInmueble::where('nombre','like','%partamento%')->get();
        // dd($tipoinm->first()->id,$newFileName);

        $inmueble = new Inmueble();
        $inmueble->titulo = $request->titulo;
        $inmueble->direccion = $request->direccion;
        $inmueble->area_terreno = $request->area_construida+$request->area_libre;
        $inmueble->area_construida =$request->area_construida;
        $inmueble->area_libre=$request->area_libre;

        $inmueble->baños=$request->baños;
        $inmueble->habitaciones=$request->habitaciones;

        $inmueble->pisos=$request->pisos;
        $inmueble->garajes=$request->garajes;
        $inmueble->descripcion=$request->descripcion;
        // $inmueble->foto_principal=$request->foto_principal;
        // $inmueble->total_cupo=$request->total_cupos;
        // $inmueble->cupo_ocupado=$request->cupo_ocupado;
        $inmueble->foto_principal=$newFileName;
        $inmueble->zona_id=$request->zona;
        $inmueble->tipoinmueble_id=$tipoinm->first()->id;
        $inmueble->user_id=Auth::user()->id;
        $inmueble->proyecto_id=$request->proyecto;


        $inmueble->save();

        if($request->servicio != null){
            foreach ($request->servicio as $serv) {
                $inmueble->servicios()->attach($serv);
            }
        }
        // dd($inmueble->id);
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
        // dd($inmueble->proyecto);
        if ($inmueble->tipoinmueble_id=='1') {
            return view('inmueble.inmuebles.proyecto.show',['inmueble'=>$inmueble]);
        }
        if ($inmueble->tipoinmueble_id=='2') {
                return view('inmueble.inmuebles.apartamento.show',['inmueble'=>$inmueble]);
        }
        if ($inmueble->tipoinmueble_id=='3') {
            return view('inmueble.inmuebles.show',['inmueble'=>$inmueble]);
        }
        if ($inmueble->tipoinmueble_id=='4') {
            return view('inmueble.inmuebles.comercial.show',['inmueble'=>$inmueble]);
        }
        if ($inmueble->tipoinmueble_id=='5') {
            return view('inmueble.inmuebles.lote.show',['inmueble'=>$inmueble]);
        }
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
        $proyectos=Inmueble::where('user_id',Auth::user()->id)->where('proyecto_id',null)->where('total_cupo','!=',null)->orderBy('id','desc')->get();
        // dd($proyectos,$inmueble);
        // $tipoinmuebles=TipoInmueble::orderBy('id')->get();
        //  dd($inmueble->inmuebles->titulo);
        // $servicios=$inmueble->servicios;
        if ($inmueble->tipoinmueble_id=='1') {
                return view('inmueble.inmuebles.proyecto.edit',['inmueble'=>$inmueble,'servicios'=>$servicios,'zonas'=>$zonas]);
        }
        if ($inmueble->tipoinmueble_id=='2') {
            //$proyectos=Inmueble::where('user_id',Auth::user()->id)->where('proyecto_id',null)->where('total_cupo','!=',null)->orderBy('id','desc')->get();
            // dd($proyectos);
            return view('inmueble.inmuebles.apartamento.edit',['inmueble'=>$inmueble,'servicios'=>$servicios,'zonas'=>$zonas,'proyectos'=>$proyectos]);
        }
        if ($inmueble->tipoinmueble_id=='3') {
            //$proyectos=Inmueble::where('user_id',Auth::user()->id)->where('proyecto_id',null)->where('total_cupo','!=',null)->orderBy('id','desc')->get();
            return view('inmueble.inmuebles.edit',['inmueble'=>$inmueble,'servicios'=>$servicios,'zonas'=>$zonas,'proyectos'=>$proyectos]);
        }
        if ($inmueble->tipoinmueble_id=='4') {
            //$proyectos=Inmueble::where('user_id',Auth::user()->id)->where('proyecto_id',null)->where('total_cupo','!=',null)->orderBy('id','desc')->get();
            // dd($proyectos);
            return view('inmueble.inmuebles.comercial.edit',['inmueble'=>$inmueble,'servicios'=>$servicios,'zonas'=>$zonas,'proyectos'=>$proyectos]);
        }
        if ($inmueble->tipoinmueble_id=='5') {
            return view('inmueble.inmuebles.lote.edit',['inmueble'=>$inmueble,'servicios'=>$servicios,'zonas'=>$zonas,'proyectos'=>$proyectos]);
        }
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
        // dd($request);
        $data=request()->validate([
            'direccion' => 'required|max:255',
            // 'area_terreno' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'area_construida' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'area_libre' => 'required|numeric|regex:/^[\d]{0,8}(\.[\d]{1,2})?$/',
            'pisos'=>'required|integer',
            'garajes'=>'required|integer',
            'descripcion'=>'required',

            // 'total_cupo'=>'required|integer',
            // 'cupo_ocupado'=>'required|integer',

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


        $tipoinm=TipoInmueble::where('nombre','like','%partamento%')->get();
        // dd($tipoinm->first()->id,$newFileName);

        $inmueble->baños=$request->baños;
        $inmueble->habitaciones=$request->habitaciones;

        $inmueble->titulo = $request->titulo;
        $inmueble->direccion = $request->direccion;
        $inmueble->area_terreno = $request->area_construida + $request->area_libre;
        $inmueble->area_construida =$request->area_construida;
        $inmueble->area_libre=$request->area_libre;
        $inmueble->pisos=$request->pisos;
        $inmueble->garajes=$request->garajes;
        $inmueble->descripcion=$request->descripcion;
        // $inmueble->foto_principal=$request->foto_principal;
        // $inmueble->total_cupo=$request->total_cupo;
        // $inmueble->cupo_ocupado=$request->cupo_ocupado;
        // $inmueble->foto_principal=$newFileName;
        $inmueble->zona_id=$request->zona;
        $inmueble->tipoinmueble_id=$tipoinm->first()->id;
        $inmueble->proyecto_id=$request->proyecto;

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
    public function destroy(Request $request)
    {
        $inmueble=Inmueble::find($request->inmueble_id);
        // dd($inmueble);
        $oldImage=public_path().'/storage/images/portada_imagen_inmueble/'.$inmueble->foto_principal;

        if (file_exists($oldImage)) {
            # delete the image
            unlink($oldImage);
        }
        $inmueble->servicios()->detach();

        //guardo
        $inmueble->delete();

        //redirecciono
        return redirect('/inmuebles');
    }
}
