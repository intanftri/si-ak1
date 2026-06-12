<?php

namespace App\Http\Controllers;

use App\Models\KartuAk1;
use Barryvdh\DomPDF\Facade\Pdf;
// use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function cetakKartuAk1(int $id)
    {
        // Ambil data kartu beserta relasi pencari kerja (dan pendidikan jika ada)
        $kartu = KartuAk1::with(['pencariKerja'])->findOrFail($id);

        // Load view HTML dan kirim data ke view
        $pdf = Pdf::loadView('pdf.kartu-ak1', [
            'kartu' => $kartu,
            'pencari' => $kartu->pencariKerja,
        ]);

        // Atur ukuran kertas (A4, atau ukuran custom KTP)
        // Jika ingin ukuran dompet/kartu, bisa pakai custom array: $pdf->setPaper([0, 0, 240.94, 382.67], 'landscape');
        $pdf->setPaper('A4', 'portrait');

        // Gunakan stream() agar file terbuka di tab baru (tidak langsung download)
        // Gunakan download() jika ingin langsung terunduh
        return $pdf->stream('Kartu-AK1-' . $kartu->nomor_ak1 . '.pdf');
    }
}
