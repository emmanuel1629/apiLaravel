<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Hamcrest\Description;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //devolverè los datos en json
        $services = Service::all();
        return response()->json($services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $services = new Service();
        $services->name = $request->name;
        $services->description = $request->description;
        $services->price = $request->price;
        $services->save();
        $servicioCreado=[

            "mensaje"=>"servicioCreado",
            "servicio"=>$services
        ];
        return response()->json($servicioCreado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //

        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        $servicioActualizado=[
            

            "mensaje"=>"servicio Actualizado",
            "servicio"=>$service
        ];
        return response()->json($servicioActualizado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        $service->delete();

        $servicioEliminado=[

            "mensaje"=>"servicio Eliminado",
            "servicio"=>$service
        ];

        return response()->json($servicioEliminado);
    }

    
    //crear una funcion que reciba un objeto tipo peticion y uno tipo Servicee
    //para enviar desde postman el servicio que deseamos incluirle al cliente
    //
    public function clients(Request $request )
    {
        $service= Service::find($request->service_id);
        $clients = $service->clients;
        $datos=
        [
            "mensaje"=>"Servicio agregado correctamente",
            "cliente"=>$clients,
        ]; 
        return response()->json($datos);

    }
  
    
}
