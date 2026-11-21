@extends('layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-1">Edit Data Barang</h1>
        <p class="mb-0 small" style="color: rgba(255, 255, 255, .75);">
            Perbarui informasi kode, nama, atau jumlah stok barang.
        </p>
    </div>
    <a href="/admin/barang" class="btn btn-secondary shadow-sm mt-3 mt-sm-0">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0">
                    <i class="fas fa-edit mr-2" style="color: #f59e0b;"></i>Form Edit Barang
                </h6>
            </div>
            <div class="card-body">
                <form method="post" action="/admin/barang/update/{{ $data->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="kode">Kode Barang <span class="text-danger">*</span></label>
                        <input type="text" id="kode" class="form-control" name="kode" value="{{ old('kode', $data->kode) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" id="nama" class="form-control" name="nama" value="{{ old('nama', $data->nama) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok <span class="text-danger">*</span></label>
                        <input type="number" id="stok" class="form-control" name="stok" value="{{ old('stok', $data->stok) }}" min="0" required>
                    </div>

                    <div class="pt-3 mt-4 d-flex flex-wrap align-items-center" style="border-top: 1px solid #e4e8f0; gap: .6rem;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Update Barang
                        </button>
                        <a href="/admin/barang" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0">
                    <i class="fas fa-tag mr-2" style="color: #2b4acb;"></i>Detail Saat Ini
                </h6>
            </div>
            <div class="card-body small">
                <div class="mb-3">
                    <div class="text-muted">ID Database</div>
                    <div class="font-weight-bold" style="color: #14213d;">#{{ $data->id }}</div>
                </div>
                <div class="mb-3">
                    <div class="text-muted">Kode Tersimpan</div>
                    <span class="badge mt-1" style="background: #f1f3f8; color: #14213d; border: 1px solid #d3d9e6; font-family: monospace;">
                        {{ $data->kode }}
                    </span>
                </div>
                <div>
                    <div class="text-muted">Stok Tersimpan</div>
                    <div class="font-weight-bold" style="color: #14213d;">{{ $data->stok }} unit</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection