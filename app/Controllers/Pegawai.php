<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Pegawai extends Controller
{
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $data['pegawai'] = $this->pegawaiModel->findAll();
        return view('pegawai/index', $data);
    }

            public function import()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $ext = $file->getClientExtension();
            if ($ext == 'xls' || $ext == 'xlsx') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($file->getTempName());
                $sheet = $spreadsheet->getActiveSheet()->toArray();

                foreach ($sheet as $i => $row) {
                    if ($i == 0) continue; // Skip header
                    $data = [
                        'nama'       => $row[0],
                        'jabatan'    => $row[1],
                        'department' => $row[2],
                        'divisi'     => $row[3],
                    ];
                    $this->pegawaiModel->insert($data);
                }
            }
        }
        return redirect()->to(base_url('pegawai'))->with('success', 'Data pegawai berhasil diimport');
    }

    public function template()
{
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header kolom
    $sheet->setCellValue('A1', 'nama');
    $sheet->setCellValue('B1', 'jabatan');
    $sheet->setCellValue('C1', 'department');
    $sheet->setCellValue('D1', 'divisi');

    // Styling header
    $sheet->getStyle('A1:D1')->getFont()->setBold(true);

    // Buat writer untuk Excel
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

    // Download otomatis
    $filename = 'template_pegawai.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $writer->save("php://output");
    exit;
}


    public function create()
    {
        return view('pegawai/create');
    }

    public function store()
    {
        $this->pegawaiModel->save([
            'nama'       => $this->request->getPost('nama'),
            'jabatan'    => $this->request->getPost('jabatan'),
            'department' => $this->request->getPost('department'),
            'divisi'     => $this->request->getPost('divisi'),
        ]);
        return redirect()->to('/pegawai')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['pegawai'] = $this->pegawaiModel->find($id);
        return view('pegawai/edit', $data);
    }

    public function update($id)
    {
        $this->pegawaiModel->update($id, [
            'nama'       => $this->request->getPost('nama'),
            'jabatan'    => $this->request->getPost('jabatan'),
            'department' => $this->request->getPost('department'),
            'divisi'     => $this->request->getPost('divisi'),
        ]);
        return redirect()->to('/pegawai')->with('success', 'Pegawai berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->pegawaiModel->delete($id);
        return redirect()->to('/pegawai')->with('success', 'Pegawai berhasil dihapus.');
    }

        public function upload()
    {
        $file = $this->request->getFile('file_excel');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Lewati baris pertama jika header
            foreach ($rows as $key => $row) {
                if ($key == 0) continue; 

                $data = [
                    'nama'       => $row[0],
                    'jabatan'    => $row[1],
                    'department' => $row[2],
                    'divisi'     => $row[3],
                ];

                $this->pegawaiModel->insert($data);
            }

            return redirect()->to('/pegawai')->with('success', 'Data pegawai berhasil diimport.');
        }

        return redirect()->back()->with('error', 'File tidak valid.');
    }
}
