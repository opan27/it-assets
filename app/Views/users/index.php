<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="p-6 bg-white rounded-xl shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Daftar User</h2>
        <a href="<?= base_url('users/create') ?>" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            Tambah User
        </a>
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
        <table id="usersTable" class="min-w-full table-auto border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border-b">Pegawai</th>
                    <th class="p-3 border-b">Username</th>
                    <th class="p-3 border-b">Role</th>
                    <th class="p-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $u): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2"><?= esc($u['nama_pegawai']) ?></td>
                    <td class="p-2"><?= esc($u['username']) ?></td>
                    <td class="p-2 capitalize"><?= esc($u['role']) ?></td>
                    <td class="p-2">
                        <a href="<?= base_url('users/reset/'.$u['id']) ?>"
                           onclick="return confirm('Yakin ingin reset password user <?= esc($u['username']) ?> menjadi 12345678?');"
                           class="text-red-600 hover:underline">
                           Reset Password
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari user..."
        }
    });
});
</script>

<?= $this->endSection() ?>
