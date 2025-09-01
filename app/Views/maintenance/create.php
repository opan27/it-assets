<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="bg-white shadow-md rounded-2xl p-6 max-w-2xl mx-auto">
  <h2 class="text-2xl font-semibold mb-6 text-gray-800">Tambah Data Maintenance</h2>

  <form action="<?= base_url('maintenance/store') ?>" method="post" class="space-y-5">
    <input type="hidden" name="asset_id" value="<?= $picAsset['asset_id'] ?>">
    <input type="hidden" name="pic_id" value="<?= $picAsset['pic_id'] ?>">

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Asset</label>
      <input type="text" value="<?= $picAsset['nama_item'] ?> (<?= $picAsset['kode_asset'] ?>)" readonly class="w-full rounded-lg border-gray-300 bg-gray-100 text-gray-700">
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Pegawai</label>
      <input type="text" value="<?= $picAsset['nama_pegawai'] ?>" readonly class="w-full rounded-lg border-gray-300 bg-gray-100 text-gray-700">
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Kendala</label>
      <textarea name="kendala" rows="4" placeholder="Tuliskan kendala..." class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <div class="pt-2">
      <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
