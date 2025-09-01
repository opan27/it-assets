<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Activity Logs</h2>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Action</th>
                    <th class="px-4 py-3">Module</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3">IP Address</th>
                    <th class="px-4 py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($activities)): ?>
                    <?php foreach ($activities as $log): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                <?= esc($log['username'] ?? 'Unknown') ?>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    <?= $log['action'] === 'create' ? 'bg-green-100 text-green-700' :
                                        ($log['action'] === 'update' ? 'bg-blue-100 text-blue-700' :
                                        ($log['action'] === 'delete' ? 'bg-red-100 text-red-700' :
                                        'bg-gray-100 text-gray-700')) ?>">
                                    <?= ucfirst($log['action']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-3"><?= esc($log['module']) ?></td>
                            <td class="px-4 py-3"><?= esc($log['description']) ?></td>
                            <td class="px-4 py-3 text-gray-500"><?= esc($log['ip_address']) ?></td>
                            <td class="px-4 py-3 text-gray-500">
                                <?= date('d-m-Y H:i', strtotime($log['created_at'])) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Belum ada aktivitas.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
