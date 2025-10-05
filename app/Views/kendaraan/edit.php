<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-xl font-bold mb-4">Edit Kendaraan</h2>

    <form action="<?= base_url('kendaraan/update/' . $kendaraan['id']) ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?= csrf_field() ?>

        <div>
            <label>No Plat</label>
            <input type="text" name="no_plat" value="<?= esc($kendaraan['no_plat']) ?>" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label>Merk</label>
            <input type="text" name="merk" value="<?= esc($kendaraan['merk']) ?>" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label>Status</label>
            <select name="status_kendaraan" class="w-full border rounded p-2">
                <option value="mazta" <?= $kendaraan['status_kendaraan']=='mazta'?'selected':''; ?>>Mazta</option>
                <option value="cop" <?= $kendaraan['status_kendaraan']=='cop'?'selected':''; ?>>COP</option>
                <option value="rental" <?= $kendaraan['status_kendaraan']=='rental'?'selected':''; ?>>Rental</option>
            </select>
        </div>

        <div>
            <label>Kunci Cadangan</label>
            <select name="kunci_cadangan" class="w-full border rounded p-2">
                <option value="ada" <?= $kendaraan['kunci_cadangan']=='ada'?'selected':''; ?>>Ada</option>
                <option value="tidak ada" <?= $kendaraan['kunci_cadangan']=='tidak ada'?'selected':''; ?>>Tidak Ada</option>
            </select>
        </div>

        <div>
            <label>BPKB</label>
            <select name="bpkb" class="w-full border rounded p-2">
                <option value="ada" <?= $kendaraan['bpkb']=='ada'?'selected':''; ?>>Ada</option>
                <option value="tidak ada" <?= $kendaraan['bpkb']=='tidak ada'?'selected':''; ?>>Tidak Ada</option>
            </select>
        </div>

        <div>
            <label>Nomor Rangka</label>
            <input type="text" name="nomor_rangka" value="<?= esc($kendaraan['nomor_rangka']) ?>" class="w-full border rounded p-2">
        </div>

        <div>
            <label>Nomor Mesin</label>
            <input type="text" name="nomor_mesin" value="<?= esc($kendaraan['nomor_mesin']) ?>" class="w-full border rounded p-2">
        </div>

        <div>
            <label>Tahun Pembelian</label>
            <input type="number" name="tahun_pembelian" value="<?= esc($kendaraan['tahun_pembelian']) ?>" class="w-full border rounded p-2">
        </div>

        <div>
            <label>Lokasi</label>
            <select name="lokasi_id" class="w-full border rounded p-2">
                <option value="">--Pilih Lokasi--</option>
                <?php foreach($lokasi as $l): ?>
                    <option value="<?= $l['id'] ?>" <?= $kendaraan['lokasi_id']==$l['id']?'selected':''; ?>>
                        <?= $l['lokasi'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div>
            <label>Entitas</label>
            <select name="entitas_id" class="w-full border rounded p-2">
                <option value="">--Pilih Entitas--</option>
                <?php foreach($entitas as $e): ?>
                    <option value="<?= $e['id'] ?>" <?= $kendaraan['entitas_id']==$e['id']?'selected':''; ?>>
                        <?= $e['nama'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- contoh untuk field STNK & asuransi -->
        <div>
            <label>STNK Jatuh Tempo</label>
            <input type="date" name="stnk_jatuh_tempo" value="<?= esc($kendaraan['stnk_jatuh_tempo']) ?>" class="w-full border rounded p-2">
        </div>
        <div>
            <label>STNK Lima Tahunan</label>
            <input type="date" name="stnk_lima_tahunan" value="<?= esc($kendaraan['stnk_lima_tahunan']) ?>" class="w-full border rounded p-2">
        </div>
        <div>
            <label>STNK Perpanjangan Berikutnya</label>
            <input type="date" name="stnk_perpanjangan_berikutnya" value="<?= esc($kendaraan['stnk_perpanjangan_berikutnya']) ?>" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Nominal Bayar</label>
            <input type="number" step="0.01" name="nominal_bayar" value="<?= esc($kendaraan['nominal_bayar']) ?>" class="w-full border rounded p-2">
        </div>
        <div>
            <label>No Polis Asuransi</label>
            <input type="text" name="no_polis_asuransi" value="<?= esc($kendaraan['no_polis_asuransi']) ?>" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Asuransi Jatuh Tempo</label>
            <input type="date" name="asuransi_jatuh_tempo" value="<?= esc($kendaraan['asuransi_jatuh_tempo']) ?>" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Asuransi Perpanjangan Berikutnya</label>
            <input type="date" name="asuransi_perpanjangan_berikutnya" value="<?= esc($kendaraan['asuransi_perpanjangan_berikutnya']) ?>" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Nominal Pembayaran Asuransi</label>
            <input type="number" step="0.01" name="nominal_perbayaran_asuransi" value="<?= esc($kendaraan['nominal_perbayaran_asuransi']) ?>" class="w-full border rounded p-2">
        </div>

        <div class="md:col-span-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
