<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Manajemen PIC Assets</h2>
    
    <!-- Form Assign Asset -->
    <form action="<?= base_url('picassets/store') ?>" method="post" 
          class="mb-8 bg-white shadow-md rounded-xl p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Pegawai -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pegawai</label>
                <select name="pegawai_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Pegawai --</option>
                    <?php foreach($pegawai as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nama'] ?> - <?= $p['jabatan'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

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
        </div>

        <!-- Tombol -->
        <div class="mt-6 flex justify-end">
            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow">
                Assign Asset
            </button>
        </div>
    </form>
    <form method="get" action="<?= base_url('picassets') ?>" class="mb-4 flex flex-col md:flex-row gap-2 items-center">
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

    <button type="submit" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
        Cari
    </button>
</form>


    <!-- Tabel Data PIC -->
    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full text-sm text-left text-gray-600">
<thead class="bg-gray-800 text-white">
    <tr>
        <th class="px-4 py-3">Pegawai</th>
        <th class="px-4 py-3">Jabatan</th>
        <th class="px-4 py-3">Asset</th>
        <th class="px-4 py-3">Kode Asset</th>
        <th class="px-4 py-3">Kode GA</th>
        <th class="px-4 py-3">Spesifikasi</th>
        <th class="px-4 py-3">Status</th>
        <th class="px-4 py-3">Assigned At</th>
        <th class="px-4 py-3">Aksi</th>
    </tr>
</thead>
<tbody>
<?php if(!empty($pic)): ?>
    <?php foreach($pic as $p): ?>
    <tr class="border-b hover:bg-gray-50">
        <td class="px-4 py-3"><?= $p['nama_pegawai'] ?? '-' ?></td>
        <td class="px-4 py-3"><?= $p['jabatan_pegawai'] ?? '-' ?></td>
        <td class="px-4 py-3"><?= $p['nama_asset'] ?? '-' ?></td>
        <td class="px-4 py-3"><?= $p['kode_asset'] ?? '-' ?></td>
        <td class="px-4 py-3"><?= $p['kode_ga'] ?? '-' ?></td>
        <td class="px-4 py-3"><?= $p['spesifikasi'] ?? '-' ?></td>
        <td class="px-4 py-3">
            <span class="px-2 py-1 rounded-full text-xs font-medium 
                <?= ($p['asset_status'] ?? '') === 'terpakai' ? 'bg-green-100 text-green-700' : 
                   (($p['asset_status'] ?? '') === 'maintenance' ? 'bg-yellow-100 text-yellow-700' : 
                   (($p['asset_status'] ?? '') === 'rusak' ? 'bg-red-100 text-red-700' : 
                   'bg-gray-100 text-gray-700')) ?>">
                <?= ucfirst($p['asset_status'] ?? '-') ?>
            </span>
        </td>
        <td class="px-4 py-3"><?= $p['assigned_at'] ?? '-' ?></td>
        <td class="px-4 py-3">
            <div class="flex flex-wrap gap-2">
                <!-- Tombol Lepas -->
                <a href="<?= base_url('picassets/release/'.$p['id']) ?>" 
                   class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white py-1.5 px-4 rounded-lg text-xs font-medium shadow transition">
                    Lepas
                </a>

                <!-- Maintenance / Selesai Maintenance -->
                <?php if(($p['asset_status'] ?? '') === 'maintenance'): ?>
                    <a href="<?= base_url('picassets/selesai-maintenance/'.$p['id']) ?>" 
                       class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-4 rounded-lg text-xs font-medium shadow transition">
                       Selesai Maintenance
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('picassets/maintenance/'.$p['id']) ?>" 
                       class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                       Maintenance
                    </a>
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="9" class="px-4 py-6 text-center text-gray-500">Belum ada data PIC Assets</td>
    </tr>
<?php endif; ?>
</tbody>


        </table>
    </div>
</div>

<?= $this->endSection() ?>
