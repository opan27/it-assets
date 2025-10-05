<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Arsip Berita Acara</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table id="tbl-berita" class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Pegawai</th>
                    <th class="px-4 py-3">Asset</th>
                    <th class="px-4 py-3">Kode Asset</th>
                    <th class="px-4 py-3">Nama File</th>
                    <th class="px-4 py-3">Tanggal Dibuat</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($berita)): ?>
                    <?php $no = 1; foreach ($berita as $b): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3"><?= $no++ ?></td>
                            <td class="px-4 py-3"><?= esc($b['nama_pegawai'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($b['nama_asset'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($b['kode_asset'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($b['file_name'] ?? '-') ?></td>
                            <td class="px-4 py-3">
                                <?= !empty($b['dibuat']) ? date('d/m/Y H:i', strtotime($b['dibuat'])) : '-' ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="<?= base_url('berita-acara/export/'.$b['pic_asset_id']) ?>"
                                   class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                    Export DOCX
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data Berita Acara
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tbl-berita').DataTable({
            pageLength: 10,
            order: [[5, 'desc']]
        });
    });
</script>

<?= $this->endSection() ?>
