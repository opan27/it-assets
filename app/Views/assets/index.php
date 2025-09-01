<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Assets</h2>

    <!-- Form Tambah -->
    <form action="<?= base_url('assets/store') ?>" method="post" class="mb-8 bg-white shadow-md rounded-xl p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Item -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Item</label>
                <input type="text" name="nama_item" 
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" 
                       placeholder="Nama Item" required>
            </div>
            <!-- No Assets -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No Assets</label>
                <input type="text" name="kode_asset" 
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" 
                       placeholder="No Assets">
            </div>
            <!-- No GA -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No GA</label>
                <input type="text" name="kode_ga" 
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" 
                       placeholder="No GA">
            </div>
            <!-- Spesifikasi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Spesifikasi</label>
                <input type="text" name="spesifikasi" 
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" 
                       placeholder="Spesifikasi">
            </div>
            <!-- Dropdown Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori_id" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach($kategori as $k): ?>
                        <option value="<?= $k['id'] ?>"><?= $k['jenis'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Dropdown Kondisi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                <select name="kondisi_id" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <?php foreach($kondisi as $k): ?>
                        <option value="<?= $k['id'] ?>"><?= $k['kondisi'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- Tombol Submit -->
        <div class="mt-6 flex justify-end">
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow">
                Tambah Asset
            </button>
        </div>
    </form>

    <!-- Search & Filter -->
    <form method="get" action="<?= base_url('assets') ?>" class="mb-4 flex flex-col md:flex-row gap-2 items-center">
       <input type="text" name="keyword" placeholder="Cari Item / No Assets / No GA / Kategori"
       value="<?= isset($keyword) ? esc($keyword) : '' ?>"
       class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 w-full md:w-1/3">



        <select name="status" onchange="this.form.submit()" 
                class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">-- Semua Status --</option>
            <option value="tersedia" <?= ($status == 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
            <option value="terpakai" <?= ($status == 'terpakai') ? 'selected' : '' ?>>Terpakai</option>
            <option value="maintenance" <?= ($status == 'maintenance') ? 'selected' : '' ?>>Maintenance</option>
        </select>

        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
            Cari
        </button>
    </form>

    <!-- Tabel Data -->
    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3">Nama Item</th>
                    <th class="px-4 py-3">No Assets</th>
                    <th class="px-4 py-3">No GA</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Spesifikasi</th>
                    <th class="px-4 py-3">Kondisi</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($assets)): ?>
                    <?php foreach($assets as $a): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3"><?= $a['nama_item'] ?></td>
                        <td class="px-4 py-3"><?= $a['kode_asset'] ?></td>
                        <td class="px-4 py-3"><?= $a['kode_ga'] ?></td>
                        <td class="px-4 py-3"><?= $a['nama_kategori'] ?></td>
                        <td class="px-4 py-3"><?= $a['spesifikasi'] ?></td>
                        <td class="px-4 py-3"><?= $a['nama_kondisi'] ?></td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium 
                                <?= $a['status'] === 'tersedia' ? 'bg-green-100 text-green-700' : 
                                   ($a['status'] === 'terpakai' ? 'bg-yellow-100 text-yellow-700' : 
                                   'bg-red-100 text-red-700') ?>">
                                <?= ucfirst($a['status']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 flex gap-1">
                            <a href="<?= base_url('assets/delete/'.$a['id']) ?>" 
                               onclick="return confirm('Yakin hapus?')"
                               class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-lg text-xs shadow">
                               Hapus
                            </a>
                            <a href="<?= base_url('assets/edit/'.$a['id']) ?>" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-lg text-xs shadow">
                               Edit
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
