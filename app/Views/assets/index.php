<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <!-- Title -->
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Assets</h2>

    <!-- Action Buttons & Filters -->
    <div class="mb-4 flex flex-col md:flex-row gap-3 items-center">
        <!-- Tombol Tambah -->
    <div class="mb-4 flex gap-2">
    <a href="<?= base_url('assets/create') ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
        + Tambah Asset
    </a>
    <button onclick="toggleModal('importModal')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
        Import Excel
    </button>
    <a href="<?= base_url('assets/template') ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow">
        Download Template
    </a>
</div>

        <!-- Filter Status -->
        <select id="filterStatus" 
                class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">-- Semua Status --</option>
            <option value="tersedia">Tersedia</option>
            <option value="terpakai">Terpakai</option>
            <option value="maintenance">Maintenance</option>
        </select>

        <!-- Filter Entitas -->
        <select id="filterEntitas" 
                class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">-- Semua Entitas --</option>
            <?php foreach ($entitas as $e): ?>
                <option value="<?= esc($e['nama']) ?>"><?= esc($e['nama']) ?></option>
            <?php endforeach; ?>
        </select>

        <!-- 🔥 Filter Kategori -->
        <select id="filterKategori" 
                class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">-- Semua Kategori --</option>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= esc($k['jenis']) ?>"><?= esc($k['jenis']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Tabel Assets -->
    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table id="tableAssets" class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th>Nama Item</th>
                    <th>No Assets</th>
                    <th>No GA</th>
                    <th>Kategori</th>
                    <th>Entitas</th>
                    <th>Spesifikasi</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assets as $a): ?>
                    <tr>
                        <td><?= esc($a['nama_item']) ?></td>
                        <td><?= esc($a['kode_asset']) ?></td>
                        <td><?= esc($a['kode_ga']) ?></td>
                        <td><?= esc($a['nama_kategori']) ?></td>
                        <td><?= esc($a['nama_entitas']) ?></td>
                        <td><?= esc($a['spesifikasi']) ?></td>
                        <td><?= esc($a['nama_kondisi']) ?></td>
                        <td><?= esc($a['nama_lokasi']) ?></td>
                        <td>
                            <?php if (!empty($a['foto'])): ?>
                                <img src="<?= base_url('uploads/'.$a['foto']) ?>" 
                                     class="h-12 w-12 object-cover rounded">
                            <?php else: ?>
                                <span class="text-gray-400 text-xs">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php 
                                $status = strtolower($a['status'] ?? '');
                                $badgeClass = match($status) {
                                    'tersedia'   => 'bg-green-100 text-green-700',
                                    'terpakai'   => 'bg-red-100 text-red-700',
                                    'maintenance'=> 'bg-yellow-100 text-yellow-700',
                                    default      => 'bg-gray-100 text-gray-700',
                                };
                            ?>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $badgeClass ?>">
                                <?= ucfirst($status) ?>
                            </span>
                        </td>
                        <td class="flex gap-1">
                            <a href="<?= base_url('assets/edit/'.$a['id']) ?>" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">
                                Edit
                            </a>
                            <a href="<?= base_url('assets/delete/'.$a['id']) ?>" 
                               onclick="return confirm('Yakin hapus?')" 
                               class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div id="importModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white p-6 rounded-lg shadow-md w-96">
    <h3 class="text-lg font-bold mb-4">Import Data Asset</h3>
    <form action="<?= base_url('assets/import') ?>" method="post" enctype="multipart/form-data">
      <input type="file" name="file_excel" accept=".xls,.xlsx" required class="mb-3 w-full">
      <div class="flex justify-end gap-2">
        <button type="button" onclick="toggleModal('importModal')" class="bg-gray-400 px-4 py-2 rounded">Batal</button>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Upload</button>
      </div>
    </form>
  </div>
</div>

<script>
function toggleModal(id) {
  document.getElementById(id).classList.toggle('hidden');
}
</script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#tableAssets').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: { previous: "Sebelumnya", next: "Berikutnya" },
                zeroRecords: "Data tidak ditemukan"
            }
        });

        // Custom filter status + entitas + kategori
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var statusFilter   = ($('#filterStatus').val() || '').toLowerCase();
            var entitasFilter  = ($('#filterEntitas').val() || '').toLowerCase();
            var kategoriFilter = ($('#filterKategori').val() || '').toLowerCase();

            var rowStatus   = ($('<div>').html(data[9] || '').text() || '').trim().toLowerCase();
            var rowEntitas  = (data[4] || '').trim().toLowerCase();
            var rowKategori = (data[3] || '').trim().toLowerCase();

            if (
                (statusFilter === "" || rowStatus === statusFilter) &&
                (entitasFilter === "" || rowEntitas === entitasFilter) &&
                (kategoriFilter === "" || rowKategori === kategoriFilter)
            ) {
                return true;
            }
            return false;
        });

        // Event trigger filter
        $('#filterStatus, #filterEntitas, #filterKategori').on('change', function() {
            table.draw();
        });
    });
</script>

<?= $this->endSection() ?>
