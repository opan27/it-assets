<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<h2 class="text-2xl font-semibold mb-6">Edit Asset</h2>

<form action="<?= base_url('assets/update/'.$asset['id']) ?>" method="post" enctype="multipart/form-data" class="mb-8 bg-white shadow-md rounded-xl p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Nama Item -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Item</label>
            <input type="text" name="nama_item" 
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" 
                   value="<?= $asset['nama_item'] ?>" required>
        </div>
        
        <!-- No Assets -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No Assets</label>
            <input type="text" name="kode_asset" 
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" 
                   value="<?= $asset['kode_asset'] ?>">
        </div>
        
        <!-- No GA -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No GA</label>
            <input type="text" name="kode_ga" 
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" 
                   value="<?= $asset['kode_ga'] ?>">
        </div>
        
        <!-- Spesifikasi -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Spesifikasi</label>
            <textarea name="spesifikasi" 
                      class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"><?= $asset['spesifikasi'] ?></textarea>
        </div>
        
        <!-- Dropdown Kategori -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="kategori_id" 
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach($kategori as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= ($asset['kategori_id'] == $k['id']) ? 'selected' : '' ?>>
                        <?= $k['jenis'] ?>
                    </option>
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
                    <option value="<?= $k['id'] ?>" <?= ($asset['kondisi_id'] == $k['id']) ? 'selected' : '' ?>>
                        <?= $k['kondisi'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Dropdown Entitas -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Entitas</label>
            <select name="entitas_id" 
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Pilih Entitas --</option>
                <?php foreach($entitas as $e): ?>
                    <option value="<?= $e['id'] ?>" <?= ($asset['entitas_id'] == $e['id']) ? 'selected' : '' ?>>
                        <?= $e['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Upload Foto -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
            <input type="file" name="foto" 
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            <?php if($asset['foto']): ?>
                <img src="<?= base_url('uploads/'.$asset['foto']) ?>" class="mt-2 w-32 h-32 object-cover rounded" alt="Foto Asset">
            <?php endif; ?>
        </div>
        
        <!-- Dropdown Lokasi -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
            <select name="lokasi_id" 
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Pilih Lokasi --</option>
                <?php foreach($lokasi as $l): ?>
                    <option value="<?= $l['id'] ?>" <?= ($asset['lokasi_id'] == $l['id']) ? 'selected' : '' ?>>
                        <?= $l['lokasi'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Tombol Submit -->
    <div class="mt-6 flex justify-end">
        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow">
            Update Asset
        </button>
    </div>
</form>

<?= $this->endSection() ?>
