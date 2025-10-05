<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto p-6 bg-white rounded-xl shadow">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Teknisi</h2>
    </div>

    <!-- Tabel Data -->
    <div class="overflow-x-auto">
        <table id="ticketsTable" class="min-w-full border border-gray-200 text-sm text-gray-700">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Kode Asset</th>
                    <th class="px-4 py-3 text-left">Asset</th>
                    <th class="px-4 py-3 text-left">PIC</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-left">Prioritas</th>
                    <th class="px-4 py-3 text-left">Deadline</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tickets)): ?>
                    <?php foreach($tickets as $t): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3"><?= esc($t['kode_asset'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($t['asset_nama'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($t['pic_nama'] ?? '-') ?></td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    <?= ($t['status'] == 'open') ? 'bg-yellow-100 text-yellow-700' : '' ?>
                                    <?= ($t['status'] == 'in_progress') ? 'bg-blue-100 text-blue-700' : '' ?>
                                    <?= ($t['status'] == 'done') ? 'bg-green-100 text-green-700' : '' ?>
                                    <?= ($t['status'] == 'rejected') ? 'bg-red-100 text-red-700' : '' ?>">
                                    <?= ucfirst($t['status']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    <?= ($t['priority'] == 'high') ? 'bg-red-100 text-red-700' : '' ?>
                                    <?= ($t['priority'] == 'medium') ? 'bg-yellow-100 text-yellow-700' : '' ?>
                                    <?= ($t['priority'] == 'low') ? 'bg-green-100 text-green-700' : '' ?>">
                                    <?= ucfirst($t['priority']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <?php if (!empty($t['due_date']) && $t['due_date'] !== '0000-00-00 00:00:00'): ?>
                                    <?= date('d M Y H:i', strtotime($t['due_date'])) ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="<?= base_url('teknisi/detail/'.$t['id']) ?>"
                                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md text-xs font-medium shadow transition">
                                   Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="border-b">
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada tiket maintenance</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ticketsTable').DataTable({
            pageLength: 10,
            order: [[0, 'asc']],
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    });
</script>

<?= $this->endSection() ?>
