<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Data Pegawai</h2>

    <div class="flex items-center space-x-2">
        <label for="filterEntitas" class="text-sm font-medium">Filter Entitas:</label>
        <select id="filterEntitas" class="border rounded px-2 py-1 text-sm">
            <option value="">Semua Entitas</option>
            <?php foreach($entitas as $e): ?>
                <option value="<?= $e['nama'] ?>"><?= $e['nama'] ?></option>
            <?php endforeach; ?>
        </select>

        <button onclick="toggleModal('importModal')" 
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

<table id="pegawaiTable" class="w-full bg-white shadow-md">
    <thead class="bg-gray-500 text-white">
        <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Department</th>
            <th>Divisi</th>
            <th>Entitas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pegawai as $row): ?>
        <tr>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['jabatan'] ?></td>
            <td><?= $row['department'] ?></td>
            <td><?= $row['divisi'] ?></td>
            <td><?= $row['nama_entitas'] ?? '-' ?></td>
            <td>
                <div class="flex gap-2 justify-center">
                    <a href="/pegawai/edit/<?= $row['id'] ?>" 
                       class="flex-1 text-center px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded">
                       Edit
                    </a>
                    <a href="/pegawai/delete/<?= $row['id'] ?>" 
                       class="flex-1 text-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded"
                       onclick="return confirm('Yakin hapus?')">
                       Delete
                    </a>
                </div>
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

<!-- Scripts DataTables + filter -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#pegawaiTable').DataTable({
        responsive: true,
    });

    // Filter entitas
    $('#filterEntitas').on('change', function() {
        var val = $(this).val();
        table.column(4).search(val).draw(); // kolom 4 = Entitas
    });
});

// Modal import
function toggleModal(id) {
    let modal = document.getElementById(id);
    modal.classList.toggle("hidden");
}
</script>

<?= $this->endSection() ?>
