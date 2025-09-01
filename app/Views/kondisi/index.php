<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Master Kondisi</h2>

    <!-- Button Tambah -->
    <button onclick="openModal('addModal')" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg">+ Tambah Kondisi</button>

    <!-- Table -->
    <div class="mt-4 bg-white shadow rounded-lg p-4">
        <table class="w-full text-left border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Kondisi</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($kondisi as $k): ?>
                <tr>
                    <td class="p-2 border"><?= $k['kondisi'] ?></td>
                    <td class="p-2 border">
                        <!-- Edit -->
                        <button onclick="openModal('editModal<?= $k['id'] ?>')" 
                                class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</button>
                        <!-- Delete -->
                        <a href="/kondisi/delete/<?= $k['id'] ?>" 
                           class="px-3 py-1 bg-red-600 text-white rounded"
                           onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div id="editModal<?= $k['id'] ?>" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                    <div class="bg-white rounded-lg p-6 w-96">
                        <h3 class="text-lg font-bold mb-4">Edit Kondisi</h3>
                        <form action="/kondisi/update/<?= $k['id'] ?>" method="post">
                            <input type="text" name="kondisi" value="<?= $k['kondisi'] ?>" 
                                   class="w-full border rounded p-2 mb-4" required>
                            <div class="flex justify-end">
                                <button type="button" onclick="closeModal('editModal<?= $k['id'] ?>')" 
                                        class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div id="addModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-bold mb-4">Tambah Kondisi</h3>
        <form action="/kondisi/store" method="post">
            <input type="text" name="kondisi" placeholder="Nama Kondisi" 
                   class="w-full border rounded p-2 mb-4" required>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('addModal')" 
                        class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
</script>

<?= $this->endSection() ?>
