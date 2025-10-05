<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Assign Asset ke Pegawai</h2>

    <!-- Form Assign Asset -->
    <form id="assignForm" action="<?= base_url('picassets/store') ?>" method="post" 
          class="bg-white shadow-md rounded-xl p-6 space-y-6">
          <?= csrf_field() ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 
            <!-- Pegawai -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pegawai</label>
                <select name="pegawai_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Pegawai --</option>
                    <?php foreach($pegawai as $p): ?>
                        <option value="<?= esc($p['id']) ?>">
                            <?= esc($p['nama']) ?> - <?= esc($p['jabatan']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Asset -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Asset</label>
                <select name="asset_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Asset --</option>
                    <?php foreach($assets as $a): ?>
                        <option value="<?= esc($a['id']) ?>">
                            <?= esc($a['kode_asset']) ?> - <?= esc($a['nama_item']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-3">
            <a href="<?= base_url('picassets') ?>" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-lg shadow">
                Batal
            </a>
            <button type="button" id="btnSubmit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow">
                Simpan & Buat Berita Acara
            </button>
        </div>
    </form>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
        <h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin membuat berita acara untuk asset ini?</p>
        <div class="flex justify-end gap-3">
            <button type="button" id="cancelModal" 
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Batal</button>
            <button type="button" id="confirmYes" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Ya, Buat</button>
        </div>
    </div>
</div>

<script>
    const btnSubmit = document.getElementById('btnSubmit');
    const confirmModal = document.getElementById('confirmModal');
    const cancelModal = document.getElementById('cancelModal');
    const confirmYes = document.getElementById('confirmYes');
    const form = document.getElementById('assignForm');

    btnSubmit.addEventListener('click', () => {
        confirmModal.classList.remove('hidden');
    });

    cancelModal.addEventListener('click', () => {
        confirmModal.classList.add('hidden');
    });

    confirmYes.addEventListener('click', () => {
        form.submit();
    });
</script>

<?= $this->endSection() ?>
