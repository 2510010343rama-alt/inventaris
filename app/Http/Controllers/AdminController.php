<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.beranda');
    }

    public function barang()
    {
        $data = Barang::paginate(2);

        return view('admin.barang.index', compact('data'));
    }

    public function tambah_barang()
    {
        return view('admin.barang.tambah');
    }

    public function edit_barang($id)
    {
        $data = Barang::find($id);
        return view('admin.barang.edit', compact('data'));
    }

    public function delete_barang($id)
    {
        Barang::find($id)->delete();

        // Reset ID kembali ke 1 jika seluruh data barang sudah habis
        if (Barang::count() === 0) {
            DB::statement('ALTER TABLE barang AUTO_INCREMENT = 1');
        }

        emotify('success', 'Berhasil Di Hapus');
        return back();
    }

    public function simpan_barang(Request $req)
    {
        // Pastikan ID mulai dari 1 jika tabel dalam keadaan kosong
        if (Barang::count() === 0) {
            DB::statement('ALTER TABLE barang AUTO_INCREMENT = 1');
        }

        Barang::create($req->all());
        notify()->success('Berhasil Disimpan');
        return redirect('/admin/barang');
    }

    public function update_barang(Request $req, $id)
    {
        Barang::find($id)->update($req->all());
        notify()->info('Berhasil Diupdate');
        return redirect('/admin/barang');
    }
}