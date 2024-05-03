<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Dating;
// use App\Models\Users;
// use App\Models\Client;
use App\Models\DetailQuotes;
use Illuminate\Http\Request;

class datingController extends Controller
{
    
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        $datingData = $request->only(['date', 'hour', 'observation', 'users_id', 'clients_id']);

        $validator = Validator::make($datingData, [
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
            'observation' => 'required',
            'users_id' => 'required|exists:users,id',
            'clients_id' => 'required|exists:clients,id',
        ], [
            'users_id.exists' => 'El usuario seleccionado no es válido.',
            'clients_id.exists' => 'El cliente seleccionado no es válido.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dating = Dating::create($datingData);

        if ($request->has('detailQuotes')) {


            $detailQuotes = collect($request->detailQuotes)->map(function ($detailQuote) use ($dating) {
                return [
                    'services_id' => $detailQuote['services_id'],
                    'datings_id' => $dating->id,
                ];
            })->filter()->all();

            DetailQuotes::insert($detailQuotes);
        }

        return response()->json($dating, 201);
    }

    
    public function show(Dating $dating)
    {
        return response()->json($dating);
    }

   
    public function update(Request $request, Dating $dating)
    {
        $request->validate([
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
            'observation' => 'required',
            'users_id' => 'required|exists:users,id',
            'clients_id' => 'required|exists:clientes,id',
        ]);

        $dating->update($request->all());
        return response()->json($dating, 200);
    }

   
    public function destroy(Dating $dating)
    {
        $dating->delete();
        return response()->json(null, 204);
    }
}
