<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Data Pegawai</h2>
    <div>
        <button 
            onclick="toggleModal('importModal')" 
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">
            Import Data
        </button>
        <a href="<?= site_url('pegawai/create') ?>" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
            + Tambah Pegawai
        </a>
        <a href="<?= base_url('pegawai/template') ?>" 
            class="bg-slate-600 text-white underline hover:text-blue-700 px-4 py-2 rounded-md shadow text-sm ml-3">
            Download Template Excel
        </a>

    </div>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div class="p-2 bg-green-200 text-green-800 rounded mb-4">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<table class="w-full border border-gray-200 shadow-sm rounded">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-3 py-2 border">Nama</th>
            <th class="px-3 py-2 border">Jabatan</th>
            <th class="px-3 py-2 border">Department</th>
            <th class="px-3 py-2 border">Divisi</th>
            <th class="px-3 py-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pegawai as $row): ?>
        <tr>
            <td class="px-3 py-2 border"><?= $row['nama'] ?></td>
            <td class="px-3 py-2 border"><?= $row['jabatan'] ?></td>
            <td class="px-3 py-2 border"><?= $row['department'] ?></td>
            <td class="px-3 py-2 border"><?= $row['divisi'] ?></td>
            <td class="px-3 py-2 border">
                <a href="/pegawai/edit/<?= $row['id'] ?>" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                <a href="/pegawai/delete/<?= $row['id'] ?>" class="px-2 py-1 bg-red-600 text-white rounded" onclick="return confirm('Yakin hapus?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Modal Import -->
<div id="importModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold mb-4">Import Data Pegawai</h3>

        <form action="<?= site_url('pegawai/import') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File Excel</label>
                <input type="file" name="file_excel" accept=".xls,.xlsx" required
                       class="block w-full text-sm text-gray-700 border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="toggleModal('importModal')"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                    Batal
                </button>
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                    Import
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function toggleModal(id) {
    let modal = document.getElementById(id);
    modal.classList.toggle("hidden");
}
</script>


<?= $this->endSection() ?>
