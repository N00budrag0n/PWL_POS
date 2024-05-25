<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\UserModel;
use App\Models\BarangModel;

class PenjualanController extends Controller
{
    public function index()
    {
        return PenjualanModel::all();
    }

    public function store(Request $request)
    {
        $penjualan = PenjualanModel::create([
            'penjualan_kode' => $request->penjualan_kode,
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);


            $harga_jual = BarangModel::find($request['barang_id'])->harga_jual;
            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'barang_id' => $request['barang_id'],
                'jumlah' => $request['jumlah'],
                'harga' => $harga_jual,
            ]);
        return response()->json($penjualan, 201);
    }

    public function show(string $id)
    {
        $detail = PenjualanDetailModel::with('barang', 'penjualan')->where('penjualan_id', $id)->get();
        return response()->json($detail, 200);
    }

    public function update(Request $request, PenjualanModel $penjualan)
    {
        $penjualan->update($request->all());
        return response()->json($penjualan, 200);
    }

    public function destroy(PenjualanModel $penjualan)
    {
        $penjualan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus'
        ]);
    }
}
