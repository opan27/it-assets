<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Dashboard IT Maintenance' ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-gray-100 min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md flex flex-col">
    <div class="p-4 text-xl font-bold border-b">IT Maintenance</div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="/dashboard" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('dashboard')) ? 'bg-gray-200 font-semibold' : '' ?>">Dashboard</a>
      <a href="/pegawai" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('pegawai*')) ? 'bg-gray-200 font-semibold' : '' ?>">Pegawai</a>
      <a href="/kategori" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('kategori*')) ? 'bg-gray-200 font-semibold' : '' ?>">Kategori</a>
      <a href="/lokasi" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('lokasi*')) ? 'bg-gray-200 font-semibold' : '' ?>">Lokasi</a>
      <a href="/kondisi" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('kondisi*')) ? 'bg-gray-200 font-semibold' : '' ?>">Kondisi</a>
      <a href="/assets" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('assets*')) ? 'bg-gray-200 font-semibold' : '' ?>">Assets</a>
      <a href="/picassets" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('picassets*')) ? 'bg-gray-200 font-semibold' : '' ?>">PIC Assets Laptop</a>
      <a href="/asset_lokasi" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('asset_lokasi*')) ? 'bg-gray-200 font-semibold' : '' ?>">Lokasi Assets</a>
      <a href="/activities" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('activities*')) ? 'bg-gray-200 font-semibold' : '' ?>">Report</a>
      <a href="/maintenance" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('maintenance*')) ? 'bg-gray-200 font-semibold' : '' ?>">Maintenance</a>
    </nav>
    <div class="p-4 border-t">
      <a href="/logout" class="block px-3 py-2 text-red-600 hover:bg-red-100 rounded">Logout</a>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6">
    <header class="mb-6">
      <h1 class="text-2xl font-bold"><?= $title ?? 'Dashboard' ?></h1>
    </header>

    <?= $this->renderSection('content') ?>
  </main>
</body>
</html>
