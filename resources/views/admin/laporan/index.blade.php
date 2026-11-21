@extends('layouts.master')

@section('content')
<style>
    .report-doc-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: linear-gradient(135deg, #14213d 0%, #243b6b 100%);
        color: #f59e0b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.65rem;
        flex-shrink: 0;
        box-shadow: 0 10px 22px -6px rgba(20, 33, 61, .35);
    }

    .report-meta-box {
        background: #f1f3f8;
        border: 1px solid #e4e8f0;
        border-radius: 12px;
        padding: .85rem 1rem;
        height: 100%;
    }

    .report-guide-step {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .report-guide-step:last-child {
        margin-bottom: 0;
    }

    .report-step-num {
        width: 26px;
        height: 26px;
        border-radius: 8px;
        background: #fff4dc;
        color: #8a5200;
        font-weight: 700;
        font-size: .78rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: .75rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    /* Styling Modal Preview & Konfirmasi */
    .preview-modal-dialog {
        max-width: 960px;
        width: 95%;
    }

    .preview-confirm-bar {
        background: #fff4dc;
        border: 1px solid #fde2a3;
        color: #7a4d06;
        border-radius: 12px;
        padding: .75rem 1rem;
        font-size: .86rem;
    }

    .preview-frame-box {
        position: relative;
        width: 100%;
        height: 62vh;
        min-height: 400px;
        background: #cbd5e1;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #94a3b8;
    }

    .preview-frame-box iframe {
        width: 100%;
        height: 100%;
        border: 0;
        background: #cbd5e1;
    }
</style>

{{-- Header Halaman --}}
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-1">Laporan Inventaris</h1>
        <p class="mb-0 small" style="color: rgba(255, 255, 255, .78);">
            Pratinjau, cetak, dan unduh rekapitulasi data barang dalam format PDF maupun Excel.
        </p>
    </div>
    <a href="/admin/barang" class="btn btn-primary shadow-sm mt-3 mt-sm-0">
        <i class="fas fa-boxes mr-2"></i>Kelola Data Barang
    </a>
</div>

{{-- Konten Utama Laporan --}}
<div class="row">
    {{-- Kartu Cetak Laporan Barang --}}
    <div class="col-lg-8 mb-4">
        <div class="card shadow h-100">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: .5rem;">
                <h6 class="m-0">
                    <i class="fas fa-file-alt mr-2" style="color: #f59e0b;"></i>Dokumen Rekapitulasi Barang
                </h6>
                <span class="badge" style="background: #fff4dc; color: #8a5200;">
                    PREVIEW • CETAK • UNDUH
                </span>
            </div>

            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex flex-column flex-sm-row align-items-start mb-4">
                        <div class="report-doc-icon mr-sm-3 mb-3 mb-sm-0">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold mb-1" style="color: #14213d;">
                                Laporan Keseluruhan Data Barang
                            </h5>
                            <p class="text-muted small mb-0" style="line-height: 1.65;">
                                Dilengkapi kop laporan resmi, ringkasan statistik, rincian kode, nama, status stok barang, total keseluruhan unit, serta kolom pengesahan di bagian bawah dokumen.
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4 mb-2 mb-sm-0">
                            <div class="report-meta-box">
                                <div class="text-uppercase font-weight-bold text-muted" style="font-size: .68rem; letter-spacing: .05em;">
                                    Total Data Siap Cetak
                                </div>
                                <div class="font-weight-bold mt-1" style="color: #14213d; font-size: .9rem;">
                                    <i class="fas fa-boxes mr-1" style="color: #d98606;"></i>{{ $totalJenis ?? 0 }} Item ({{ $totalStok ?? 0 }} Unit)
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2 mb-sm-0">
                            <div class="report-meta-box">
                                <div class="text-uppercase font-weight-bold text-muted" style="font-size: .68rem; letter-spacing: .05em;">
                                    Pilihan Format
                                </div>
                                <div class="font-weight-bold mt-1" style="color: #14213d; font-size: .9rem;">
                                    <i class="fas fa-file-pdf text-danger mr-1"></i>PDF &
                                    <i class="fas fa-file-excel text-success ml-1 mr-1"></i>Excel (.xls)
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="report-meta-box">
                                <div class="text-uppercase font-weight-bold text-muted" style="font-size: .68rem; letter-spacing: .05em;">
                                    Tanggal Laporan
                                </div>
                                <div class="font-weight-bold mt-1" style="color: #14213d; font-size: .9rem;">
                                    <i class="far fa-calendar-alt mr-1" style="color: #2b4acb;"></i>{{ date('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-3 d-flex flex-wrap align-items-center justify-content-between" style="border-top: 1px solid #e4e8f0; gap: .75rem;">
                    <small class="text-muted">
                        <i class="fas fa-eye mr-1"></i>Pratinjau & konfirmasi akan tampil sebelum unduh/cetak.
                    </small>
                    <div class="d-flex flex-wrap" style="gap: .55rem;">
                        <button type="button" class="btn btn-success" onclick="openReportPreview('excel')">
                            <i class="fas fa-file-excel mr-2"></i>Export Excel
                        </button>
                        <button type="button" class="btn btn-primary" onclick="openReportPreview('pdf')">
                            <i class="fas fa-print mr-2"></i>Cetak PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu Panduan Cetak --}}
    <div class="col-lg-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">
                <h6 class="m-0">
                    <i class="fas fa-info-circle mr-2" style="color: #2b4acb;"></i>Alur Cetak & Unduh
                </h6>
            </div>
            <div class="card-body small text-muted" style="line-height: 1.6;">
                <div class="report-guide-step">
                    <span class="report-step-num">1</span>
                    <div>
                        <strong style="color: #14213d;">Pilih Format Dokumen</strong><br>
                        Klik tombol <strong>Cetak PDF</strong> atau <strong>Export Excel</strong> sesuai kebutuhan pelaporan Anda.
                    </div>
                </div>
                <div class="report-guide-step">
                    <span class="report-step-num">2</span>
                    <div>
                        <strong style="color: #14213d;">Periksa Pratinjau</strong><br>
                        Tampilan header, isi data barang, total stok, dan footer akan dimuat terlebih dahulu di jendela pratinjau.
                    </div>
                </div>
                <div class="report-guide-step">
                    <span class="report-step-num">3</span>
                    <div>
                        <strong style="color: #14213d;">Konfirmasi Aksi</strong><br>
                        Klik <strong>Konfirmasi & Download</strong> untuk menyimpan berkas atau <strong>Cetak Sekarang</strong> untuk langsung mencetak.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Preview & Konfirmasi Download / Print --}}
<div class="modal fade" id="reportPreviewModal" tabindex="-1" role="dialog" aria-labelledby="reportPreviewTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered preview-modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between">
                <h5 class="modal-title d-flex align-items-center" id="reportPreviewTitle">
                    <span id="previewIconBadge" class="mr-2 d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-radius: 10px; background: #fff4dc; color: #d98606;">
                        <i class="fas fa-file-pdf"></i>
                    </span>
                    <span id="previewTitleText">Pratinjau Laporan PDF</span>
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body pt-2">
                <div class="preview-confirm-bar d-flex flex-wrap align-items-center justify-content-between mb-3" style="gap: .5rem;">
                    <div>
                        <i class="fas fa-shield-alt mr-1"></i>
                        <strong>Konfirmasi Dokumen:</strong> Periksa isi laporan di bawah ini sebelum mengunduh atau mencetak.
                    </div>
                    <span id="previewFormatBadge" class="badge" style="background: #14213d; color: #ffd27a;">
                        FORMAT PDF
                    </span>
                </div>

                <div class="preview-frame-box">
                    <iframe id="reportPreviewFrame" title="Pratinjau Dokumen Laporan"></iframe>
                </div>
            </div>

            <div class="modal-footer d-flex flex-wrap align-items-center justify-content-between" style="gap: .6rem;">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Batal / Tutup
                </button>
                <div class="d-flex flex-wrap" style="gap: .5rem;">
                    <button type="button" class="btn btn-outline-dark" style="border-color: #cbd5e1; color: #14213d;" onclick="printPreviewDocument()">
                        <i class="fas fa-print mr-1"></i>Cetak Sekarang (Print)
                    </button>
                    <a id="confirmDownloadBtn" href="#" class="btn btn-primary">
                        <i class="fas fa-download mr-1"></i><span id="confirmDownloadText">Konfirmasi & Download</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $previewItems = $data ?? \App\Models\Barang::get();
    $pdfPreviewHtml = view('admin.laporan.pdf_barang', ['data' => $previewItems, 'isPreview' => true])->render();
    $excelPreviewHtml = view('admin.laporan.excel_barang', ['data' => $previewItems, 'isPreview' => true])->render();
@endphp

<script>
    const REPORT_PREVIEWS = {
        pdf: @json($pdfPreviewHtml),
        excel: @json($excelPreviewHtml)
    };

    document.addEventListener('DOMContentLoaded', function () {
        const previewModal = document.getElementById('reportPreviewModal');
        if (previewModal) {
            document.body.appendChild(previewModal);
        }

        if (window.jQuery) {
            $('#reportPreviewModal').on('hidden.bs.modal', function () {
                document.getElementById('reportPreviewFrame').srcdoc = '';
            });
        }
    });

    function openReportPreview(type) {
        const frame = document.getElementById('reportPreviewFrame');
        const titleText = document.getElementById('previewTitleText');
        const iconBadge = document.getElementById('previewIconBadge');
        const formatBadge = document.getElementById('previewFormatBadge');
        const downloadBtn = document.getElementById('confirmDownloadBtn');
        const downloadText = document.getElementById('confirmDownloadText');

        if (type === 'excel') {
            frame.srcdoc = REPORT_PREVIEWS.excel;
            titleText.textContent = 'Pratinjau & Konfirmasi Laporan Excel';
            iconBadge.style.background = '#e6f7f0';
            iconBadge.style.color = '#10b981';
            iconBadge.innerHTML = '<i class="fas fa-file-excel"></i>';
            formatBadge.textContent = 'FORMAT EXCEL (.XLS)';
            downloadBtn.className = 'btn btn-success';
            downloadBtn.href = '/admin/laporan/barang/excel';
            downloadText.textContent = 'Konfirmasi & Download Excel';
        } else {
            frame.srcdoc = REPORT_PREVIEWS.pdf;
            titleText.textContent = 'Pratinjau & Konfirmasi Laporan PDF';
            iconBadge.style.background = '#fdecec';
            iconBadge.style.color = '#e5484d';
            iconBadge.innerHTML = '<i class="fas fa-file-pdf"></i>';
            formatBadge.textContent = 'FORMAT PDF (.PDF)';
            downloadBtn.className = 'btn btn-primary';
            downloadBtn.href = '/admin/laporan/barang';
            downloadText.textContent = 'Konfirmasi & Download PDF';
        }

        if (window.jQuery) {
            $('#reportPreviewModal').modal('show');
        }
    }

    function printPreviewDocument() {
        const frame = document.getElementById('reportPreviewFrame');
        if (frame && frame.contentWindow) {
            frame.contentWindow.focus();
            frame.contentWindow.print();
        }
    }
</script>
@endsection