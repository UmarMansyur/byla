<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransferController extends Controller
{
    public function get_data() {
        $transfer = Transfer::with('saldo')->query();
        return DataTables::of($transfer)
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" class="edit btn btn-primary">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $transfer = Transfer::create($request->all());
        return response()->json(['message' => 'Transfer berhasil']);
    }

    public function update(Request $request, $id)
    {
        $transfer = Transfer::find($id);
        $transfer->update($request->all());
        return response()->json(['message' => 'Transfer berhasil']);
    }

    public function destroy($id)
    {
        $transfer = Transfer::find($id);
        $transfer->delete();
        return response()->json(['message' => 'Transfer berhasil']);
    }
    
}
