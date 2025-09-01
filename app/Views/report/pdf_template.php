<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Aset IT</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2 { text-align: center; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    table, th, td { border: 1px solid #000; }
    th, td { padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
  </style>
</head>
<body>
  <h2>Laporan Aset IT Maintenance</h2>
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
</body>
</html>
