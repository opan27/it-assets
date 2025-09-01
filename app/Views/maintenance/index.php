<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="bg-white shadow-md rounded-2xl p-6 max-w-5xl mx-auto">
  <h2 class="text-2xl font-semibold mb-6 text-gray-800">Daftar Maintenance</h2>

  <?php if(session()->getFlashdata('success')): ?>
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <table class="min-w-full text-sm text-gray-600 border">
    <thead class="bg-gray-800 text-white">
      <tr>
        <th class="px-4 py-2">Asset</th>
        <th class="px-4 py-2">Pegawai</th>
        <th class="px-4 py-2">Kendala</th>
        <th class="px-4 py-2">Status</th>
        <th class="px-4 py-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($maintenance)): ?>
        <?php foreach($maintenance as $m): ?>
          <tr class="border-b">
            <td class="px-4 py-2"><?= $m['kode_asset'] ?> - <?= $m['nama_item'] ?></td>
            <td class="px-4 py-2"><?= $m['nama_pegawai'] ?></td>
            <td class="px-4 py-2"><?= $m['kendala'] ?></td>
            <td class="px-4 py-2">
              <!-- status maintenance -->
              <span class="px-2 py-1 rounded text-xs font-semibold 
                <?= $m['status_maintenance']=='selesai' ? 'bg-green-100 text-green-700':'bg-yellow-100 text-yellow-700' ?>">
                  <?= ucfirst($m['status_maintenance']) ?>
              </span>
              <br>
              <!-- status asset -->
              <span class="px-2 py-1 rounded text-xs font-semibold 
                <?= $m['status_asset']=='terpakai' ? 'bg-blue-100 text-blue-700' : 
                  ($m['status_asset']=='maintenance' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700') ?>">
                  <?= ucfirst($m['status_asset']) ?>
              </span>
            </td>
            <td class="px-4 py-2">
              <?php if (
                    $m['id'] == $m['last_id'] && 
                    strtolower($m['status_maintenance']) === 'maintenance'
                  ): ?>
                  <a href="<?= base_url('maintenance/selesai/'.$m['id']) ?>" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                    Selesaikan
                  </a>
              <?php else: ?>
                  <span class="px-3 py-1 rounded text-xs font-semibold bg-green-100 text-green-700">
                    Done
                  </span>
              <?php endif; ?>
            </td>

          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada data maintenance</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>
