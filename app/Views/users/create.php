<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4">Tambah User</h2>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('users/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Pegawai</label>
            <select name="pegawai_id" class="border p-2 rounded w-full">
                <option value="">-- Pilih Pegawai --</option>
                <?php foreach($pegawai as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= old('pegawai_id') == $p['id'] ? 'selected' : '' ?>>
                        <?= esc($p['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if(session()->getFlashdata('errors')['pegawai_id'] ?? false): ?>
                <span class="text-red-600 text-sm"><?= session()->getFlashdata('errors')['pegawai_id'] ?></span>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Role</label>
            <select name="role" class="border p-2 rounded w-full">
                <option value="">-- Pilih Role --</option>
                <option value="superadmin" <?= old('role') == 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                <option value="teknisi" <?= old('role') == 'teknisi' ? 'selected' : '' ?>>Teknisi</option>
            </select>
            <?php if(session()->getFlashdata('errors')['role'] ?? false): ?>
                <span class="text-red-600 text-sm"><?= session()->getFlashdata('errors')['role'] ?></span>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Password</label>
            <input type="password" name="password" class="border p-2 rounded w-full" value="<?= old('password') ?>" required>
            <?php if(session()->getFlashdata('errors')['password'] ?? false): ?>
                <span class="text-red-600 text-sm"><?= session()->getFlashdata('errors')['password'] ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>
