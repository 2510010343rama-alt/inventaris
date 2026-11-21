@extends('layouts.master')

@section('content')
    <!-- Tampilan baru: hanya override visual, struktur & fitur tidak berubah -->
    <style>
        /* Judul halaman (putih di atas pita navy dari layout) */
        .container-fluid > .d-sm-flex h1.h3 {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -.03em;
            color: #fff !important;
        }

        /* Tiap kartu punya satu warna "tone" */
        .card.border-left-primary { --tone: #f59e0b; }
        .card.border-left-success { --tone: #10b981; }
        .card.border-left-info    { --tone: #3b82f6; }
        .card.border-left-warning { --tone: #f0654a; }

        .card[class*="border-left-"] {
            position: relative;
            overflow: hidden;
            border: 0 !important;
            border-radius: 18px;
            background: var(--surface, #fff);
            box-shadow: var(--shadow, 0 1px 2px rgba(20, 33, 61, .05), 0 10px 26px -10px rgba(20, 33, 61, .16)) !important;
        }

        /* Tab warna kecil di tepi atas kartu */
        .card[class*="border-left-"]::before {
            content: "";
            position: absolute;
            top: 0;
            left: 1.5rem;
            width: 2.75rem;
            height: 5px;
            border-radius: 0 0 6px 6px;
            background: var(--tone);
        }

        .card[class*="border-left-"] .card-body {
            position: relative;
            padding: 1.6rem 1.5rem 1.4rem;
        }

        /* Label: huruf biasa, abu netral */
        .card[class*="border-left-"] .text-uppercase {
            text-transform: none !important;
            letter-spacing: 0;
            font-size: .88rem;
            font-weight: 600 !important;
            color: var(--muted, #6b7488) !important;
            margin-bottom: .45rem !important;
        }

        /* Angka utama */
        .card[class*="border-left-"] .h5 {
            font-family: var(--font-display, "Space Grotesk", sans-serif);
            font-size: 2.4rem;
            font-weight: 700 !important;
            letter-spacing: -.04em;
            line-height: 1.05;
            color: var(--ink, #14213d) !important;
            font-variant-numeric: tabular-nums;
        }

        /* Ikon jadi watermark besar di pojok kanan atas */
        .card[class*="border-left-"] .card-body > .row > .col-auto > i.fa-2x {
            position: absolute;
            top: 1.1rem;
            right: 1.2rem;
            font-size: 3.6rem !important;
            color: var(--tone) !important;
            opacity: .16;
            transform: rotate(-10deg);
            pointer-events: none;
        }

        /* Progress bar Barang Keluar */
        .card[class*="border-left-"] .progress {
            height: .45rem;
            border-radius: 999px;
            background-color: #edf0f6;
            overflow: hidden;
        }

        .card[class*="border-left-"] .progress-bar {
            border-radius: 999px;
            background-color: var(--tone) !important;
        }

        /* Satu momen animasi saat halaman dibuka: kartu naik berurutan */
        @keyframes kartu-naik {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .row > [class*="col-xl-3"] {
            animation: kartu-naik .55s cubic-bezier(.2, .7, .2, 1) both;
        }

        .row > [class*="col-xl-3"]:nth-child(2) { animation-delay: .07s; }
        .row > [class*="col-xl-3"]:nth-child(3) { animation-delay: .14s; }
        .row > [class*="col-xl-3"]:nth-child(4) { animation-delay: .21s; }

        @media (max-width: 575.98px) {
            .card[class*="border-left-"] .h5 { font-size: 2rem; }
        }
    </style>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">40,213</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Barang Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">534</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-th fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Barang Keluar
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">213</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-th fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Pegawai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection