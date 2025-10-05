<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Dashboard IT Maintenance' ?></title>

  <!-- Tailwind & CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/frappe-gantt/dist/frappe-gantt.css" />
</head>

<body class="flex bg-gray-100 min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md flex flex-col">
    <div class="p-4 text-xl font-bold border-b">IT Maintenance</div>

    <nav class="flex-1 p-4 space-y-2">
      <!-- Dashboard -->
      <?php if (session('role') === 'superadmin'): ?>
        <a href="<?= base_url('dashboard') ?>"
           class="block px-3 py-2 rounded hover:bg-gray-200 <?= url_is('dashboard') ? 'bg-gray-200 font-semibold' : '' ?>">
           Dashboard
        </a>
      <?php elseif (session('role') === 'teknisi'): ?>
        <a href="<?= base_url('teknisi/dashboard') ?>"
           class="block px-3 py-2 rounded hover:bg-gray-200 <?= url_is('teknisi/dashboard') ? 'bg-gray-200 font-semibold' : '' ?>">
           Dashboard
        </a>
      <?php endif; ?>

      <!-- Menu Superadmin -->
      <?php if (session()->get('role') === 'superadmin'): ?>
        
        <!-- Entitas -->
        <div>
          <button onclick="toggleMenu('entitasMenu')"
                  class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-200">
            <span>Entitas</span>
            <svg id="arrow-entitasMenu" class="h-5 w-5 transform transition-transform duration-200"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </button>
          <div id="entitasMenu" class="hidden mt-2 space-y-1 pl-4">
            <a href="/entitas/mf"  class="block py-2 px-3 rounded hover:bg-gray-200">MF</a>
            <a href="/entitas/mdi" class="block py-2 px-3 rounded hover:bg-gray-200">MDI</a>
            <a href="/entitas/kun" class="block py-2 px-3 rounded hover:bg-gray-200">KUN</a>
            <a href="/entitas/mik" class="block py-2 px-3 rounded hover:bg-gray-200">MIK</a>
          </div>
        </div>

        <!-- Master Data -->
        <div>
          <button onclick="toggleMenu('masterDataMenu')"
                  class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-200
                         <?= (url_is('pegawai*') || url_is('kategori*') || url_is('lokasi*') || url_is('kondisi*')) ? 'bg-gray-200 font-semibold' : '' ?>">
            <span>Master Data</span>
            <svg id="arrow-masterDataMenu" class="h-5 w-5 transform transition-transform duration-200"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </button>
          <div id="masterDataMenu" class="hidden mt-2 space-y-1 pl-4">
            <a href="/pegawai"  class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('pegawai*')) ? 'bg-gray-200 font-semibold' : '' ?>">Pegawai</a>
            <a href="/kategori" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('kategori*')) ? 'bg-gray-200 font-semibold' : '' ?>">Kategori</a>
            <a href="/lokasi"   class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('lokasi*')) ? 'bg-gray-200 font-semibold' : '' ?>">Lokasi</a>
            <a href="/kondisi"  class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('kondisi*')) ? 'bg-gray-200 font-semibold' : '' ?>">Kondisi</a>
          </div>
        </div>

        <!-- Menu lainnya -->
        <a href="/admin/users"  class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('admin/users*')) ? 'bg-gray-200 font-semibold' : '' ?>">Users</a>
        <a href="/assets"       class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('assets*')) ? 'bg-gray-200 font-semibold' : '' ?>">Assets</a>
        <a href="/picassets"    class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('picassets*')) ? 'bg-gray-200 font-semibold' : '' ?>">PIC Assets Laptop</a>
        <a href="/maintenance"  class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('maintenance*')) ? 'bg-gray-200 font-semibold' : '' ?>">Maintenance</a>
        <a href="/beritaacara"  class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('beritaacara*')) ? 'bg-gray-200 font-semibold' : '' ?>">Berita Acara</a>
      
      <?php endif; ?>

      <!-- Menu Teknisi -->
      <?php if (session()->get('role') === 'teknisi'): ?>
        <a href="/maintenance" class="block px-3 py-2 rounded hover:bg-gray-200 <?= (url_is('maintenance*')) ? 'bg-gray-200 font-semibold' : '' ?>">
          Maintenance
        </a>
      <?php endif; ?>
    </nav>
  </aside>

  <!-- Main -->
  <div class="flex-1 flex flex-col">

    <!-- Topbar -->
    <header class="bg-white shadow px-6 py-3 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-700"><?= $title ?? 'Dashboard' ?></h1>

      <div class="flex items-center gap-4">
        
        <!-- Notifikasi -->
        <div class="relative">
          <button id="notifBtn" class="relative p-2 rounded-full hover:bg-gray-100 focus:outline-none">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405C18.21 14.79 18 14.42 18 14V11
                       c0-3.07-1.63-5.64-4.5-6.32V4a1.5 1.5 0 00-3 0v.68
                       C7.63 5.36 6 7.92 6 11v3c0 .42-.21.79-.595 1.595L4 17h5m6 0v1
                       a3 3 0 11-6 0v-1h6z"/>
            </svg>
            <span id="notifCount"
                  class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full px-1">
              <?= $notifCount ?? 3 ?>
            </span>
          </button>

          <!-- Dropdown Notifikasi -->
          <div class="relative">
            <a href="#" id="notifDropdown" class="flex items-center">
              <i class="fas fa-bell"></i>
              <span id="notifBadge" class="ml-1 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full hidden">0</span>
            </a>

            <div id="notifMenu"
                 class="absolute right-0 mt-2 w-64 bg-white rounded shadow-lg border hidden z-50">
              <div class="px-4 py-2 font-semibold border-b">Notifikasi</div>
              <ul id="notifList" class="max-h-64 overflow-y-auto">
                <li class="px-4 py-2 text-sm text-gray-500">Memuat...</li>
              </ul>
              <div class="border-t">
                <a href="/notifications" class="block text-center px-4 py-2 text-sm hover:bg-gray-50">
                  Lihat semua
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Profil -->
        <div class="relative">
          <button id="profileBtn"
                  class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 focus:outline-none">
            <img src="/path/to/avatar.png" alt="avatar" class="w-8 h-8 rounded-full">
            <span class="font-medium text-gray-700"><?= session('username') ?? 'User' ?></span>
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <!-- Dropdown Profil -->
          <div id="profileMenu"
               class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg border hidden">
            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
            <div class="border-t my-1"></div>
            <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Konten -->
    <main class="flex-1 p-6">
      <?= $this->renderSection('content') ?>
    </main>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/frappe-gantt/dist/frappe-gantt.umd.js"></script>

  <script>
    // Toggle Menu Sidebar
    function toggleMenu(id) {
      const menu  = document.getElementById(id);
      const arrow = document.getElementById("arrow-" + id);
      menu.classList.toggle("hidden");
      arrow.classList.toggle("rotate-90");
    }

    // Toggle Profil & Notifikasi
    document.getElementById('profileBtn').addEventListener('click', () => {
      document.getElementById('profileMenu').classList.toggle('hidden');
    });

    document.getElementById('notifBtn').addEventListener('click', () => {
      document.getElementById('notifMenu').classList.toggle('hidden');
    });

    // Klik di luar -> close
    window.addEventListener('click', (e) => {
      const profileBtn  = document.getElementById('profileBtn');
      const profileMenu = document.getElementById('profileMenu');
      const notifBtn    = document.getElementById('notifBtn');
      const notifMenu   = document.getElementById('notifMenu');

      if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
        profileMenu.classList.add('hidden');
      }
      if (!notifBtn.contains(e.target) && !notifMenu.contains(e.target)) {
        notifMenu.classList.add('hidden');
      }
    });

    // Load Notifikasi
    function loadNotif() {
      // Jumlah notif
      $.getJSON("/notifications/unread-count", function(data) {
        if (data.count > 0) {
          $("#notifBadge").text(data.count).show();
        } else {
          $("#notifBadge").hide();
        }
      });

      // Daftar notif
      $.getJSON("/notifications/latest", function(data) {
        let list = $("#notifList");
        list.empty();

        if (data.length > 0) {
          data.forEach(n => {
            list.append(`<li class="px-4 py-2 hover:bg-gray-100 text-sm">${n.message}</li>`);
          });
        } else {
          list.append(`<li class="px-4 py-2 text-sm text-gray-500">Tidak ada notifikasi</li>`);
        }
      });
    }

    // Load awal + refresh tiap 5 detik
    loadNotif();
    setInterval(loadNotif, 5000);

    // Buka dropdown → tandai sudah dibaca
    $("#notifDropdown").on("click", function(e) {
      e.preventDefault();
      $("#notifMenu").toggle();

      if ($("#notifMenu").is(":visible")) {
        $.get("/notifications/mark-all-read", function() {
          $("#notifBadge").hide();
        });
      }
    });
  </script>

</body>
</html>
