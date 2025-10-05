<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
  <!-- Card Pegawai -->
  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-2">Pegawai (<?= esc($entitas['kode']) ?>)</h2>
    <p>Total: <span class="font-bold text-blue-600"><?= $totalPegawai ?></span></p>
  </div>

  <!-- Card Assets -->
  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-2">Assets (<?= esc($entitas['kode']) ?>)</h2>
    <p>Total: <span class="font-bold text-green-600"><?= $totalAssets ?></span></p>
  </div>
</div>

<!-- === Data Pegawai === -->
<div class="bg-white shadow rounded-lg p-6 mb-6">
  <h2 class="text-lg font-semibold mb-4">Daftar Pegawai</h2>
  <div class="overflow-x-auto">
    <table class="min-w-full border text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-3 py-2 border">Nama</th>
          <th class="px-3 py-2 border">Jabatan</th>
          <th class="px-3 py-2 border">Department</th>
          <th class="px-3 py-2 border">Divisi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($pegawaiList): ?>
          <?php foreach ($pegawaiList as $pg): ?>
            <tr>
              <td class="px-3 py-2 border"><?= esc($pg['nama']) ?></td>
              <td class="px-3 py-2 border"><?= esc($pg['jabatan']) ?></td>
              <td class="px-3 py-2 border"><?= esc($pg['department']) ?></td>
              <td class="px-3 py-2 border"><?= esc($pg['divisi']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="4" class="px-3 py-2 text-center text-gray-500">Belum ada pegawai</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- === Data Asset === -->
<div class="bg-white shadow rounded-lg p-6 mb-6">
  <h2 class="text-lg font-semibold mb-4">Daftar Asset</h2>
  <div class="overflow-x-auto">
    <table class="min-w-full border text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-3 py-2 border">Nama Item</th>
          <th class="px-3 py-2 border">Kategori</th>
          <th class="px-3 py-2 border">Kondisi</th>
          <th class="px-3 py-2 border">Lokasi</th>
          <th class="px-3 py-2 border">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($assetList): ?>
          <?php foreach ($assetList as $as): ?>
            <tr>
              <td class="px-3 py-2 border"><?= esc($as['nama_item']) ?></td>
              <td class="px-3 py-2 border"><?= esc($as['kategori']) ?></td>
              <td class="px-3 py-2 border"><?= esc($as['kondisi']) ?></td>
              <td class="px-3 py-2 border"><?= esc($as['lokasi']) ?></td>
              <td class="px-3 py-2 border"><?= esc($as['status']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="5" class="px-3 py-2 text-center text-gray-500">Belum ada asset</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Grafik Aset -->
<div class="bg-white shadow rounded-lg p-6">
  <h2 class="text-lg font-semibold mb-4">Statistik Aset Masuk (<?= esc($entitas['kode']) ?>)</h2>
  <canvas id="chartAssets"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById("chartAssets"), {
    type: "bar",
    data: {
        labels: <?= json_encode($bulan) ?>,
        datasets: [{
            label: "Aset Masuk",
            data: <?= json_encode($jumlahAset) ?>,
            backgroundColor: "rgba(54, 162, 235, 0.6)"
        }]
    }
});
</script>

<?= $this->endSection() ?>
