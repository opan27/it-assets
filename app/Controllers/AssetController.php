<?php

namespace App\Controllers;

use App\Models\AssetModel;
use App\Models\KategoriModel;
use App\Models\KondisiModel;
use App\Models\EntitasModel;   
use App\Models\ActivityModel;
use App\Models\LokasiModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class AssetController extends BaseController
{
    protected $assetModel;
    protected $kategoriModel;
    protected $kondisiModel;
    protected $entitasModel;
    protected $lokasiModel;
    protected $activityModel;
    protected $db;

    public function __construct()
    {
        $this->assetModel    = new AssetModel();
        $this->kategoriModel = new KategoriModel();
        $this->kondisiModel  = new KondisiModel();
        $this->entitasModel  = new EntitasModel();
        $this->lokasiModel   = new LokasiModel();
        $this->activityModel = new ActivityModel();
        $this->db            = \Config\Database::connect(); // ✅ tambahkan koneksi DB
    }

    public function index()
    {
        $status    = $this->request->getGet('status');
        $keyword   = $this->request->getGet('keyword');
        $entitasId = $this->request->getGet('entitas_id');
        $lokasiId  = $this->request->getGet('lokasi_id');

        $builder = $this->assetModel
            ->select('assets.*, kategori.jenis as nama_kategori, kondisi.kondisi as nama_kondisi, entitas.nama as nama_entitas, lokasi.lokasi as nama_lokasi')
            ->join('kategori', 'kategori.id = assets.kategori_id', 'left')
            ->join('kondisi', 'kondisi.id = assets.kondisi_id', 'left')
            ->join('entitas', 'entitas.id = assets.entitas_id', 'left')
            ->join('lokasi', 'lokasi.id = assets.lokasi_id', 'left');

        if ($status) {
            $builder->where('assets.status', $status);
        }

        if ($entitasId) {
            $builder->where('assets.entitas_id', $entitasId);
        }

        if ($lokasiId) {
            $builder->where('assets.lokasi_id', $lokasiId);
        }

        if ($keyword) {
            $builder->groupStart()
                ->like('assets.nama_item', $keyword)
                ->orLike('assets.kode_asset', $keyword)
                ->orLike('assets.kode_ga', $keyword)
                ->orLike('kategori.jenis', $keyword)
                ->orLike('entitas.nama', $keyword)
                ->orLike('lokasi.lokasi', $keyword)
                ->groupEnd();
        }

        $data['assets']   = $builder->findAll();
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['kondisi']  = $this->kondisiModel->findAll();
        $data['entitas']  = $this->entitasModel->findAll();
        $data['lokasi']   = $this->lokasiModel->findAll();
        $data['status']   = $status;
        $data['keyword']  = $keyword;
        $data['entitasId']= $entitasId;
        $data['lokasiId'] = $lokasiId;

        return view('assets/index', $data);
    }

    public function store()
    {
        $foto = $this->request->getFile('foto');
        $fotoName = null;

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads', $fotoName);
        }

        $data = [
            'nama_item'   => $this->request->getPost('nama_item'),
            'kode_asset'  => $this->request->getPost('kode_asset'),
            'kode_ga'     => $this->request->getPost('kode_ga'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'kondisi_id'  => $this->request->getPost('kondisi_id'),
            'entitas_id'  => $this->request->getPost('entitas_id'),
            'lokasi_id'   => $this->request->getPost('lokasi_id'),
            'status'      => 'tersedia',
            'foto'        => $fotoName
        ];

        $this->assetModel->insert($data);

        return redirect()->to(base_url('assets'))->with('success', 'Asset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['asset']    = $this->assetModel->find($id);
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['kondisi']  = $this->kondisiModel->findAll();
        $data['entitas']  = $this->entitasModel->findAll();
        $data['lokasi']   = $this->lokasiModel->findAll();

        return view('assets/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_item'   => $this->request->getPost('nama_item'),
            'kode_asset'  => $this->request->getPost('kode_asset'),
            'kode_ga'     => $this->request->getPost('kode_ga'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'kondisi_id'  => $this->request->getPost('kondisi_id'),
            'entitas_id'  => $this->request->getPost('entitas_id'),
            'lokasi_id'   => $this->request->getPost('lokasi_id'),
            'status'      => $this->request->getPost('status'),
        ];

        $this->assetModel->update($id, $data);

        return redirect()->to(base_url('assets'))->with('success', 'Data berhasil diperbarui.');
    }

    public function create()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['kondisi']  = $this->kondisiModel->findAll();
        $data['entitas']  = $this->entitasModel->findAll();
        $data['lokasi']   = $this->lokasiModel->findAll();

        return view('assets/create', $data);
    }

    public function detail($id)
    {
        $asset = $this->assetModel
            ->select('assets.*, kategori.jenis as nama_kategori, kondisi.kondisi as nama_kondisi, entitas.nama as nama_entitas, lokasi.lokasi as nama_lokasi')
            ->join('kategori', 'kategori.id = assets.kategori_id', 'left')
            ->join('kondisi', 'kondisi.id = assets.kondisi_id', 'left')
            ->join('entitas', 'entitas.id = assets.entitas_id', 'left')
            ->join('lokasi', 'lokasi.id = assets.lokasi_id', 'left')
            ->find($id);

        if (!$asset) {
            return redirect()->to(base_url('assets'))->with('error', 'Asset tidak ditemukan.');
        }

        $data['asset'] = $asset;
        return view('assets/detail', $data);
    }

    public function import()
    {
        $file = $this->request->getFile('file_excel');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            for ($i = 1; $i < count($sheet); $i++) {
                $row = $sheet[$i];

                if (empty($row[0])) continue; // skip baris kosong

                $namaItem    = trim($row[0] ?? '');
                $kodeAsset   = trim($row[1] ?? '');
                $kodeGa      = trim($row[2] ?? '');
                $spesifikasi = trim($row[3] ?? '');
                $kategori    = strtoupper(trim($row[4] ?? ''));
                $kondisi     = strtoupper(trim($row[5] ?? ''));
                $entitas     = strtoupper(trim($row[6] ?? ''));
                $lokasi      = strtoupper(trim($row[7] ?? ''));
                $status      = $row[8] ?? 'tersedia';

                $kategoriRow = $this->db->table('kategori')->where('jenis', $kategori)->get()->getRow();
                $kategoriId  = $kategoriRow ? $kategoriRow->id : null;

                $kondisiRow  = $this->db->table('kondisi')->where('kondisi', $kondisi)->get()->getRow();
                $kondisiId   = $kondisiRow ? $kondisiRow->id : null;

                $entitasRow  = $this->db->table('entitas')->where('nama', $entitas)->get()->getRow();
                $entitasId   = $entitasRow ? $entitasRow->id : null;

                $lokasiRow   = $this->db->table('lokasi')->where('lokasi', $lokasi)->get()->getRow();
                $lokasiId    = $lokasiRow ? $lokasiRow->id : null;

                if (!$kategoriId) {
                    continue; // skip kalau kategori tidak ditemukan
                }

                $data = [
                    'nama_item'   => $namaItem,
                    'kode_asset'  => $kodeAsset,
                    'kode_ga'     => $kodeGa,
                    'spesifikasi' => $spesifikasi,
                    'kategori_id' => $kategoriId,
                    'kondisi_id'  => $kondisiId,
                    'entitas_id'  => $entitasId,
                    'lokasi_id'   => $lokasiId,
                    'status'      => $status,
                ];

                $this->db->table('assets')->insert($data);
            }

            return redirect()->back()->with('success', 'Import berhasil!');
        }

        return redirect()->back()->with('error', 'File tidak valid!');
    }

    public function template()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'nama_item');
        $sheet->setCellValue('B1', 'kode_asset');
        $sheet->setCellValue('C1', 'kode_ga');
        $sheet->setCellValue('D1', 'spesifikasi');
        $sheet->setCellValue('E1', 'kategori');
        $sheet->setCellValue('F1', 'kondisi');
        $sheet->setCellValue('G1', 'entitas');
        $sheet->setCellValue('H1', 'lokasi');
        $sheet->setCellValue('I1', 'status');

        $sheet->getStyle('A1:I1')->getFont()->setBold(true);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'template_assets.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save("php://output");
        exit;
    }
}
