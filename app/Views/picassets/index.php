<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Manajemen PIC Assets</h2>

    <!-- Tombol Assign Asset -->
    <div class="mb-6">
        <a href="<?= base_url('picassets/create') ?>" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow">
           + Assign Asset
        </a>
    </div>

    <!-- Filter & Search -->
    <form method="get" action="<?= base_url('picassets') ?>" 
          class="mb-6 flex flex-col md:flex-row gap-3 items-center">
        
        <input type="text" name="keyword" placeholder="Cari Pegawai / Asset / Kode Asset / Kode GA"
            value="<?= isset($keyword) ? esc($keyword) : '' ?>"
            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 w-full md:w-1/3">

        <select name="status" onchange="this.form.submit()" 
            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">-- Semua Status --</option>
            <option value="tersedia" <?= ($status == 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
            <option value="terpakai" <?= ($status == 'terpakai') ? 'selected' : '' ?>>Terpakai</option>
            <option value="maintenance" <?= ($status == 'maintenance') ? 'selected' : '' ?>>Maintenance</option>
            <option value="rusak" <?= ($status == 'rusak') ? 'selected' : '' ?>>Rusak</option>
        </select>

        <select name="entitas_id" onchange="this.form.submit()" 
            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">-- Semua Entitas --</option>
            <?php foreach($entitas as $e): ?>
                <option value="<?= $e['id'] ?>" <?= (isset($entitas_id) && $entitas_id == $e['id']) ? 'selected' : '' ?>>
                    <?= $e['nama'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md shadow">
            Cari
        </button>
    </form>

    <!-- Tabel Data PIC -->
    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-800 text-white text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Pegawai</th>
                    <th class="px-4 py-3 text-left">Jabatan</th>
                    <th class="px-4 py-3 text-left">Asset</th>
                    <th class="px-4 py-3 text-center">Kode Asset</th>
                    <th class="px-4 py-3 text-center">Kode GA</th>
                    <th class="px-4 py-3 text-left">Entitas</th>
                    <th class="px-4 py-3 text-left">Spesifikasi</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Berita Acara</th>
                    <th class="px-4 py-3 text-center">Assigned At</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($pic)): ?>
                    <?php foreach($pic as $p): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3"><?= esc($p['nama_pegawai'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($p['jabatan_pegawai'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($p['nama_asset'] ?? '-') ?></td>
                            <td class="px-4 py-3 text-center"><?= esc($p['kode_asset'] ?? '-') ?></td>
                            <td class="px-4 py-3 text-center"><?= esc($p['kode_ga'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($p['nama_entitas'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($p['spesifikasi'] ?? '-') ?></td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 rounded-full text-xs font-medium 
                                    <?= ($p['asset_status'] ?? '') === 'terpakai' ? 'bg-green-100 text-green-700' : 
                                       (($p['asset_status'] ?? '') === 'maintenance' ? 'bg-yellow-100 text-yellow-700' : 
                                       (($p['asset_status'] ?? '') === 'rusak' ? 'bg-red-100 text-red-700' : 
                                       'bg-gray-100 text-gray-700')) ?>">
                                    <?= ucfirst($p['asset_status'] ?? '-') ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="<?= base_url('berita-acara/export/'.$p['id']) ?>"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-xs font-medium whitespace-nowrap inline-flex items-center">
                                Export DOCX
                                </a>

                            </td>
                            <td class="px-4 py-3 text-center"><?= esc($p['assigned_at'] ?? '-') ?></td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-wrap justify-center gap-2">
                                    <a href="<?= base_url('picassets/detail/'.$p['id']) ?>" 
                                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-4 rounded-lg text-xs font-medium shadow transition">
                                        Detail 
                                    </a>
                                    <button data-picid="<?= $p['id'] ?>" 
                                        class="releaseBtn inline-flex items-center bg-red-500 hover:bg-red-600 text-white py-1.5 px-4 rounded-lg text-xs font-medium shadow transition">
                                        Lepas
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data PIC Assets
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Lepas Asset -->
<div id="releaseModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4">Konfirmasi Lepas Asset</h3>
        <p>Apakah yakin ingin melepas asset ini?</p>
        <form id="releaseForm" method="post">
            <?= csrf_field() ?>
            <div class="flex justify-end mt-6 gap-2">
                <button type="button" id="closeModal" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Lepas</button>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelectorAll('.releaseBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        const picId = this.dataset.picid;
        const modal = document.getElementById('releaseModal');
        const form = document.getElementById('releaseForm');
        form.action = '<?= base_url("picassets/release") ?>/' + picId;
        modal.classList.remove('hidden');
    });
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('releaseModal').classList.add('hidden');
});
</script>

<?= $this->endSection() ?>
