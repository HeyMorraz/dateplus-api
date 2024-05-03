<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class servicesController extends Controller
{
   
    public function index()
    {
        $servicios = Service::all();
        if($servicios->isEmpty()){
            $data=[
                'message'=>'No se encontarron servicios',
                'status'=> 200
            ];
            return response()->json($data,404);
        }
        return response()->json($servicios, 200);
    }

    
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'price'=> 'required',
            'type-price'=> 'required',
            'duration' => 'required',
            'observation' => ''

        ]);
        if($validator->fails()){
            $data = [
                'message'=> 'rellena los campos',
                'errors'=> $validator->errors(),
                'status'=> 400
            ];
            return response()->json($data, 400);
        }
        $servicios = Service::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'type-price' => $request->input('type-price'),
            'duration' => $request->duration,
            'observation' => $request->observation
        ]);

        if(!$servicios){
            $data =[
               'message'=> 'error al crear servicio',
               'status'=> 500
            ];
            return response()->json($data,500);

           
        }
        $data = [
            'servicios'=> $servicios,
            'status' => 201
        ];
        return response()->json($data, 201);
       
    }

    public function show( $id)
    {
        $servicio = Service::find($id);
       if(!$servicio){
        $data = [
            'message'=> 'servicio no encontrado',
            'status'=> 404
        ];
        return response()->json($data,404);
       }
       $data =[
        'servicio'=> $servicio,
        'status'=> 200
       ];
       return response()->json($data, 200);
    }

  
    public function update(Request $request, $id)
    {
        $servicio = Service::find($id);
       if(!$servicio){
        $data = [
            'message'=> 'servicio no encontrado',
            'status'=> 404
        ];
        return response()->json($data,404);
    }
       $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'price'=> 'required',
            'type-price'=> 'required',
            'duration' => 'required',
            'observation' => ''
       ]);

       if($validator->fails()){
          $data = [
            'message' => 'error en la validacion de los datos',
            'errors'=> $validator->errors(),
            'status'=>400
          ];
          return response()->json($data, 400);
       }
       $servicio->name = $request->name;
       $servicio->price = $request->name;
       $servicio->{'type-price'} = $request->input('type-price');
       $servicio->duration = $request->duration;
       $servicio->observation = $request->observation;

       $servicio->save();

       $data = [
        'message'=> 'servicio actualizado',
        'servicio'=> $servicio,
        'status'=> 200
       ];
       return response()->json($data,200);
    }

    
    public function destroy($id)
    {
        $servicio = Service::find($id);
        if(!$servicio){
         $data = [
             'message'=> 'servicio no encontrado',
             'status'=> 404
         ];
         return response()->json($data,404);
        }
       $servicio->delete();
       $data =[
        'message'=> 'servicio eliminado',
        'status'=>200
       ];

       return response()->json($data,200);
    }
}
