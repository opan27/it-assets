<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<h1 class="text-xl font-bold mb-4">Edit Pegawai</h1>

<form action="/pegawai/update/<?= $pegawai['id'] ?>" method="post" class="space-y-3">
    <input type="text" name="nama" value="<?= $pegawai['nama'] ?>" class="w-full p-2 border rounded" required>
    <input type="text" name="jabatan" value="<?= $pegawai['jabatan'] ?>" class="w-full p-2 border rounded">
    <input type="text" name="department" value="<?= $pegawai['department'] ?>" class="w-full p-2 border rounded">
    <input type="text" name="divisi" value="<?= $pegawai['divisi'] ?>" class="w-full p-2 border rounded">

    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Update</button>
</form>

<?= $this->endSection() ?>
