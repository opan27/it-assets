<?php

namespace App\Controllers;

use App\Models\PicAssetsModel;
use PhpOffice\PhpWord\TemplateProcessor;



class BeritaAcaraController extends BaseController
{
    protected $picModel;

    public function __construct()
    {
        $this->picModel = new PicAssetsModel();
    }

    public function index()
    {
        $data['berita'] = $this->picModel
            ->select("
                pic_assets.id             AS pic_asset_id,
                pegawai.nama              AS nama_pegawai,
                assets.nama_item          AS nama_asset,
                assets.kode_asset         AS kode_asset,
                berita_acara.filename     AS file_name,
                berita_acara.created_at   AS dibuat
            ")
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id', 'left')
            ->join('assets', 'assets.id = pic_assets.asset_id', 'left')
            ->join('berita_acara', 'berita_acara.pic_asset_id = pic_assets.id', 'left')
            ->orderBy('berita_acara.created_at', 'DESC')
            ->findAll();


        return view('berita_acara/index', $data);
    }

    public function download($filename)
    {
        $path = WRITEPATH . 'berita_acara/' . $filename;
        if (file_exists($path)) {
            return $this->response->download($path, null);
        }
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

public function exportDocx($picAssetId)
{
    $pic = $this->picModel
        ->select("
            pic_assets.id,
            pegawai.nama        AS nama_pegawai,
            pegawai.department  AS department,
            pegawai.jabatan,
            assets.nama_item    AS merk,
            assets.kode_asset   AS no_asset,
            assets.spesifikasi AS spesifikasi,
            kondisi.kondisi        AS kondisi
        ")
        ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id', 'left')
        ->join('assets', 'assets.id = pic_assets.asset_id', 'left')
        ->join('kondisi', 'kondisi.id = assets.kondisi_id', 'left')
        ->find($picAssetId);


    if (!$pic) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $templatePath = WRITEPATH . 'templates/berita_acara_template.docx';
    if (!file_exists($templatePath)) {
        throw new \Exception("File template Word tidak ditemukan di $templatePath");
    }
    $processor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

    // Set jumlah = 1 karena pic_assets tidak punya kolom qty/jumlah
    $jumlah = 1;

    $processor->setValue('nomor', '13/GA/BA/IX/2025');
    $processor->setValue('tanggal', date('d-m-Y'));
    $processor->setValue('nama_pegawai', $pic['nama_pegawai']);
    $processor->setValue('departement', $pic['department']);
    $processor->setValue('jabatan', $pic['jabatan']);

    $processor->cloneRow('no', 1);
    $processor->setValue('no#1', 1);
    $processor->setValue('merk#1', $pic['merk']);
    $processor->setValue('spesifikasi#1', $pic['spesifikasi']);
    $processor->setValue('no_asset#1', $pic['no_asset']);
    $processor->setValue('jumlah#1', $jumlah);  // pakai 1
    $processor->setValue('kondisi#1', $pic['kondisi']);

    $filename = 'berita_acara_'.$pic['id'].'.docx';
    $savePath = WRITEPATH.'exports/'.$filename;
    $processor->saveAs($savePath);

    return $this->response->download($savePath, null);
}



}
