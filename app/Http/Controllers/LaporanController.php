<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Barang::get();
        $totalJenis =$data->count();
        $totalStok =$data->sum(fn($row) => (int)$row->stok);

        return view('admin.laporan.index', compact('data', 'totalJenis', 'totalStok'));
    }

    public function cetak_barang(Request $request)
    {
        $data = Barang::get();$filename = 'Laporan-Data-Barang-' . date('Y-m-d') . '.pdf';

        if ($request->query('preview') == '1') {
            return view('admin.laporan.pdf_barang', compact('data'));
        }

        $pdf = Pdf::loadView('admin.laporan.pdf_barang', compact('data'));$pdf->setPaper('a4', 'portrait');

        return $pdf->download($filename);
    }

    public function excel_barang(Request $request)
    {
        $data = Barang::get();$filename = 'Laporan-Data-Barang-' . date('Y-m-d') . '.xls';

        if ($request->query('preview') == '1') {
            return view('admin.laporan.excel_barang', compact('data'));
        }

        return response()
            ->view('admin.laporan.excel_barang', compact('data'))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}