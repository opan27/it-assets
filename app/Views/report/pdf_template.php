<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Aset IT</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2 { text-align: center; margin-bottom: 20px; }
    h3 { margin-top: 30px; margin-bottom: 10px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    table, th, td { border: 1px solid #000; }
    th, td { padding: 8px; text-align: left; vertical-align: top; }
    th { background-color: #f2f2f2; }
    .progress-box { margin-bottom: 20px; padding: 10px; border: 1px solid #000; }
    .progress-box img { max-width: 300px; height: auto; margin-top: 5px; border: 1px solid #ccc; }
  </style>
</head>
<body>
  <h2>Laporan Aset IT Maintenance</h2>

  <!-- Tabel Aset -->
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Item</th>
        <th>Kode Asset</th>
        <th>Kode GA</th>
        <th>Spesifikasi</th>
        <th>Status</th>
        <th>Kategori</th>
        <th>Kondisi</th>
        <th>PIC</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($assets)): ?>
        <?php $no=1; foreach ($assets as $a): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($a['nama_item'] ?? '-') ?></td>
            <td><?= esc($a['kode_asset'] ?? '-') ?></td>
            <td><?= esc($a['kode_ga'] ?? '-') ?></td>
            <td><?= esc($a['spesifikasi'] ?? '-') ?></td>
            <td><?= esc($a['status'] ?? '-') ?></td>
            <td><?= esc($a['kategori'] ?? '-') ?></td>
            <td><?= esc($a['kondisi'] ?? '-') ?></td>
            <td><?= esc($a['pic'] ?? '-') ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="9" style="text-align:center;">Tidak ada data aset.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- Tracking Progress -->
  <h3>Tracking Progress</h3>
  <?php if (!empty($progress_list)): ?>
    <?php foreach ($progress_list as $p): ?>
      <div class="progress-box">
        <p><b>Tanggal:</b> <?= date('d M Y H:i', strtotime($p['created_at'])) ?></p>
        <p><b>Status:</b> <?= esc(strtoupper($p['status'])) ?></p>
        <p><b>Oleh:</b> <?= esc($p['user_nama']) ?></p>
        <p><b>Deskripsi:</b> <?= esc($p['deskripsi']) ?></p>

        <?php if (!empty($p['foto'])): ?>
          <p><b>Foto Progress:</b></p>
          <img src="<?= base_url('uploads/progress/' . $p['foto']) ?>">
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Tidak ada progress.</p>
  <?php endif; ?>

</body>
</html>
