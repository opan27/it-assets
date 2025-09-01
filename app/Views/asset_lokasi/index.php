<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Asset Lokasi</h2>
    
    <!-- Form Assign Asset ke Lokasi -->
    <form action="<?= base_url('asset_lokasi/store') ?>" method="post" 
          class="mb-8 bg-white shadow-md rounded-xl p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Asset -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Asset</label>
                <select name="asset_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Asset --</option>
                    <?php foreach($assets as $a): ?>
                        <option value="<?= $a['id'] ?>"><?= $a['kode_asset'] ?> - <?= $a['nama_item'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <select name="lokasi_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Lokasi --</option>
                    <?php foreach($lokasi as $l): ?>
                        <option value="<?= $l['id'] ?>"><?= $l['lokasi'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Tombol -->
        <div class="mt-6 flex justify-end">
            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow">
                Assign Asset
            </button>
        </div>
    </form>

    <!-- Form Search & Filter Lokasi -->
    <form method="get" action="<?= base_url('asset_lokasi') ?>" 
          class="mb-4 flex flex-col md:flex-row gap-2 items-center">
        <input type="text" name="keyword" placeholder="Cari Asset / Kode Asset / Lokasi"
               value="<?= isset($keyword) ? esc($keyword) : '' ?>"
               class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 w-full md:w-1/3">

        <select name="lokasi_id" onchange="this.form.submit()" 
                class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">-- Semua Lokasi --</option>
            <?php foreach($lokasi as $l): ?>
                <option value="<?= $l['id'] ?>" <?= ($lokasiId == $l['id']) ? 'selected' : '' ?>>
                    <?= $l['lokasi'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
            Cari
        </button>
    </form>

    <!-- Tabel Data Asset Lokasi -->
    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3">Asset</th>
                    <th class="px-4 py-3">Kode Asset</th>
                    <th class="px-4 py-3">Kode GA</th>
                    <th class="px-4 py-3">Lokasi</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Assigned At</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($asset_lokasi)): ?>
                    <?php foreach($asset_lokasi as $al): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3"><?= $al['nama_asset'] ?? '-' ?></td>
                        <td class="px-4 py-3"><?= $al['kode_asset'] ?? '-' ?></td>
                        <td class="px-4 py-3"><?= $al['kode_ga'] ?? '-' ?></td>
                        <td class="px-4 py-3"><?= $al['lokasi'] ?? '-' ?></td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium 
                                <?= ($al['status'] ?? '') === 'terpakai' ? 'bg-yellow-100 text-yellow-700' :
                                   (($al['status'] ?? '') === 'tersedia' ? 'bg-green-100 text-green-700' : 
                                   'bg-gray-100 text-gray-700') ?>">
                                <?= ucfirst($al['status'] ?? '-') ?>
                            </span>
                        </td>
                        <td class="px-4 py-3"><?= $al['assigned_at'] ?? '-' ?></td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-2">
                                
                                <a href="<?= base_url('asset_lokasi/delete/'.$al['id']) ?>" 
                                   onclick="return confirm('Yakin ingin menghapus data ini?')"
                                   class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white py-1.5 px-4 rounded-lg text-xs font-medium shadow transition">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data Asset Lokasi
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
