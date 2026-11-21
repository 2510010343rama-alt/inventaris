@extends('layouts.master')

@section('content')
<style>
    /* Kartu statistik atas */
    .inv-stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.15rem 1.35rem;
        box-shadow: 0 1px 2px rgba(20, 33, 61, .05), 0 10px 26px -10px rgba(20, 33, 61, .16);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform .18s ease, box-shadow .18s ease;
        height: 100%;
    }
    .inv-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 30px -10px rgba(20, 33, 61, .22);
    }
    .inv-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    /* Ikon item di tabel */
    .item-avatar {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        background: linear-gradient(135deg, #14213d 0%, #243b6b 100%);
        color: #f59e0b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .95rem;
        flex-shrink: 0;
        box-shadow: 0 4px 10px -2px rgba(20, 33, 61, .25);
    }

    /* Tombol aksi lembut */
    .btn-action-edit {
        background: #fff4dc;
        color: #8a5200;
        border: 1px solid #fde2a3;
        border-radius: 10px;
        padding: .38rem .72rem;
        font-weight: 700;
        font-size: .8rem;
        transition: all .15s ease;
    }
    .btn-action-edit:hover {
        background: #f59e0b;
        color: #14213d;
        border-color: #f59e0b;
        transform: translateY(-1px);
    }
    .btn-action-delete {
        background: #fdecec;
        color: #9b1c21;
        border: 1px solid #f9c6c9;
        border-radius: 10px;
        padding: .38rem .72rem;
        font-weight: 700;
        font-size: .8rem;
        transition: all .15s ease;
    }
    .btn-action-delete:hover {
        background: #e5484d;
        color: #ffffff;
        border-color: #e5484d;
        transform: translateY(-1px);
    }

    /* Notifikasi Meriah */
    .festive-toast-wrap {
        position: fixed;
        top: 1.35rem;
        right: 1.35rem;
        z-index: 9999;
        max-width: 400px;
        width: calc(100% - 2.7rem);
        animation: toastPopIn .55s cubic-bezier(.175, .885, .32, 1.275) forwards;
    }
    .festive-toast-card {
        background: linear-gradient(135deg, #14213d 0%, #0d1626 100%);
        color: #ffffff;
        border-radius: 18px;
        padding: 1.05rem 1.2rem;
        box-shadow: 0 22px 45px -10px rgba(13, 22, 38, .55), 0 0 0 1px rgba(245, 158, 11, .35);
        position: relative;
        overflow: hidden;
    }
    .festive-toast-card::before {
        content: "";
        position: absolute;
        top: -40px;
        right: -40px;
        width: 120px;
        height: 120px;
        background: radial-gradient(circle, rgba(245, 158, 11, .35) 0%, transparent 70%);
        pointer-events: none;
    }
    .festive-badge-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        animation: iconBounce .75s ease infinite alternate;
    }
    .festive-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background: linear-gradient(90deg, #f59e0b, #10b981);
        width: 100%;
        animation: toastTimer 4.5s linear forwards;
    }
    @keyframes toastPopIn {
        0% { opacity: 0; transform: translateY(-25px) scale(.9); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes toastFadeOut {
        0% { opacity: 1; transform: translateY(0) scale(1); }
        100% { opacity: 0; transform: translateY(-18px) scale(.94); }
    }
    @keyframes iconBounce {
        0% { transform: scale(1) rotate(-4deg); }
        100% { transform: scale(1.1) rotate(4deg); }
    }
    @keyframes toastTimer {
        0% { width: 100%; }
        100% { width: 0%; }
    }
</style>

{{-- Notifikasi saat Tambah / Update / Hapus Berhasil --}}
@if (session()->has('notify'))
    @php
        $rawNotify = session('notify');
        if (is_string($rawNotify)) {
            $decoded = json_decode($rawNotify, true);
            $rawNotify = is_array($decoded) ? $decoded : ['message' => $rawNotify];
        }
        $notifyMsg = data_get($rawNotify, 'message', 'Operasi berhasil dilakukan!');
        $isDelete = str_contains(strtolower($notifyMsg), 'hapus');
        $isUpdate = str_contains(strtolower($notifyMsg), 'update');
    @endphp

    <style>
        /* Sembunyikan toast bawaan agar tidak menumpuk ganda */
        .notify { display: none !important; }
    </style>

    <div class="festive-toast-wrap" id="festiveToast">
        <div class="festive-toast-card">
            <div class="d-flex align-items-center">
                @if ($isDelete)
                    <div class="festive-badge-icon mr-3" style="background: rgba(229, 72, 77, .2); color: #ff7b80; border: 1px solid rgba(229, 72, 77, .4);">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                @elseif ($isUpdate)
                    <div class="festive-badge-icon mr-3" style="background: rgba(59, 130, 246, .22); color: #60a5fa; border: 1px solid rgba(59, 130, 246, .45);">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                @else
                    <div class="festive-badge-icon mr-3" style="background: rgba(16, 185, 129, .22); color: #34d399; border: 1px solid rgba(16, 185, 129, .45);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                @endif

                <div class="flex-grow-1 pr-2">
                    <div class="d-flex align-items-center mb-1">
                        <span class="badge mr-2" style="background: #f59e0b; color: #14213d; font-size: .68rem; letter-spacing: .04em;">
                            {{ $isDelete ? 'TERHAPUS' : ($isUpdate ? 'DIPERBARUI' : 'SUKSES') }}
                        </span>
                        <small style="color: rgba(255,255,255,.65); font-size: .75rem;">Baru saja</small>
                    </div>
                    <div class="font-weight-bold" style="font-size: 1rem; line-height: 1.3;">
                        {{ $notifyMsg }}!
                    </div>
                    <div class="small mt-1" style="color: rgba(255,255,255,.72); font-size: .8rem;">
                        @if ($isDelete)
                            Data barang telah berhasil dihapus dari sistem inventaris.
                        @elseif ($isUpdate)
                            Perubahan informasi barang telah disimpan ke database.
                        @else
                            Data barang baru sudah masuk ke daftar inventaris.
                        @endif
                    </div>
                </div>

                <button type="button" onclick="closeFestiveToast()" class="btn btn-sm text-white-50 p-1" style="background: transparent; border: 0; font-size: 1.1rem;" aria-label="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="festive-progress"></div>
        </div>
    </div>
@endif

{{-- Header Halaman --}}
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-1">Data Barang</h1>
        <p class="mb-0 small" style="color: rgba(255, 255, 255, .78);">
            Kelola daftar inventaris, kode unik, dan ketersediaan stok barang secara real-time.
        </p>
    </div>
    <a href="/admin/barang/tambah" class="btn btn-primary shadow-sm mt-3 mt-sm-0">
        <i class="fas fa-plus-circle mr-2"></i>Tambah Barang Baru
    </a>
</div>

{{-- Kartu Ringkasan Statistik (2 Kolom) --}}
@php
    $stokHalamanIni = $data->sum(fn($row) => (int) $row->stok);
@endphp
<div class="row mb-4">
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="inv-stat-card">
            <div>
                <div class="text-uppercase font-weight-bold text-muted" style="font-size: .72rem; letter-spacing: .05em;">
                    Total Jenis Barang
                </div>
                <div class="h4 font-weight-bold mb-0 mt-1" style="color: #14213d;">
                    {{ $data->total() }} <span class="small font-weight-normal text-muted">Item</span>
                </div>
            </div>
            <div class="inv-stat-icon" style="background: #fff4dc; color: #d98606;">
                <i class="fas fa-boxes"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="inv-stat-card">
            <div>
                <div class="text-uppercase font-weight-bold text-muted" style="font-size: .72rem; letter-spacing: .05em;">
                    Stok Halaman Ini
                </div>
                <div class="h4 font-weight-bold mb-0 mt-1" style="color: #14213d;">
                    {{ $stokHalamanIni }} <span class="small font-weight-normal text-muted">Unit</span>
                </div>
            </div>
            <div class="inv-stat-icon" style="background: #e8f0fe; color: #2b4acb;">
                <i class="fas fa-layer-group"></i>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Daftar Barang --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: .75rem;">
                <div class="d-flex align-items-center">
                    <h6 class="m-0 mr-2">
                        <i class="fas fa-clipboard-list mr-2" style="color: #f59e0b;"></i>Daftar Inventaris Barang
                    </h6>
                    <span class="badge" style="background: #fff4dc; color: #8a5200;">
                        Hal. {{ $data->currentPage() }} dari {{ max($data->lastPage(), 1) }}
                    </span>
                </div>

                @if ($data->count() > 0)
                    <div style="min-width: 240px;">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0" style="border-radius: 10px 0 0 10px; border-color: #d3d9e6;">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                            </div>
                            <input type="text" id="quickFilterInput" class="form-control border-left-0" style="border-radius: 0 10px 10px 0; padding: .42rem .75rem;" placeholder="Filter kode / nama barang...">
                        </div>
                    </div>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="barangTable">
                        <thead>
                            <tr>
                                <th style="width: 65px;">NO</th>
                                <th style="width: 165px;">KODE BARANG</th>
                                <th>NAMA BARANG</th>
                                <th style="width: 200px;">KETERSEDIAAN STOK</th>
                                <th class="text-center" style="width: 175px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $item)
                                @php
                                    $jumlahStok = (int) $item->stok;
                                    $persenStok = min(100, max(6, $jumlahStok * 4));
                                @endphp
                                <tr class="barang-row">
                                    <td class="font-weight-bold text-muted">
                                        {{ ($data->firstItem() ?? 1) + $key }}
                                    </td>
                                    <td>
                                        <span class="badge px-2 py-1" style="background: #f1f3f8; color: #14213d; border: 1px solid #d3d9e6; font-family: monospace; font-size: .82rem;">
                                            #{{ $item->kode }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="item-avatar mr-3">
                                                <i class="fas fa-cube"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold" style="color: #14213d; font-size: .95rem;">
                                                    {{ $item->nama }}
                                                </div>
                                                <small class="text-muted">ID: {{ $item->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($jumlahStok <= 0)
                                            <span class="badge mb-1" style="background: #fdecec; color: #9b1c21;">
                                                <i class="fas fa-times-circle mr-1"></i>Stok Habis (0)
                                            </span>
                                            <div class="progress" style="height: 5px; border-radius: 99px; background: #f1f3f8;">
                                                <div class="progress-bar bg-danger" style="width: 100%;"></div>
                                            </div>
                                        @elseif ($jumlahStok <= 5)
                                            <span class="badge mb-1" style="background: #fff4dc; color: #8a5200;">
                                                <i class="fas fa-exclamation-circle mr-1"></i>Menipis ({{ $item->stok }} unit)
                                            </span>
                                            <div class="progress" style="height: 5px; border-radius: 99px; background: #f1f3f8;">
                                                <div class="progress-bar bg-warning" style="width: {{ $persenStok }}%;"></div>
                                            </div>
                                        @else
                                            <span class="badge mb-1" style="background: #e6f7f0; color: #0a6b4b;">
                                                <i class="fas fa-check-circle mr-1"></i>Tersedia ({{ $item->stok }} unit)
                                            </span>
                                            <div class="progress" style="height: 5px; border-radius: 99px; background: #f1f3f8;">
                                                <div class="progress-bar bg-success" style="width: {{ $persenStok }}%;"></div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/barang/edit/{{ $item->id }}" class="btn btn-action-edit mr-1" title="Edit Barang">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <button type="button"
                                                class="btn btn-action-delete"
                                                title="Hapus Barang"
                                                data-toggle="modal"
                                                data-target="#deleteBarangModal"
                                                data-id="{{ $item->id }}"
                                                data-nama="{{ $item->nama }}"
                                                data-kode="{{ $item->kode }}">
                                            <i class="fas fa-trash-alt mr-1"></i>Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="mb-3" style="width: 68px; height: 68px; margin: 0 auto; border-radius: 20px; background: #fff4dc; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 1.9rem;">
                                            <i class="fas fa-box-open"></i>
                                        </div>
                                        <h6 class="mb-1" style="color: #14213d;">Belum Ada Data Barang</h6>
                                        <p class="text-muted small mb-3">Mulai kelola inventaris dengan menambahkan barang pertama Anda.</p>
                                        <a href="/admin/barang/tambah" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus mr-1"></i>Tambah Barang Pertama
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($data->hasPages())
                    <div class="d-flex flex-wrap align-items-center justify-content-between pt-3 mt-3" style="border-top: 1px solid #e4e8f0;">
                        <small class="text-muted mb-2 mb-sm-0">
                            Menampilkan <strong>{{ $data->firstItem() }}–{{ $data->lastItem() }}</strong> dari <strong>{{ $data->total() }}</strong> total data
                        </small>
                        <div>
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteBarangModal" tabindex="-1" role="dialog" aria-labelledby="deleteBarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center" id="deleteBarangLabel">
                    <span class="mr-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 10px; background: #fdecec; color: #e5484d;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    Konfirmasi Hapus Barang
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus barang <strong id="modalNamaBarang" style="color: #14213d;"></strong> (<span id="modalKodeBarang" style="font-family: monospace;"></span>)? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a id="confirmDeleteLink" href="#" class="btn btn-danger">
                    <i class="fas fa-trash-alt mr-1"></i>Ya, Hapus Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pindahkan modal ke body agar tidak tertutup backdrop gelap
        const deleteModalEl = document.getElementById('deleteBarangModal');
        if (deleteModalEl) {
            document.body.appendChild(deleteModalEl);
        }

        // Pindahkan kartu notifikasi ke body & atur timer tutup otomatis
        const festiveToastEl = document.getElementById('festiveToast');
        if (festiveToastEl) {
            document.body.appendChild(festiveToastEl);
            setTimeout(closeFestiveToast, 4500);
        }

        // Filter pencarian cepat di tabel
        const filterInput = document.getElementById('quickFilterInput');
        if (filterInput) {
            filterInput.addEventListener('keyup', function () {
                const keyword = this.value.toLowerCase();
                document.querySelectorAll('#barangTable tbody tr.barang-row').forEach(function (row) {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(keyword) ? '' : 'none';
                });
            });
        }

        // Hubungkan tombol Hapus ke Modal Konfirmasi
        if (window.jQuery) {
            $('#deleteBarangModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const nama = button.data('nama');
                const kode = button.data('kode');

                $(this).find('#modalNamaBarang').text(nama);
                $(this).find('#modalKodeBarang').text('#' + kode);
                $(this).find('#confirmDeleteLink').attr('href', '/admin/barang/delete/' + id);
            });
        }
    });

    function closeFestiveToast() {
        const toast = document.getElementById('festiveToast');
        if (toast) {
            toast.style.animation = 'toastFadeOut .35s ease forwards';
            setTimeout(() => toast.remove(), 350);
        }
    }
</script>
@endsection