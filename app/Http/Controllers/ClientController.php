<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClienteServicio;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //devolverè los datos en json
        $clients = Client::all();
        $array=[];

        foreach ($clients as $client) 
        {   
            $array[] =
            [
                "id" =>  $client->id,
                "name"=>  $client->name,
                "email"=>  $client->email,
                "addres"=>  $client->addres,
                "phone" =>  $client->phone,
                "services"=>  $client->services
            ];

        }
        return response()->json($array);
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
        $client= new Client;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->addres = $request->addres;
        $client->phone = $request->phone;
        $client->save();

        $datosCreados =
        [
            'mensaje'=>'cliente creado satisfactoriamente',
            'client'=>$client
        ] ;

        
        return response()->json($datosCreados);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
        $data =[
            "cliente"=>$client,
            "services"=>$client->services
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        
       
        $client->name = $request->name;
        $client->email = $request->email;
        $client->addres = $request->addres;
        $client->phone = $request->phone;
        $client->save();
        
        $datosActualizados = [
            'mensaje'=>'client actualizado satisfactoriamente',
            'client'=>$client
        ];

        return response()->json($datosActualizados);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
        $client->delete();
        $datosEliminados = [
            'mensaje'=>'client eliminado satisfactoriamente',
            'client'=>$client
        ];

        return response()->json($datosEliminados);
    }

    //crear una funcion que reciba un objeto tipo peticion y uno tipo cliente
    //para enviar desde postman el servicio que deseamos incluirle al cliente
    //
    public function attach(Request $request )
    {
        $client= Client::find($request->client_id);
        $client->services()->attach($request->service_id);
        $servicioAgregado=
        [
            "mensaje"=>"Servicio agregado correctamente",
            "cliente"=>$client,
        ]; 
        return response()->json($servicioAgregado);

    }
  
        //
    public function detach(Request $request )
    {
        $client= Client::find($request->client_id);
        $client->services()->detach($request->service_id);
        $servicioEliminado=
        [
            "mensaje"=>"Servicio eliminado correctamente",
            "cliente"=>$client,
        ]; 
        return response()->json($servicioEliminado);

    }
      
}
