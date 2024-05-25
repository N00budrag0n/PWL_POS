<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        $barang = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $this->storeImage($request->file('image')),
        ]);;
        return response()->json($barang, 201);
    }

    public function show(BarangModel $barang)
    {
        return response()->json($barang, 200);
    }

    public function update(Request $request, BarangModel $barang)
    {
        $barang->update($request->all());
        return response()->json($barang, 200);
    }

    public function destroy(BarangModel $barang)
    {
        $barang->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus'
        ]);
    }

    protected function storeImage ($image)
    {
        if(!$image){
            return null;
        }

        $originalFileName = $image->getClientOriginalName();
        $hashedFileName = Hash::make($originalFileName);
        $extension = $image->getClientOriginalExtension();
        $filepath = 'images/'.$hashedFileName.'.'.$extension;

        Storage::disk('public')->put($filepath, file_get_contents($image));

        return $filepath;
    }
}
