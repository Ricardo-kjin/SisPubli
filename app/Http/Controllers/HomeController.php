<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Oferta;
use App\Publicacion;
use App\Seguimiento;
use App\Servicio;
use App\Tipopublicacion;
use App\Zona;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $publicacions=Publicacion::with('NotaVenta')->simplePaginate(6);
        // dd($publicacions->first()->user->name);
        // dd($publicacions);
        return view('welcome',['publicacions'=>$publicacions]);
    }

    public function ventas(Request $request)
    {
        // $var=$request->request;
        // dd($var);
        $filtro=[
            'precio'=>'100000',
            'zona'=>'',
            'baños'=>'100',
            'habitacion'=>'100',
            'pisos'=>'100',
            'garaje'=>'100',
        ];
        $filtros=[
            'precio'=>'',
            'zona'=>'',
            'baños'=>'',
            'habitacion'=>'',
            'pisos'=>'',
            'garaje'=>'',
        ];
        if (!empty($request->get('precio'))) {
            $filtro['precio']=trim($request->get('precio'));
            // dd($filtro['precio']);
        }
        if (!empty($request->get('baños'))) {
            $filtro['baños']=trim($request->get('baños'));
        }
        if (!empty($request->get('habitacion'))) {
            $filtro['habitacion']=trim($request->get('habitacion'));
        }
        if (!empty($request->get('pisos'))) {
            $filtro['pisos']=trim($request->get('pisos'));
        }
        if (!empty($request->get('garaje'))) {
            $filtro['garaje']=trim($request->get('garaje'));
        }
        if (!empty($request->get('zona'))) {
            $filtro['zona']=trim($request->get('zona'));
            // dd($filtro['zona']);
        }
        // dd($filtro['precio']);
        // dd($filtro['precio']);
        $tipopublicacions=Tipopublicacion::orderBy('id','desc')->get();
        $zonas=Zona::orderBy('id','desc')->get();
        $servicios=Servicio::orderBy('id','desc')->get();
        // dd($request);
        // $vent='ent';
        // $publicacions=Publicacion::whereHas('tipopublicacion', function (Builder $query) {
        //     $query->where('nombre', 'like', '%ent%');
        // })->simplePaginate(1);//->where('','','')->simplePaginate(1);
        $publicacions=DB::table('publicacions as pub')
                    ->join('tipopublicacions as tippub','pub.tipopublicacion_id','=','tippub.id')
                    ->join('inmuebles as in','pub.inmueble_id','=','in.id')
                    ->join('users as u','pub.user_id','=','u.id')
                    ->join('zonas as z','in.zona_id','=','z.id')
                    ->join('nota_ventas as ntaventa','pub.nota_venta_id','=','ntaventa.id_nota_ventas')
                    ->join('ofertas as o','ntaventa.id_ofertas','=','o.id_ofertas')
                    ->select('pub.id','pub.tipopublicacion_id','pub.nota_venta_id','pub.titulo','pub.precio','pub.fecha_inicio','u.name','in.foto_principal','in.direccion','in.titulo','in.descripcion')
                    // ->select('*')
                    ->where('tippub.nombre','like','%ent%')
                    ->where('pub.precio','<=',$filtro['precio'])
                    ->where('z.nombre','like','%'.$filtro['zona'].'%')
                    ->where('in.baños','<=',$filtro['baños'])//->orWhere('in.baños','=',null)
                    ->where('in.pisos','<=',$filtro['pisos'])//->orWhere('in.pisos','=',null)
                    ->where('in.garajes','<=',$filtro['garaje'])//->orWhere('in.garajes','=',null)
                    ->where('in.habitaciones','<=',$filtro['habitacion'])//->orWhere('in.habitaciones','=',null)
                    ->where('in.garajes','<=',$filtro['garaje'])//->orWhere('in.garajes','=',null)
                    ->orderBy('ntaventa.id_facturas','asc')
                    ->simplePaginate(2);
        // dd($publicacions);
        return view('ventas',['publicacions'=>$publicacions,'zonas'=>$zonas,'tipopublicacions'=>$tipopublicacions,'servicios'=>$servicios,'filtro'=>$filtros]);
    }

    /*
    // Retrieve posts with at least one comment containing words like foo%...
    $posts = App\Post::whereHas('comments', function (Builder $query) {
        $query->where('content', 'like', 'foo%');
    })->get();

    // Retrieve posts with at least ten comments containing words like foo%...
    $posts = App\Post::whereHas('comments', function (Builder $query) {
        $query->where('content', 'like', 'foo%');
    }, '>=', 10)->get();
    */
    public function show($id){

        $publicacion=Publicacion::find($id);
        $seguimiento=Seguimiento::where('user_id',$publicacion->user_id)->get();
        // dd($publicacion,count($seguimiento));
        $fotos=Foto::where('inmueble_id',$publicacion->inmueble->id)->paginate(3);
        // dd($fotos);
        return view('/show',['publicacion'=>$publicacion,'fotos'=>$fotos]);
    }

    public function plans(){
        $ofertas=Oferta::where('estado',1)->orderBy('id_ofertas')->get();
        // dd($ofertas);
        return view('planes',['ofertas'=>$ofertas]);
    }

    public function alquiler(Request $request)
    {
        // $var=$request->request;
        // dd($var);
        $filtro=[
            'precio'=>'100000',
            'zona'=>'',
            'baños'=>'100',
            'habitacion'=>'100',
            'pisos'=>'100',
            'garaje'=>'100',
        ];
        $filtros=[
            'precio'=>'',
            'zona'=>'',
            'baños'=>'',
            'habitacion'=>'',
            'pisos'=>'',
            'garaje'=>'',
        ];
        if (!empty($request->get('precio'))) {
            $filtro['precio']=trim($request->get('precio'));
            // dd($filtro['precio']);
        }
        if (!empty($request->get('baños'))) {
            $filtro['baños']=trim($request->get('baños'));
        }
        if (!empty($request->get('habitacion'))) {
            $filtro['habitacion']=trim($request->get('habitacion'));
        }
        if (!empty($request->get('pisos'))) {
            $filtro['pisos']=trim($request->get('pisos'));
        }
        if (!empty($request->get('garaje'))) {
            $filtro['garaje']=trim($request->get('garaje'));
        }
        if (!empty($request->get('zona'))) {
            $filtro['zona']=trim($request->get('zona'));
            // dd($filtro['zona']);
        }
        // dd($filtro['precio']);
        // dd($filtro['precio']);
        $tipopublicacions=Tipopublicacion::orderBy('id','desc')->get();
        $zonas=Zona::orderBy('id','desc')->get();
        $servicios=Servicio::orderBy('id','desc')->get();
        // dd($request);
        // $vent='ent';
        // $publicacions=Publicacion::whereHas('tipopublicacion', function (Builder $query) {
        //     $query->where('nombre', 'like', '%ent%');
        // })->simplePaginate(1);//->where('','','')->simplePaginate(1);
        $publicacions=DB::table('publicacions as pub')
                    ->join('tipopublicacions as tippub','pub.tipopublicacion_id','=','tippub.id')
                    ->join('inmuebles as in','pub.inmueble_id','=','in.id')
                    ->join('users as u','pub.user_id','=','u.id')
                    ->join('zonas as z','in.zona_id','=','z.id')
                    ->join('nota_ventas as ntaventa','pub.nota_venta_id','=','ntaventa.id_nota_ventas')
                    ->join('ofertas as o','ntaventa.id_ofertas','=','o.id_ofertas')
                    ->select('pub.id','pub.tipopublicacion_id','pub.nota_venta_id','pub.titulo','pub.precio','pub.fecha_inicio','u.name','in.foto_principal','in.direccion','in.titulo','in.descripcion')
                    // ->select('*')
                    ->where('tippub.nombre','like','%lquile%')
                    ->where('pub.precio','<=',$filtro['precio'])
                    ->where('z.nombre','like','%'.$filtro['zona'].'%')
                    ->where('in.baños','<=',$filtro['baños'])//->orWhere('in.baños','=',null)
                    ->where('in.pisos','<=',$filtro['pisos'])//->orWhere('in.pisos','=',null)
                    ->where('in.garajes','<=',$filtro['garaje'])//->orWhere('in.garajes','=',null)
                    ->where('in.habitaciones','<=',$filtro['habitacion'])//->orWhere('in.habitaciones','=',null)
                    ->where('in.garajes','<=',$filtro['garaje'])//->orWhere('in.garajes','=',null)
                    ->orderBy('ntaventa.id_facturas','asc')
                    ->simplePaginate(2);
        // dd($publicacions);
        return view('alquiler',['publicacions'=>$publicacions,'zonas'=>$zonas,'tipopublicacions'=>$tipopublicacions,'servicios'=>$servicios,'filtro'=>$filtros]);
    }

    public function anticretico(Request $request)
    {
        // $var=$request->request;
        // dd($var);
        $filtro=[
            'precio'=>'100000',
            'zona'=>'',
            'baños'=>'100',
            'habitacion'=>'100',
            'pisos'=>'100',
            'garaje'=>'100',
        ];
        $filtros=[
            'precio'=>'',
            'zona'=>'',
            'baños'=>'',
            'habitacion'=>'',
            'pisos'=>'',
            'garaje'=>'',
        ];
        if (!empty($request->get('precio'))) {
            $filtro['precio']=trim($request->get('precio'));
            // dd($filtro['precio']);
        }
        if (!empty($request->get('baños'))) {
            $filtro['baños']=trim($request->get('baños'));
        }
        if (!empty($request->get('habitacion'))) {
            $filtro['habitacion']=trim($request->get('habitacion'));
        }
        if (!empty($request->get('pisos'))) {
            $filtro['pisos']=trim($request->get('pisos'));
        }
        if (!empty($request->get('garaje'))) {
            $filtro['garaje']=trim($request->get('garaje'));
        }
        if (!empty($request->get('zona'))) {
            $filtro['zona']=trim($request->get('zona'));
            // dd($filtro['zona']);
        }
        // dd($filtro['precio']);
        // dd($filtro['precio']);
        $tipopublicacions=Tipopublicacion::orderBy('id','desc')->get();
        $zonas=Zona::orderBy('id','desc')->get();
        $servicios=Servicio::orderBy('id','desc')->get();
        // dd($request);
        // $vent='ent';
        // $publicacions=Publicacion::whereHas('tipopublicacion', function (Builder $query) {
        //     $query->where('nombre', 'like', '%ent%');
        // })->simplePaginate(1);//->where('','','')->simplePaginate(1);
        $publicacions=DB::table('publicacions as pub')
                    ->join('tipopublicacions as tippub','pub.tipopublicacion_id','=','tippub.id')
                    ->join('inmuebles as in','pub.inmueble_id','=','in.id')
                    ->join('users as u','pub.user_id','=','u.id')
                    ->join('zonas as z','in.zona_id','=','z.id')
                    ->join('nota_ventas as ntaventa','pub.nota_venta_id','=','ntaventa.id_nota_ventas')
                    ->join('ofertas as o','ntaventa.id_ofertas','=','o.id_ofertas')
                    ->select('pub.id','pub.tipopublicacion_id','pub.nota_venta_id','pub.titulo','pub.precio','pub.fecha_inicio','u.name','in.foto_principal','in.direccion','in.titulo','in.descripcion')
                    // ->select('*')
                    ->where('tippub.nombre','like','%ntic%')
                    ->where('pub.precio','<=',$filtro['precio'])
                    ->where('z.nombre','like','%'.$filtro['zona'].'%')
                    ->where('in.baños','<=',$filtro['baños'])//->orWhere('in.baños','=',null)
                    ->where('in.pisos','<=',$filtro['pisos'])//->orWhere('in.pisos','=',null)
                    ->where('in.garajes','<=',$filtro['garaje'])//->orWhere('in.garajes','=',null)
                    ->where('in.habitaciones','<=',$filtro['habitacion'])//->orWhere('in.habitaciones','=',null)
                    ->where('in.garajes','<=',$filtro['garaje'])//->orWhere('in.garajes','=',null)
                    ->orderBy('ntaventa.id_facturas','asc')
                    ->simplePaginate(2);
        // dd($publicacions);
        return view('anticretico',['publicacions'=>$publicacions,'zonas'=>$zonas,'tipopublicacions'=>$tipopublicacions,'servicios'=>$servicios,'filtro'=>$filtros]);
    }
}
