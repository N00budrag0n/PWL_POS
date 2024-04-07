<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanDetailModel;

class PenjualanDetailController extends Controller
{
    public function destroy(string $id)
    {
        $check = PenjualanDetailModel::find($id);
        if (!$check) {
            return redirect()->back()->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanDetailModel::destroy($id);

            return redirect()->back()->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()->back()->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terikat dengan data ini');
        }
    }
}
