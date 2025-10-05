<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-8 text-gray-800">Detail PIC Asset</h2>

    <div class="bg-white shadow-lg rounded-2xl p-6 md:p-10 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Pegawai -->
            <div>
                <span class="font-semibold text-gray-600">Pegawai:</span>
                <p class="text-lg text-gray-800 mt-1"><?= esc($pic['nama_pegawai']) ?></p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Jabatan:</span>
                <p class="mt-1"><?= esc($pic['jabatan_pegawai']) ?></p>
            </div>

            <!-- Asset -->
            <div>
                <span class="font-semibold text-gray-600">Nama Asset:</span>
                <p class="mt-1"><?= esc($pic['nama_asset']) ?></p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Kode Asset:</span>
                <p class="mt-1"><?= esc($pic['kode_asset']) ?></p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Kode GA:</span>
                <p class="mt-1"><?= esc($pic['kode_ga']) ?></p>
            </div>

            <!-- Entitas -->
            <div>
                <span class="font-semibold text-gray-600">Entitas:</span>
                <p class="mt-1"><?= esc($pic['nama_entitas']) ?></p>
            </div>

            <!-- Spesifikasi -->
            <div class="md:col-span-2">
                <span class="font-semibold text-gray-600">Spesifikasi:</span>
                <p class="mt-1"><?= esc($pic['spesifikasi']) ?></p>
            </div>

            <!-- Lokasi -->
            <div>
                <span class="font-semibold text-gray-600">Lokasi:</span>
                <p class="mt-1"><?= esc($pic['nama_lokasi']) ?></p>
            </div>

            <!-- Status -->
            <div>
                <span class="font-semibold text-gray-600">Status:</span><br>
                <span class="inline-block px-4 py-1 rounded-full text-sm font-medium mt-1 
                    <?= $pic['asset_status'] === 'terpakai' ? 'bg-green-100 text-green-700' : 
                       ($pic['asset_status'] === 'maintenance' ? 'bg-yellow-100 text-yellow-700' : 
                       ($pic['asset_status'] === 'rusak' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700')) ?>">
                    <?= ucfirst($pic['asset_status']) ?>
                </span>
            </div>

            <!-- Foto Asset -->
            <div class="md:col-span-2">
                <span class="font-semibold text-gray-600">Foto Asset:</span><br>
                <?php if(!empty($pic['foto'])): ?>
                    <div class="mt-2 w-full flex justify-center">
                        <img id="assetImage" src="<?= base_url('uploads/'.$pic['foto']) ?>" 
                             alt="Foto Asset" 
                             class="rounded-xl shadow-md max-h-80 object-cover cursor-pointer transform hover:scale-105 transition duration-300">
                    </div>

                    <!-- Modal -->
                    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
                        <span id="closeModal" class="absolute top-5 right-5 text-white text-3xl cursor-pointer">&times;</span>
                        <img src="<?= base_url('uploads/'.$pic['foto']) ?>" class="max-h-full max-w-full rounded-lg shadow-lg">
                    </div>
                <?php else: ?>
                    <span class="text-gray-400 text-sm mt-1 inline-block">Tidak ada foto</span>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div class="mt-8">
        <a href="<?= base_url('picassets') ?>" 
           class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl shadow-lg transition duration-300">
            Kembali
        </a>
    </div>
</div>

<script>
    const img = document.getElementById('assetImage');
    const modal = document.getElementById('imageModal');
    const close = document.getElementById('closeModal');

    if(img) {
        img.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });
    }

    if(close) {
        close.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    }

    // Tutup modal jika klik di luar gambar
    if(modal){
        modal.addEventListener('click', (e) => {
            if(e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }
</script>

<?= $this->endSection() ?>
