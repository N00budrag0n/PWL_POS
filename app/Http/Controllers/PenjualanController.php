<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\UserModel;
use App\Models\BarangModel;

class PenjualanController extends Controller
{
    //// Menampilkan halaman awal penjualan
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan'; // set menu yang sedang aktif

        $user = UserModel::all();

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Ambil data penjualan dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
                    ->with('user');

        // Filter data penjualan berdasarkan user_id
        if ($request->user_id) {
                $penjualans->where('user_id', $request->user_id);
            }

        return DataTables::of($penjualans)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/penjualan/' . $penjualan->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/penjualan/' . $penjualan->penjualan_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/penjualan/'.$penjualan->penjualan_id).'">'. csrf_field() . method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"onclick="return confirm(\'Menghapus data ini akan menghapus seluruh data penjualan yang terkait. Apakah anda yakin?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    // Menampilkan halaman form tambah penjualan
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Form tambah penjualan'
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();

        $activeMenu = 'penjualan'; // set menu yang sedang aktif

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'penjualan_kode' => 'required|string|min:2|unique:t_penjualan,penjualan_kode',
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|min:3|max:100',
            'penjualan_tanggal' => 'required|date',
            'inputs.*.barang_id' => 'required|integer',
            'inputs.*.jumlah' => 'required|integer|min:1',
        ]);

        $penjualan = PenjualanModel::create([
            'penjualan_kode' => $request->penjualan_kode,
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        foreach ($request->inputs as $input) {
            $harga_jual = BarangModel::find($input['barang_id'])->harga_jual;
            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'barang_id' => $input['barang_id'],
                'jumlah' => $input['jumlah'],
                'harga' => $harga_jual,
            ]);
        }

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    public function show(string $id)
    {
        $detail = PenjualanDetailModel::with('barang', 'penjualan')->where('penjualan_id', $id)->get();

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Penjualan'
        ];

        $activeMenu = 'penjualan'; // set menu yang sedang aktif

        return view('penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'detail' => $detail, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $details = PenjualanDetailModel::with('barang', 'penjualan')->where('penjualan_id', $id)->get();
        $user = UserModel::all();
        $barang = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit penjualan'
        ];

        $activeMenu = 'penjualan'; // set menu yang sedang aktif

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'user' => $user, 'details' => $details, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'penjualan_kode' => 'required|string|min:2|unique:t_penjualan,penjualan_kode,'.$id.',penjualan_id',
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|min:3|max:100',
            'penjualan_tanggal' => 'required|date',
            'inputs.*.barang_id' => 'required|integer',
            'inputs.*.jumlah' => 'required|integer|gt:0',

        ]);

        PenjualanModel::find($id)->update([
            'penjualan_kode' => $request->penjualan_kode,
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        foreach ($request->inputs as $input) {
            PenjualanDetailModel::find($input['detail_id'])->update([
                'barang_id' => $input['barang_id'],
                'jumlah' => $input['jumlah'],
            ]);
        }
        if($request->news != null){
            foreach ($request->news as $new) {
                $check = PenjualanDetailModel::where('penjualan_id', $id)->where('barang_id', $new['barang_id'])->first();
                if ($check) {
                    PenjualanDetailModel::find($check->detail_id)->update([
                        'barang_id' => $new['barang_id'],
                        'jumlah' => $new['jumlah'],
                    ]);
                } else {
                    $harga_jual = BarangModel::find($new['barang_id'])->harga_jual;
                    PenjualanDetailModel::create([
                        'penjualan_id' => $id,
                        'barang_id' => $new['barang_id'],
                        'jumlah' => $new['jumlah'],
                        'harga' => $harga_jual,
                    ]);
                }
            }
        }
        // foreach ($request->news as $new) {
        //     $check = PenjualanDetailModel::where('penjualan_id', $id)->where('barang_id', $new['barang_id'])->first();
        //     if ($check) {
        //         PenjualanDetailModel::find($check->detail_id)->update([
        //             'barang_id' => $new['barang_id'],
        //             'jumlah' => $new['jumlah'],
        //         ]);
        //     } else {
        //         $harga_jual = BarangModel::find($new['barang_id'])->harga_jual;
        //         PenjualanDetailModel::create([
        //             'penjualan_id' => $id,
        //             'barang_id' => $new['barang_id'],
        //             'jumlah' => $new['jumlah'],
        //             'harga' => $harga_jual,
        //         ]);
        //     }
        // }



        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);
        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanDetailModel::where('penjualan_id', $id)->delete();
            PenjualanModel::destroy($id);

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terikat dengan data ini');
        }
    }
}
