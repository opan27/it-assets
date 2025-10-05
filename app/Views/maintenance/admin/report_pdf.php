<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 12pt; 
            line-height: 1.6; 
            margin: 40px; 
        }
        h2 { 
            text-align: center; 
            text-transform: uppercase; 
            margin-bottom: 20px; 
        }
        p { text-align: justify; }
        .info { margin: 20px 0; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            font-size: 11pt; 
        }
        table, th, td { 
            border: 1px solid #333; 
            padding: 6px; 
        }
        th { background: #f2f2f2; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>

    <!-- Halaman 1: Surat Formal -->
    <h2>LAPORAN PENYELESAIAN MAINTENANCE</h2>

    <p>Pada hari ini, <b><?= date('d F Y') ?></b>, telah dilakukan pekerjaan maintenance
       terhadap aset perusahaan dengan identitas sebagai berikut:</p>

    <div class="info">
        <p>
            <b>Nama Asset :</b> <?= esc($maintenance['asset_nama']) ?><br>
            <b>Kode Asset :</b> <?= esc($maintenance['kode_asset']) ?><br>
            <b>Kode GA :</b> <?= esc($maintenance['kode_ga']) ?><br>
            <b>Spesifikasi :</b> <?= esc($maintenance['spesifikasi']) ?><br>
            <b>PIC :</b> <?= esc($maintenance['pic_nama']) ?><br>
            <b>Entitas :</b> <?= esc($maintenance['entitas_nama']) ?><br>
            <b>Status :</b> <?= strtoupper(esc($maintenance['status'])) ?><br>
        </p>
    </div>

    <p>
        Pekerjaan ini dimulai pada tanggal
        <b><?= date('d F Y', strtotime($maintenance['created_at'])) ?></b> 
        dan diperbarui terakhir pada tanggal 
        <b><?= !empty($maintenance['updated_at']) ? date('d F Y', strtotime($maintenance['updated_at'])) : '-' ?></b>.
    </p>

    <p>
        Dengan ini dinyatakan bahwa pekerjaan maintenance terhadap aset tersebut
        <b>telah selesai dilaksanakan</b> dan aset dinyatakan <b>dapat digunakan kembali</b>.
    </p>

    <!-- Tanda tangan dengan tabel -->
<table style="width:100%; text-align:center; margin-top:50px; border:0;">
    <tr>
        <td style="width:25%; border:0;">
            <b>Diproses</b><br><br><br><br>
            <?= esc($maintenance['assigned_to_nama']) ?><br>
            IT Engineer
        </td>
        <td style="width:25%; border:0;">
            <b>Diserahkan</b><br><br><br><br>
            <?= esc($maintenance['created_by_nama']) ?><br>
            Admin Maintenance
        </td>
        <td style="width:25%; border:0;">
            <b>Diterima</b><br><br><br><br>
            <?= esc($maintenance['pic_nama']) ?><br>
            PIC Aset
        </td>
    </tr>
</table>

    <!-- Halaman 2: Tracking Progress -->
    <div class="page-break"></div>
    <h2>Tracking Progress</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Deskripsi</th>
                <th>Oleh</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($progress_list)): ?>
                <?php foreach ($progress_list as $p): ?>
                <tr>
                    <td><?= date('d M Y H:i', strtotime($p['created_at'])) ?></td>
                    <td><?= strtoupper($p['status']) ?></td>
                    <td><?= esc($p['deskripsi']) ?></td>
                    <td><?= esc($p['user_nama']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center">Belum ada progress</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
