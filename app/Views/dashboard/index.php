<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
  <!-- Card Pegawai -->
  <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
    <div>
      <h2 class="text-lg font-semibold mb-2">Pegawai</h2>
      <p class="text-gray-600">
        Total: <span class="font-bold text-blue-600"><?= $totalPegawai ?? 0 ?></span>
      </p>
    </div>
    <div class="bg-blue-100 p-3 rounded-full">
      <i class="fas fa-users text-blue-600 text-xl"></i>
    </div>
  </div>

  <!-- Card Assets -->
  <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
    <div>
      <h2 class="text-lg font-semibold mb-2">Assets</h2>
      <p class="text-gray-600">
        Total: <span class="font-bold text-green-600"><?= $totalAssets ?? 0 ?></span>
      </p>
    </div>
    <div class="bg-green-100 p-3 rounded-full">
      <i class="fas fa-laptop text-green-600 text-xl"></i>
    </div>
  </div>

  <!-- Card Report -->
  <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
    <div>
      <h2 class="text-lg font-semibold mb-2">Report</h2>
      <p class="text-gray-600">Export laporan aset terbaru.</p>
      <a href="/report/export" 
         class="inline-block mt-2 bg-indigo-600 text-white px-3 py-1 rounded-lg text-sm">
        Export PDF
      </a>
    </div>
    <div class="bg-indigo-100 p-3 rounded-full">
      <i class="fas fa-file-alt text-indigo-600 text-xl"></i>
    </div>
  </div>
</div>

<!-- Grafik Aset Masuk per Bulan -->
<div class="bg-white shadow rounded-lg p-6 mb-6">
  <h2 class="text-lg font-semibold mb-4">Statistik Aset Masuk</h2>
  <canvas id="chartAssets"></canvas>
</div>

<!-- Aktivitas Terbaru -->
<div class="bg-white shadow rounded-lg p-6">
  <h2 class="text-lg font-semibold mb-4">Aktivitas Terbaru</h2>
  <ul class="divide-y divide-gray-200">
    <?php if (!empty($latestLogs)): ?>
      <?php foreach($latestLogs as $log): ?>
        <li class="py-2">
          <div class="flex justify-between">
            <div>
              <span class="font-semibold text-blue-600"><?= esc($log['action']) ?></span>
              <span class="text-gray-600"> (<?= esc($log['module']) ?>)</span>
              <p class="text-sm text-gray-500"><?= esc($log['description']) ?></p>
            </div>
            <span class="text-sm text-gray-400"><?= esc($log['created_at']) ?></span>
          </div>
        </li>
      <?php endforeach; ?>
    <?php else: ?>
      <li class="py-2 text-gray-500">Belum ada aktivitas terbaru.</li>
    <?php endif; ?>
  </ul>
</div>


<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById("chartAssets").getContext("2d");


new Chart(ctx, {
    type: "line",
    data: {
        labels: <?= json_encode($bulan) ?>,
        datasets: [
            {
                label: "Aset Masuk",
                data: <?= json_encode($jumlahAset) ?>,
                borderColor: "blue",
                backgroundColor: "rgba(0,0,255,0.1)",
                fill: true,
            },
            {
                label: "Aset Maintenance",
                data: <?= json_encode($jumlahMaintenance) ?>,
                borderColor: "red",
                backgroundColor: "rgba(255,0,0,0.1)",
                fill: true,
            }
        ]
    }
});

</script>

<?= $this->endSection() ?>
