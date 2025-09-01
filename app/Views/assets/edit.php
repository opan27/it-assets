<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Asset</h2>

    <form action="<?= base_url('assets/update/'.$asset['id']) ?>" method="post" class="bg-white shadow-md rounded-xl p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Nama Item</label>
                <input type="text" name="nama_item" value="<?= $asset['nama_item'] ?>" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">No Asset</label>
                <input type="text" name="kode_asset" value="<?= $asset['kode_asset'] ?>" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">No GA</label>
                <input type="text" name="kode_ga" value="<?= $asset['kode_ga'] ?>" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Spesifikasi</label>
                <textarea name="spesifikasi" class="w-full border rounded-lg px-3 py-2"><?= $asset['spesifikasi'] ?></textarea>
            </div>
            <div>
                <label class="block mb-1 font-medium">Kategori</label>
                <select name="kategori_id" class="w-full border rounded-lg px-3 py-2">
                    <?php foreach($kategori as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= $k['id'] == $asset['kategori_id'] ? 'selected' : '' ?>>
                            <?= $k['jenis'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-medium">Kondisi</label>
                <select name="kondisi_id" class="w-full border rounded-lg px-3 py-2">
                    <?php foreach($kondisi as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= $k['id'] == $asset['kondisi_id'] ? 'selected' : '' ?>>
                            <?= $k['kondisi'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-medium">Status</label>
                <select name="status" class="w-full border rounded-lg px-3 py-2">
                    <option value="tersedia" <?= $asset['status'] == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                    <option value="terpakai" <?= $asset['status'] == 'terpakai' ? 'selected' : '' ?>>Terpakai</option>
                    <option value="maintenance" <?= $asset['status'] == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                </select>
            </div>
        </div>

        <div class="mt-6 flex gap-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Update</button>
            <a href="<?= base_url('assets') ?>" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
