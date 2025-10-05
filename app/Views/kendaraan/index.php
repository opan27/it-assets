<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-6xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-xl font-bold mb-4">Daftar Kendaraan</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="mb-4">
        <a href="<?= base_url('kendaraan/create') ?>"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Tambah Kendaraan
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">No Plat</th>
                    <th class="border px-4 py-2">Merk</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Lokasi</th>
                    <th class="border px-4 py-2">Entitas</th>
                    <th>STNK Jatuh Tempo</th>
                    <th>Asuransi Jatuh Tempo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kendaraan)): ?>
                    <?php $no = 1; foreach ($kendaraan as $row): ?>
                        <tr>
                            <td class="border px-4 py-2 text-center"><?= $no++ ?></td>
                            <td class="border px-4 py-2"><?= esc($row['no_plat']) ?></td>
                            <td class="border px-4 py-2"><?= esc($row['merk']) ?></td>
                            <td class="border px-4 py-2"><?= esc($row['status_kendaraan']) ?></td>
                            <td class="border px-4 py-2"><?= esc($row['nama_lokasi']) ?></td>
                            <td class="border px-4 py-2"><?= esc($row['nama_entitas']) ?></td>
                            <td><?= esc($row['stnk_jatuh_tempo']) ?></td>
                            <td><?= esc($row['asuransi_jatuh_tempo']) ?></td>
                            <td class="border px-4 py-2 text-center">
                                <a href="<?= base_url('kendaraan/edit/' . $row['id']) ?>"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                <form action="<?= base_url('kendaraan/delete/' . $row['id']) ?>"
                                      method="post" class="inline"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    <?= csrf_field() ?>
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="border px-4 py-4 text-center text-gray-500">
                            Belum ada data kendaraan
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
