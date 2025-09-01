<?php
namespace App\Controllers;

use App\Models\AssetModel;
use Dompdf\Dompdf;

class Report extends BaseController
{
    public function export()
    {
        $assetModel = new AssetModel();
        // 🔽 ambil data lengkap (join kategori, kondisi, PIC)
        $assets = $assetModel->getReport();

        // load view jadi html
        $html = view('report/pdf_template', ['assets' => $assets]);

        // inisialisasi Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // setting kertas & orientasi
        $dompdf->setPaper('A4', 'portrait');

        // render PDF
        $dompdf->render();

        // stream ke browser (langsung download)
        $dompdf->stream('laporan_aset.pdf', ["Attachment" => true]);
    }
}
