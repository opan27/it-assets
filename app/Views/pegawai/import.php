<?= session()->getFlashdata('error') ?>
<?= session()->getFlashdata('success') ?>

<form action="<?= base_url('pegawai/upload') ?>" method="post" enctype="multipart/form-data">
    <label>Pilih File Excel</label>
    <input type="file" name="file_excel" accept=".xls,.xlsx,.csv" required>
    <button type="submit">Import</button>
</form>
