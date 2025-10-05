<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\EntitasModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Pegawai extends Controller
{
    protected $pegawaiModel;
    protected $entitasModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
        $this->entitasModel = new EntitasModel();
    }

    public function index()
    {
        $data['pegawai'] = $this->pegawaiModel->getPegawaiWithEntitas(); // biar join entitas
        $data['entitas'] = $this->entitasModel->findAll();
        return view('pegawai/index', $data);
    }

    public function import()
{
    $file = $this->request->getFile('file_excel');

    if (!$file || !$file->isValid() || $file->hasMoved()) {
        return redirect()->back()->with('error', 'File tidak valid!');
    }

    $ext = $file->getClientExtension();
    if (!in_array($ext, ['xls', 'xlsx'])) {
        return redirect()->back()->with('error', 'File harus Excel (.xls / .xlsx)');
    }

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($file->getTempName());
    $sheet = $spreadsheet->getActiveSheet()->toArray();

    $successCount = 0;
    $skipCount = 0;

    foreach ($sheet as $i => $row) {
        if ($i == 0) continue; // skip header

        $nama       = $row[0] ?? null;
        $jabatan    = $row[1] ?? null;
        $department = $row[2] ?? null;
        $divisi     = $row[3] ?? null;
        $entitasNama= trim($row[4] ?? '');

        // Pakai entitasModel
        $entitasRow = $this->entitasModel->where('nama', $entitasNama)->first();
        $entitasId  = $entitasRow ? $entitasRow['id'] : null;

        if (!$entitasId) {
            $skipCount++;
            continue;
        }

        $data = [
            'nama'       => $nama,
            'jabatan'    => $jabatan,
            'department' => $department,
            'divisi'     => $divisi,
            'entitas_id' => $entitasId,
        ];

        $this->pegawaiModel->insert($data);
        $successCount++;
    }

    $msg = "Import selesai! Berhasil: $successCount, Dilewati karena entitas tidak ditemukan: $skipCount";
    return redirect()->to(base_url('pegawai'))->with('success', $msg);
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
        $sheet->setCellValue('E1', 'entitas_id'); // tambahin entitas

        // Styling header
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

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
        $data['entitas'] = $this->entitasModel->findAll();
        return view('pegawai/create', $data);
    }

    public function store()
    {
        $this->pegawaiModel->save([
            'nama'       => $this->request->getPost('nama'),
            'jabatan'    => $this->request->getPost('jabatan'),
            'department' => $this->request->getPost('department'),
            'divisi'     => $this->request->getPost('divisi'),
            'entitas_id' => $this->request->getPost('entitas_id'),
        ]);
        return redirect()->to('/pegawai')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['pegawai'] = $this->pegawaiModel->find($id);
        $data['entitas'] = $this->entitasModel->findAll();
        return view('pegawai/edit', $data);
    }

    public function update($id)
    {
        $this->pegawaiModel->update($id, [
            'nama'       => $this->request->getPost('nama'),
            'jabatan'    => $this->request->getPost('jabatan'),
            'department' => $this->request->getPost('department'),
            'divisi'     => $this->request->getPost('divisi'),
            'entitas_id' => $this->request->getPost('entitas_id'),
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

        foreach ($rows as $key => $row) {
            if ($key == 0) continue;

            $entitasId = !empty($row[4]) ? $row[4] : null;
            if ($entitasId && !$this->entitasModel->find($entitasId)) {
                continue;
            }

            $data = [
                'nama'       => $row[0],
                'jabatan'    => $row[1],
                'department' => $row[2],
                'divisi'     => $row[3],
                'entitas_id' => $entitasId,
            ];

            $this->pegawaiModel->insert($data);
        }

        return redirect()->to('/pegawai')->with('success', 'Data pegawai berhasil diimport.');
    }

    return redirect()->back()->with('error', 'File tidak valid.');
}
}
