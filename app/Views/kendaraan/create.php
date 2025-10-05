<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-xl font-bold mb-4">Tambah Kendaraan</h2>

    <form action="<?= base_url('kendaraan/store') ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label>No Plat</label>
            <input type="text" name="no_plat" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label>Merk</label>
            <input type="text" name="merk" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label>Status</label>
            <select name="status_kendaraan" class="w-full border rounded p-2">
                <option value="mazta">Mazta</option>
                <option value="cop">COP</option>
                <option value="rental">Rental</option>
            </select>
        </div>
        <div>
            <label>Kunci Cadangan</label>
            <select name="kunci_cadangan" class="w-full border rounded p-2">
                <option value="ada">Ada</option>
                <option value="tidak ada">Tidak Ada</option>
            </select>
        </div>
        <div>
            <label>BPKB</label>
            <select name="bpkb" class="w-full border rounded p-2">
                <option value="ada">Ada</option>
                <option value="tidak ada">Tidak Ada</option>
            </select>
        </div>
        <div>
            <label>Nomor Rangka</label>
            <input type="text" name="nomor_rangka" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Nomor Mesin</label>
            <input type="text" name="nomor_mesin" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Tahun Pembelian</label>
            <input type="number" name="tahun_pembelian" class="w-full border rounded p-2">
        </div>
        <div>
            <label>STNK Jatuh Tempo</label>
            <input type="date" name="stnk_jatuh_tempo" class="w-full border rounded p-2">
        </div>
        <div>
            <label>STNK Lima Tahunan</label>
            <input type="date" name="stnk_lima_tahunan" class="w-full border rounded p-2">
        </div>
        <div>
            <label>STNK Perpanjangan Berikutnya</label>
            <input type="date" name="stnk_perpanjangan_berikutnya" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Nominal Bayar</label>
            <input type="number" step="0.01" name="nominal_bayar" class="w-full border rounded p-2">
        </div>

        <div>
            <label>No Polis Asuransi</label>
            <input type="text" name="no_polis_asuransi" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Asuransi Jatuh Tempo</label>
            <input type="date" name="asuransi_jatuh_tempo" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Asuransi Perpanjangan Berikutnya</label>
            <input type="date" name="asuransi_perpanjangan_berikutnya" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Nominal Perbayaran Asuransi</label>
            <input type="number" step="0.01" name="nominal_perbayaran_asuransi" class="w-full border rounded p-2">
        </div>

        <div>
            <label>Lokasi</label>
            <select name="lokasi_id" class="w-full border rounded p-2">
                <option value="">--Pilih Lokasi--</option>
                <?php foreach($lokasi as $l): ?>
                    <option value="<?= $l['id'] ?>"><?= $l['lokasi'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <label>Entitas</label>
            <select name="entitas_id" class="w-full border rounded p-2">
                <option value="">--Pilih Entitas--</option>
                <?php foreach($entitas as $e): ?>
                    <option value="<?= $e['id'] ?>"><?= $e['nama'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="md:col-span-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
