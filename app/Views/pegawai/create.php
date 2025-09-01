<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<h1 class="text-xl font-bold mb-4">Tambah Pegawai</h1>

<form action="/pegawai/store" method="post" class="space-y-3">
    <input type="text" name="nama" placeholder="Nama" class="w-full p-2 border rounded" required>
    <input type="text" name="jabatan" placeholder="Jabatan" class="w-full p-2 border rounded">
    <input type="text" name="department" placeholder="Department" class="w-full p-2 border rounded">
    <input type="text" name="divisi" placeholder="Divisi" class="w-full p-2 border rounded">

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
</form>

<?= $this->endSection() ?>
