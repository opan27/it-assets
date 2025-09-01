<?php
namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\AssetModel;
use App\Models\ActivityModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $pegawaiModel  = new PegawaiModel();
        $assetModel    = new AssetModel();
        $activityModel = new ActivityModel();

        $db = \Config\Database::connect();

        // Ambil aset masuk per bulan
        $asetMasuk = $db->table('assets')
            ->select("MONTH(created_at) as bulan, COUNT(*) as total")
            ->groupBy("MONTH(created_at)")
            ->get()->getResultArray();

        // Ambil aset maintenance per bulan
        $asetMaintenance = $db->table('assets')
            ->select("MONTH(updated_at) as bulan, COUNT(*) as total")
            ->where('status', 'maintenance')
            ->groupBy("MONTH(updated_at)")
            ->get()->getResultArray();

        // siapkan array 12 bulan default
        $bulan = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];
        $jumlahAsetMasuk = array_fill(0, 12, 0);
        $jumlahMaintenance = array_fill(0, 12, 0);

        // mapping hasil query ke array
        foreach ($asetMasuk as $row) {
            $jumlahAsetMasuk[$row['bulan']-1] = (int)$row['total'];
        }
        foreach ($asetMaintenance as $row) {
            $jumlahMaintenance[$row['bulan']-1] = (int)$row['total'];
        }

        $data = [
            'title'            => 'Dashboard IT Maintenance',
            'totalPegawai'     => $pegawaiModel->countAllResults(),
            'totalAssets'      => $assetModel->countAllResults(),
            'latestLogs'       => $activityModel->orderBy('created_at','DESC')->findAll(5),
            'bulan'            => $bulan,
            'jumlahAset'       => $jumlahAsetMasuk,
            'jumlahMaintenance'=> $jumlahMaintenance
        ];

        return view('dashboard/index', $data);
    }
}
