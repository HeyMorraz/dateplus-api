<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controllers;
use App\Models\DetailQuotes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class detailQuotesController extends Controller
{
    public function index()
    {
        $detailQuotes = DetailQuotes::all();
        return response()->json($detailQuotes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'dating_id' => 'required|exists:dating,id',
            'services_id' => 'required|exists:services,id',
        ]);

        $detailQuotes = DetailQuotes::create($request->all());
        return response()->json($detailQuotes, 201);
    }
}
