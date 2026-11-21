<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Data Barang (Excel)</title>
    <style>
        body {
            font-family: Calibri, Arial, sans-serif;
            font-size: 11pt;
            color: #14213d;
            margin: 0;
            padding: 0;
        }

        /* Pembungkus kertas khusus saat Pratinjau di Browser */
        @if (request('preview') == '1' || ($isPreview ?? false))
        body {
            background-color: #cbd5e1;
            padding: 20px 12px;
        }
        .sheet-wrapper {
            max-width: 820px;
            margin: 0 auto;
            background: #ffffff;
            padding: 26px 30px;
            border-radius: 8px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .18);
        }
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .sheet-wrapper {
                box-shadow: none;
                border-radius: 0;
                padding: 0;
                max-width: 100%;
            }
        }
        @endif

        table.excel-sheet {
            border-collapse: collapse;
            width: 100%;
        }

        .header-banner {
            background-color: #14213d;
            color: #ffffff;
            font-size: 15pt;
            font-weight: bold;
            padding: 12px 14px;
            border: 1px solid #14213d;
        }

        .header-sub {
            background-color: #1e315c;
            color: #ffd27a;
            font-size: 10pt;
            padding: 6px 14px;
            border: 1px solid #14213d;
            border-bottom: 3px solid #f59e0b;
        }

        .meta-cell {
            background-color: #f8fafc;
            color: #334155;
            font-size: 9.5pt;
            padding: 6px 10px;
            border: 1px solid #cbd5e1;
        }

        th.col-head {
            background-color: #14213d;
            color: #ffffff;
            font-weight: bold;
            font-size: 10pt;
            text-align: center;
            border: 1px solid #0f172a;
            padding: 9px 10px;
        }

        td.data-cell {
            border: 1px solid #cbd5e1;
            padding: 7px 10px;
            font-size: 10.5pt;
            vertical-align: middle;
        }

        .row-even td.data-cell {
            background-color: #f8fafc;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .kode-text {
            mso-number-format: "\@";
            font-family: Consolas, monospace;
            font-weight: bold;
        }

        .total-row td {
            background-color: #fff4dc;
            color: #14213d;
            font-weight: bold;
            border: 1px solid #94a3b8;
            border-top: 2px solid #14213d;
            padding: 9px 10px;
        }

        .footer-note {
            background-color: #f1f5f9;
            color: #475569;
            font-size: 9pt;
            padding: 7px 10px;
            border: 1px solid #cbd5e1;
        }
    </style>
</head>
<body>
    @php
        $totalJenis = $data->count();
        $totalStok = $data->sum(fn($row) => (int) $row->stok);
    @endphp

    <div class="sheet-wrapper">
        <table class="excel-sheet">
            {{-- Header Laporan --}}
            <tr>
                <td colspan="5" class="header-banner">
                    LAPORAN REKAPITULASI DATA BARANG INVENTARIS
                </td>
            </tr>
            <tr>
                <td colspan="5" class="header-sub">
                    Sistem Informasi Inventaris • Dokumen Rekapitulasi Stok Barang
                </td>
            </tr>
            <tr>
                <td colspan="2" class="meta-cell">
                    <strong>Tanggal Cetak:</strong> {{ date('d F Y, H:i') }}
                </td>
                <td colspan="2" class="meta-cell">
                    <strong>Total Jenis Barang:</strong> {{ $totalJenis }} Item
                </td>
                <td class="meta-cell text-center">
                    <strong>No:</strong> INV/{{ date('Ym') }}
                </td>
            </tr>
            <tr>
                <td colspan="5" style="height: 8px; border: none;"></td>
            </tr>

            {{-- Header Kolom Tabel --}}
            <thead>
                <tr>
                    <th class="col-head" style="width: 50px;">NO</th>
                    <th class="col-head" style="width: 145px;">KODE BARANG</th>
                    <th class="col-head" style="width: 320px;">NAMA BARANG</th>
                    <th class="col-head" style="width: 100px;">STOK</th>
                    <th class="col-head" style="width: 130px;">STATUS STOK</th>
                </tr>
            </thead>

            {{-- Isi Data --}}
            <tbody>
                @forelse ($data as $key => $item)
                    @php $stok = (int) $item->stok; @endphp
                    <tr class="{{ $key % 2 == 1 ? 'row-even' : '' }}">
                        <td class="data-cell text-center">{{ $key + 1 }}</td>
                        <td class="data-cell text-center kode-text">{{ $item->kode }}</td>
                        <td class="data-cell">{{ $item->nama }}</td>
                        <td class="data-cell text-center" style="font-weight: bold;">{{ $stok }}</td>
                        <td class="data-cell text-center">
                            @if ($stok <= 0)
                                Habis
                            @elseif ($stok <= 5)
                                Menipis
                            @else
                                Tersedia
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="data-cell text-center" style="padding: 18px; color: #64748b;">
                            Belum ada data barang tersimpan.
                        </td>
                    </tr>
                @endforelse

                {{-- Baris Total --}}
                <tr class="total-row">
                    <td colspan="3" class="text-right">TOTAL KESELURUHAN STOK</td>
                    <td class="text-center">{{ $totalStok }}</td>
                    <td class="text-center">Unit</td>
                </tr>
            </tbody>

            {{-- Footer Laporan & Tanda Tangan --}}
            <tr>
                <td colspan="5" style="height: 12px; border: none;"></td>
            </tr>
            <tr>
                <td colspan="3" class="footer-note">
                    <strong>Catatan Sistem:</strong> Dokumen ini digenerate otomatis oleh Sistem Inventaris pada {{ date('d/m/Y H:i') }}.
                </td>
                <td colspan="2" class="footer-note text-center">
                    <strong>Administrator Inventaris</strong><br><br><br>
                    ( ........................................ )
                </td>
            </tr>
        </table>
    </div>
</body>
</html>