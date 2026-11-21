@extends('layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-1">Tambah Barang</h1>
        <p class="mb-0 small" style="color: rgba(255, 255, 255, .75);">
            Masukkan informasi barang baru ke dalam database inventaris.
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
                    <i class="fas fa-plus-circle mr-2" style="color: #f59e0b;"></i>Form Tambah Barang
                </h6>
            </div>
            <div class="card-body">
                <form method="post" action="/admin/barang/simpan">
                    @csrf
                    <div class="form-group">
                        <label for="kode">Kode Barang <span class="text-danger">*</span></label>
                        <input type="text" id="kode" class="form-control" name="kode" value="{{ old('kode') }}" placeholder="Contoh: BRG-001" required autofocus>
                        <small class="form-text text-muted">Gunakan kode unik untuk memudahkan pencarian barang.</small>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" id="nama" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Kertas A4 80gsm" required>
                    </div>

                    <div class="form-group">
                        <label for="stok">Jumlah Stok Awal <span class="text-danger">*</span></label>
                        <input type="number" id="stok" class="form-control" name="stok" value="{{ old('stok') }}" placeholder="Contoh: 25" min="0" required>
                    </div>

                    <div class="pt-3 mt-4 d-flex flex-wrap align-items-center" style="border-top: 1px solid #e4e8f0; gap: .6rem;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Simpan Barang
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
                    <i class="fas fa-info-circle mr-2" style="color: #2b4acb;"></i>Panduan Pengisian
                </h6>
            </div>
            <div class="card-body">
                <ul class="pl-3 mb-0 text-muted small" style="line-height: 1.7;">
                    <li class="mb-2">Pastikan <strong>Kode Barang</strong> tidak tertukar dengan barang lain.</li>
                    <li class="mb-2">Tulis <strong>Nama Barang</strong> secara jelas beserta ukuran atau variannya jika ada.</li>
                    <li>Isi <strong>Stok</strong> dengan angka <code>0</code> atau lebih sesuai jumlah fisik di gudang.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection