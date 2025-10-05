<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Ajukan Maintenance</h2>

    <form action="<?= base_url('maintenance/store') ?>" method="post" class="bg-white shadow-lg rounded-2xl p-6 space-y-6">

        <!-- PILIH ASSET -->
        <div>
            <label for="assetSelect" class="block font-semibold text-gray-700 mb-2">Pilih Asset:</label>
           <select id="assetSelect" name="asset_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih Asset --</option>
                <?php foreach($assets as $asset): ?>
                    <option value="<?= $asset['id'] ?>">
                        <?= $asset['kode_asset'] ?> - <?= $asset['nama_item'] ?> (<?= $asset['status'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

        </div>

        <!-- DETAIL ASSET -->
        <div id="assetDetail" class="bg-gray-100 p-4 rounded space-y-1">
            Pilih asset untuk melihat detail
        </div>

        <!-- DETAIL KENDALA -->
        <div>
            <label for="kendala" class="block font-semibold text-gray-700 mb-2">Detail Kendala:</label>
            <textarea name="kendala" id="kendala" rows="4" class="w-full border p-2 rounded" placeholder="Jelaskan kendala asset..."></textarea>
        </div>

        <!-- PILIH TEKNISI -->
        <div>
            <label for="assigned_to" class="block font-semibold text-gray-700 mb-2">Assign Teknisi:</label>
            <select name="assigned_to" id="assigned_to" class="w-full border p-2 rounded">
                <option value="">-- Pilih Teknisi --</option>
                <?php foreach($teknisi as $t): ?>
                    <option value="<?= $t['user_id'] ?>"><?= $t['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- PRIORITAS -->
<div>
    <label for="priority" class="block font-semibold text-gray-700 mb-2">Prioritas:</label>
    <select name="priority" id="priority" class="w-full border p-2 rounded">
        <option value="low">Low (7 hari)</option>
        <option value="medium">Medium (5 hari)</option>
        <option value="high">High (2 hari)</option>
    </select>
</div>


        <!-- TOMBOL SUBMIT -->
        <div class="mt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow-lg transition duration-300">
                Ajukan Maintenance
            </button>
        </div>
    </form>
</div>

<script>
    const assetSelect = document.getElementById('assetSelect');
    const assetDetail = document.getElementById('assetDetail');

    assetSelect.addEventListener('change', function() {
        const assetId = this.value;
        if(!assetId) {
            assetDetail.innerHTML = 'Pilih asset untuk melihat detail';
            return;
        }

        fetch('/maintenance/get-asset-detail/' + assetId)
            .then(res => res.json())
            .then(data => {
                let html = `
                    <p><strong>Nama PIC:</strong> ${data.pic_nama ?? '-'}</p>
                    <p><strong>Kode Asset:</strong> ${data.kode_asset ?? '-'}</p>
                    <p><strong>Kode GA:</strong> ${data.kode_ga ?? '-'}</p>
                    <p><strong>Spesifikasi:</strong> ${data.spesifikasi ?? '-'}</p>
                    <p><strong>Status:</strong> ${data.status ?? '-'}</p>
                `;
                assetDetail.innerHTML = html;
            })
            .catch(err => {
                console.error(err);
                assetDetail.innerHTML = 'Gagal memuat detail asset';
            });
    });
</script>

<?= $this->endSection() ?>
