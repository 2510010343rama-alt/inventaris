<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Data Barang</title>
    <style>
        @page {
            margin: 18mm 15mm 22mm 15mm;
        }

        body {
            font-family: "DejaVu Sans", Helvetica, Arial, sans-serif;
            font-size: 10pt;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        /* Tampilan kertas A4 khusus saat Pratinjau di Browser */
        @if (request('preview') == '1' || ($isPreview ?? false))
        body {
            background-color: #cbd5e1;
            padding: 20px 12px;
        }
        .pdf-sheet {
            max-width: 794px;
            margin: 0 auto;
            background: #ffffff;
            padding: 32px 36px;
            border-radius: 8px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .18);
        }
        .page-footer {
            position: static !important;
            bottom: auto !important;
            margin-top: 28px;
        }
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .pdf-sheet {
                box-shadow: none;
                border-radius: 0;
                padding: 0;
                max-width: 100%;
            }
        }
        @endif

        /* Header Dokumen */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #14213d;
            color: #ffffff;
            border-bottom: 4px solid #f59e0b;
        }

        .header-table td {
            padding: 16px 20px;
            vertical-align: middle;
        }

        .brand-badge {
            display: inline-block;
            background-color: #f59e0b;
            color: #14213d;
            font-weight: bold;
            font-size: 9pt;
            padding: 3px 10px;
            border-radius: 4px;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .doc-title {
            font-size: 15pt;
            font-weight: bold;
            margin: 0;
            letter-spacing: -0.3px;
            color: #ffffff;
        }

        .doc-subtitle {
            font-size: 8.5pt;
            color: #cbd5e1;
            margin-top: 4px;
        }

        .meta-box {
            text-align: right;
            font-size: 8.5pt;
            color: #e2e8f0;
            line-height: 1.55;
        }

        .meta-box strong {
            color: #f59e0b;
        }

        /* Ringkasan Statistik */
        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin: 14px -8px 16px -8px;
        }

        .summary-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #14213d;
            padding: 9px 12px;
            width: 33.33%;
        }

        .summary-card.amber {
            border-left-color: #f59e0b;
        }

        .summary-card.green {
            border-left-color: #10b981;
        }

        .summary-label {
            font-size: 7.5pt;
            text-transform: uppercase;
            color: #64748b;
            font-weight: bold;
            letter-spacing: 0.4px;
        }

        .summary-value {
            font-size: 13pt;
            font-weight: bold;
            color: #14213d;
            margin-top: 2px;
        }

        /* Tabel Data Utama */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .data-table thead th {
            background-color: #14213d;
            color: #ffffff;
            font-size: 8.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 9px 10px;
            border: 1px solid #14213d;
            text-align: left;
        }

        .data-table thead th.text-center {
            text-align: center;
        }

        .data-table tbody td {
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            font-size: 9pt;
            vertical-align: middle;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .code-pill {
            font-family: "DejaVu Sans Mono", monospace;
            font-size: 8.5pt;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 2px 6px;
            border-radius: 3px;
            color: #0f172a;
        }

        .status-ok {
            color: #065f46;
            background-color: #d1fae5;
            padding: 2px 7px;
            border-radius: 10px;
            font-size: 8pt;
            font-weight: bold;
        }

        .status-low {
            color: #92400e;
            background-color: #fef3c7;
            padding: 2px 7px;
            border-radius: 10px;
            font-size: 8pt;
            font-weight: bold;
        }

        .status-empty {
            color: #991b1b;
            background-color: #fee2e2;
            padding: 2px 7px;
            border-radius: 10px;
            font-size: 8pt;
            font-weight: bold;
        }

        .total-row td {
            background-color: #fff4dc !important;
            border: 1px solid #cbd5e1;
            border-top: 2px solid #14213d;
            font-weight: bold;
            color: #14213d;
            padding: 9px 10px;
            font-size: 9.5pt;
        }

        /* Blok Tanda Tangan */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 28px;
            page-break-inside: avoid;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
            font-size: 9pt;
            color: #334155;
        }

        .sign-box {
            text-align: center;
            width: 210px;
            margin-left: auto;
        }

        .sign-space {
            height: 58px;
        }

        .sign-name {
            font-weight: bold;
            color: #14213d;
            border-top: 1px solid #475569;
            padding-top: 4px;
        }

        /* Footer Halaman Tetap (Bawah Kertas) */
        .page-footer {
            position: fixed;
            bottom: -14mm;
            left: 0;
            right: 0;
            border-top: 1px solid #cbd5e1;
            padding-top: 5px;
            font-size: 7.5pt;
            color: #64748b;
        }

        .page-footer table {
            width: 100%;
            border-collapse: collapse;
        }

        .page-num:after {
            content: counter(page);
        }
    </style>
</head>
<body>

    @php
        $totalJenis = $data->count();
        $totalStok = $data->sum(fn($row) => (int) $row->stok);
        $stokMenipis = $data->filter(fn($row) => (int) $row->stok <= 5)->count();
    @endphp

    <div class="pdf-sheet">
        {{-- Header / Kop Laporan --}}
        <table class="header-table">
            <tr>
                <td style="width: 65%;">
                    <div class="brand-badge">SISTEM INVENTARIS</div>
                    <h1 class="doc-title">LAPORAN REKAPITULASI DATA BARANG</h1>
                    <div class="doc-subtitle">Daftar ketersediaan stok, kode unik, dan rincian inventaris gudang</div>
                </td>
                <td style="width: 35%;" class="meta-box">
                    <div><strong>No. Dokumen:</strong> INV/{{ date('Y/m') }}/BRG</div>
                    <div><strong>Tanggal Cetak:</strong> {{ date('d F Y') }}</div>
                    <div><strong>Dicetak Oleh:</strong> Administrator</div>
                </td>
            </tr>
        </table>

        {{-- Ringkasan Statistik --}}
        <table class="summary-table">
            <tr>
                <td class="summary-card">
                    <div class="summary-label">Total Jenis Barang</div>
                    <div class="summary-value">{{ $totalJenis }} Item</div>
                </td>
                <td class="summary-card amber">
                    <div class="summary-label">Total Keseluruhan Stok</div>
                    <div class="summary-value">{{ $totalStok }} Unit</div>
                </td>
                <td class="summary-card green">
                    <div class="summary-label">Stok Menipis / Habis</div>
                    <div class="summary-value">{{ $stokMenipis }} Item</div>
                </td>
            </tr>
        </table>

        {{-- Tabel Daftar Barang --}}
        <table class="data-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 40px;">No</th>
                    <th class="text-center" style="width: 115px;">Kode Barang</th>
                    <th>Nama Barang</th>
                    <th class="text-center" style="width: 85px;">Stok</th>
                    <th class="text-center" style="width: 110px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $key => $item)
                    @php $stok = (int) $item->stok; @endphp
                    <tr>
                        <td style="text-align: center; font-weight: bold; color: #64748b;">{{ $key + 1 }}</td>
                        <td style="text-align: center;">
                            <span class="code-pill">{{ $item->kode }}</span>
                        </td>
                        <td style="font-weight: bold; color: #14213d;">{{ $item->nama }}</td>
                        <td style="text-align: center; font-weight: bold;">{{ $item->stok }}</td>
                        <td style="text-align: center;">
                            @if ($stok <= 0)
                                <span class="status-empty">Habis</span>
                            @elseif ($stok <= 5)
                                <span class="status-low">Menipis</span>
                            @else
                                <span class="status-ok">Tersedia</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 24px; color: #64748b;">
                            Tidak ada data barang yang tersedia di database.
                        </td>
                    </tr>
                @endforelse

                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">TOTAL KESELURUHAN STOK INVENTARIS</td>
                    <td style="text-align: center;">{{ $totalStok }}</td>
                    <td style="text-align: center;">Unit</td>
                </tr>
            </tbody>
        </table>

        {{-- Footer Pengesahan / Tanda Tangan --}}
        <table class="signature-table">
            <tr>
                <td>
                    <div style="font-size: 8pt; color: #64748b; line-height: 1.5;">
                        <strong>Catatan:</strong><br>
                        Laporan ini dihasilkan secara otomatis oleh sistem berdasarkan data stok terkini pada tanggal cetak tertera.
                    </div>
                </td>
                <td>
                    <div class="sign-box">
                        <div>Mengetahui,</div>
                        <div><strong>Administrator Inventaris</strong></div>
                        <div class="sign-space"></div>
                        <div class="sign-name">( ........................................ )</div>
                    </div>
                </td>
            </tr>
        </table>

        {{-- Footer Bawah Halaman --}}
        <div class="page-footer">
            <table>
                <tr>
                    <td>Sistem Informasi Inventaris Barang • Dokumen Resmi</td>
                    <td style="text-align: right;">
                        Dicetak: {{ date('d/m/Y H:i') }}
                        @if (request('preview') != '1' && !($isPreview ?? false))
                             |  Halaman <span class="page-num"></span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>