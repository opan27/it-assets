<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div x-data="{ openCreate: false, openEdit: null }" class="p-6 bg-white rounded-xl shadow">

    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">Manajemen Kategori</h3>
        <button @click="openCreate = true" 
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Tambah Kategori
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

    <div class="overflow-x-auto">
        <table id="kategoriTable" class="min-w-full table-auto border border-gray-200 bg-white rounded-md shadow-md">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Jenis</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($kategori as $row): ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border"><?= $no++ ?></td>
                    <td class="p-2 border"><?= esc($row['jenis']) ?></td>
                    <td class="p-2 border">
                        <button @click="openEdit = <?= $row['id'] ?>" 
                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 mr-2">
                            Edit
                        </button>
                        <a href="<?= base_url('kategori/delete/'.$row['id']) ?>" 
                           onclick="return confirm('Hapus data ini?')" 
                           class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                           Hapus
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div x-show="openEdit === <?= $row['id'] ?>" x-cloak
                     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                        <h2 class="text-lg font-semibold mb-4">Edit Kategori</h2>
                        <form action="<?= base_url('kategori/update/'.$row['id']) ?>" method="post">
                            <div class="mb-4">
                                <label class="block mb-1">Jenis</label>
                                <input type="text" name="jenis" 
                                       value="<?= $row['jenis'] ?>" 
                                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" @click="openEdit = null" 
                                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                    Batal
                                </button>
                                <button type="submit" 
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Create -->
    <div x-show="openCreate" x-cloak
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-semibold mb-4">Tambah Kategori</h2>
            <form action="<?= base_url('kategori/store') ?>" method="post">
                <div class="mb-4">
                    <label class="block mb-1">Jenis</label>
                    <input type="text" name="jenis" 
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" @click="openCreate = false" 
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Alpine.js -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#kategoriTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5,10,25,50],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari kategori..."
        },
        columnDefs: [
            { orderable: false, targets: 2 } // kolom aksi tidak bisa di-sort
        ]
    });
});
</script>

<?= $this->endSection() ?>
