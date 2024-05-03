<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controllers;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class clientsController extends Controller
{
    
    public function index()
    {
        $clients = Client::all();
        if($clients->isEmpty()){
            $data=[
                'message'=>'No se encontarron clientes',
                'status'=> 200
            ];
            return response()->json($data,404);
        }
        return response()->json($clients, 200);
    }



  
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'surname'=> 'required',
            'phone'=> 'required',
            'email' => 'required',
            'address' => 'required'

        ]);
        if($validator->fails()){
            $data = [
                'message'=> 'rellena los campos',
                'errors'=> $validator->errors(),
                'status'=> 400
            ];
            return response()->json($data, 400);
        }
        $clients = Client::create([
            'name'=> $request->name,
            'surname'=> $request->surname,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        ]);

        if(!$clients){
            $data =[
               'message'=> 'error al crear cliente',
               'status'=> 500
            ];
            return response()->json($data,500);

           
        }
        $data = [
            'cliente'=> $clients,
            'status' => 201
        ];
        return response()->json($data, 201);
       

    }


    public function show( $id)
    {
        $clients = Client::find($id);
        if(!$clients){
         $data = [
             'message'=> 'cliente no encontrado',
             'status'=> 404
         ];
         return response()->json($data,404);
        }
        $data =[
         'clients'=> $clients,
         'status'=> 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request,  $id)
    {
        $clients = Client::find($id);
        if(!$clients){
         $data = [
             'message'=> 'cliente no encontrado',
             'status'=> 404
         ];
         return response()->json($data,404);
     }
        $validator = Validator::make($request->all(),[
             'name'=> 'required',
             'surname'=> 'required',
             'phone'=> 'required',
             'email' => 'required',
             'address' => 'required'
        ]);
 
        if($validator->fails()){
           $data = [
             'message' => 'error en la validacion de los datos',
             'errors'=> $validator->errors(),
             'status'=>400
           ];
           return response()->json($data, 400);
        }
        $clients->name = $request->name;
        $clients->surname = $request->surname;
        $clients->phone = $request->phone;
        $clients->email = $request->email;
        $clients->address = $request->address;
 
        $clients->save();
 
        $data = [
         'message'=> 'cliente actualizado',
         'clients'=> $clients,
         'status'=> 200
        ];
        return response()->json($data,200);
    }

    
    public function destroy( $id)
    {
        $clients = Client::find($id);
        if(!$clients){
         $data = [
             'message'=> 'cliente no encontrado',
             'status'=> 404
         ];
         return response()->json($data,404);
        }
       $clients->delete();
       $data =[
        'message'=> 'cliente eliminado',
        'status'=>200
       ];

       return response()->json($data,200);
    }
}
