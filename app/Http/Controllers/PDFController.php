<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Publicacion;
use App\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    //
    public function exportPDFFacturas(){
        $facturas=Factura::orderBy('id_facturas','desc')->get();
        $time = time();
        $fechas=date("d-m-Y (H:i)", $time);

        $pdf = PDF::loadView('pdf.facturas', ['facturas'=>$facturas,'fechas'=>$fechas]);
    	return $pdf->stream('list-facturas.pdf');
    }

    public function exportPDFFacturasUser(){
        $id=Auth::user()->id;
        $userfacturas=User::where('id',$id)->first();
        $time = time();
        $fechas=date("d-m-Y (H:i)", $time);

        $pdf = PDF::loadView('pdf.facturas', ['userfacturas'=>$userfacturas,'fechas'=>$fechas]);
    	return $pdf->stream('list-facturas.pdf');
    }

    public function exportPDFFactura($id){
        $factura=Factura::find($id);
        $time = time();
        $fechas=date("d-m-Y (H:i)", $time);

        $pdf = PDF::loadView('pdf.factura', ['factura'=>$factura,'fechas'=>$fechas]);
    	return $pdf->stream('facturaCliente.pdf');
    }

    public function exportPDFPublicaciones(){
        $publicacions=Publicacion::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $time = time();
        $fechas=date("d-m-Y (H:i)", $time);

        $pdf = PDF::loadView('pdf.Publicaciones', ['publicacions'=>$publicacions,'fechas'=>$fechas]);
    	return $pdf->stream('publicacionesCliente.pdf');
    }
}
