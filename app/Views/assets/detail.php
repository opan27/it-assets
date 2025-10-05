<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto px-4 py-8">

    <h2 class="text-3xl font-bold mb-8 text-gray-800">Detail Asset</h2>

    <?php if(isset($asset) && $asset): ?>
    <div class="bg-white shadow-lg rounded-2xl p-6 md:p-10 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <span class="font-semibold text-gray-600">Nama Item:</span>
                <p class="text-lg text-gray-800 mt-1"><?= esc($asset['nama_item'] ?? '-') ?></p>
            </div>

            <div>
                <span class="font-semibold text-gray-600">No Asset:</span>
                <p class="mt-1"><?= esc($asset['kode_asset'] ?? '-') ?></p>
            </div>

            <div>
                <span class="font-semibold text-gray-600">No GA:</span>
                <p class="mt-1"><?= esc($asset['kode_ga'] ?? '-') ?></p>
            </div>

            <div>
                <span class="font-semibold text-gray-600">Kategori:</span>
                <p class="mt-1"><?= esc($asset['nama_kategori'] ?? '-') ?></p>
            </div>

            <div>
                <span class="font-semibold text-gray-600">Kondisi:</span>
                <p class="mt-1"><?= esc($asset['nama_kondisi'] ?? '-') ?></p>
            </div>

            <div>
                <span class="font-semibold text-gray-600">Entitas:</span>
                <p class="mt-1"><?= esc($asset['nama_entitas'] ?? '-') ?></p>
            </div>

            <div class="md:col-span-2">
                <span class="font-semibold text-gray-600">Spesifikasi:</span>
                <p class="mt-1"><?= esc($asset['spesifikasi'] ?? '-') ?></p>
            </div>

            <div>
                <span class="font-semibold text-gray-600">Lokasi:</span>
                <p class="mt-1"><?= esc($asset['nama_lokasi'] ?? '-') ?></p>
            </div>

            <div>
                <span class="font-semibold text-gray-600">Status:</span><br>
                <span class="inline-block px-4 py-1 rounded-full text-sm font-medium mt-1 
                    <?= $asset['status'] === 'tersedia' ? 'bg-green-100 text-green-700' : 
                       ($asset['status'] === 'terpakai' ? 'bg-yellow-100 text-yellow-700' : 
                       'bg-red-100 text-red-700') ?>">
                    <?= ucfirst($asset['status'] ?? '-') ?>
                </span>
            </div>

            <div class="md:col-span-2">
                <span class="font-semibold text-gray-600">Foto:</span><br>
                <?php if(!empty($asset['foto']) && file_exists('uploads/'.$asset['foto'])): ?>
                    <div class="mt-2 w-full flex justify-center">
                        <img id="assetImage" src="<?= base_url('uploads/'.$asset['foto']) ?>" 
                             alt="Foto Asset" 
                             class="rounded-xl shadow-md max-h-80 object-cover cursor-pointer transform hover:scale-105 transition duration-300">
                    </div>

                    <!-- Modal -->
                    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
                        <span id="closeModal" class="absolute top-5 right-5 text-white text-3xl cursor-pointer">&times;</span>
                        <img src="<?= base_url('uploads/'.$asset['foto']) ?>" class="max-h-full max-w-full rounded-lg shadow-lg">
                    </div>
                <?php else: ?>
                    <span class="text-gray-400 text-sm mt-1 inline-block">Tidak ada foto</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <a href="<?= base_url('assets') ?>" 
           class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl shadow-lg transition duration-300">
            Kembali
        </a>
    </div>

    <?php else: ?>
        <p class="text-center text-red-500 font-semibold">Asset tidak ditemukan.</p>
    <?php endif; ?>
</div>

<script>
    const img = document.getElementById('assetImage');
    const modal = document.getElementById('imageModal');
    const close = document.getElementById('closeModal');

    if(img && modal && close) {
        img.addEventListener('click', () => modal.classList.remove('hidden'));
        close.addEventListener('click', () => modal.classList.add('hidden'));
        modal.querySelector('img').addEventListener('click', e => e.stopPropagation());
        modal.addEventListener('click', e => { if(e.target === modal) modal.classList.add('hidden'); });
    }
</script>

<?= $this->endSection() ?>
