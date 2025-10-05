<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="p-6 bg-white rounded-xl shadow">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Master Kondisi</h2>
        <button onclick="openModal('addModal')" 
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            + Tambah Kondisi
        </button>
    </div>

    <!-- Flashdata -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="bg-green-100 text-green-800 p-3 rounded mb-3">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="bg-red-100 text-red-800 p-3 rounded mb-3">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="kondisiTable" class="min-w-full table-auto border border-gray-200 bg-white rounded-md shadow-md">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="p-2 border">Kondisi</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($kondisi as $k): ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border"><?= esc($k['kondisi']) ?></td>
                    <td class="p-2 border">
                        <button onclick="openModal('editModal<?= $k['id'] ?>')" 
                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 mr-2">
                            Edit
                        </button>
                        <a href="/kondisi/delete/<?= $k['id'] ?>" 
                           onclick="return confirm('Yakin hapus kondisi ini?')" 
                           class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Hapus
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div id="editModal<?= $k['id'] ?>" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white rounded-lg p-6 w-96">
                        <h3 class="text-lg font-bold mb-4">Edit Kondisi</h3>
                        <form action="/kondisi/update/<?= $k['id'] ?>" method="post">
                            <input type="text" name="kondisi" value="<?= esc($k['kondisi']) ?>" 
                                   class="w-full border rounded p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <div class="flex justify-end">
                                <button type="button" onclick="closeModal('editModal<?= $k['id'] ?>')" 
                                        class="px-4 py-2 bg-gray-500 text-white rounded mr-2 hover:bg-gray-600">Batal</button>
                                <button type="submit" 
                                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
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
<div id="addModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-bold mb-4">Tambah Kondisi</h3>
        <form action="/kondisi/store" method="post">
            <input type="text" name="kondisi" placeholder="Nama Kondisi" 
                   class="w-full border rounded p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('addModal')" 
                        class="px-4 py-2 bg-gray-500 text-white rounded mr-2 hover:bg-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
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

<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#kondisiTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5,10,25,50],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari kondisi..."
        },
        columnDefs: [
            { orderable: false, targets: 1 } // kolom aksi tidak bisa di-sort
        ]
    });
});
</script>

<?= $this->endSection() ?>
