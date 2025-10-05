<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="max-w-6xl mx-auto p-6 space-y-8">

    <!-- ALERT Deadline -->
    <?php if (!empty($maintenance['due_date']) && $maintenance['due_date'] !== '0000-00-00 00:00:00' && strtotime($maintenance['due_date']) < time()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow mb-4">
            ⚠️ <b>Deadline sudah lewat!</b> 
            (<?= date('d M Y H:i', strtotime($maintenance['due_date'])) ?>)
        </div>
    <?php endif; ?>

    <!-- Info Tiket -->
    <div class="bg-white rounded-xl shadow border p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Detail Tiket Maintenance</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <p><b>Asset:</b> <?= esc($maintenance['asset_nama'] ?? '-') ?></p>
            <p><b>Kode Asset:</b> <?= esc($maintenance['kode_asset'] ?? '-') ?></p>
            <p><b>Kode GA:</b> <?= esc($maintenance['kode_ga'] ?? '-') ?></p>
            <p><b>Spesifikasi:</b> <?= esc($maintenance['spesifikasi'] ?? '-') ?></p>
            <p><b>PIC:</b> <?= esc($maintenance['pic_nama'] ?? '-') ?></p>
            <p><b>Entitas:</b> <?= esc($maintenance['entitas_nama'] ?? '-') ?></p>
            <p><b>Lokasi:</b> <?= esc($maintenance['lokasi'] ?? '-') ?></p>
            <p><b>Status:</b> <?= esc(ucwords(str_replace('_',' ',$maintenance['status']))) ?></p>
            <p><b>Kendala:</b> <?= esc($maintenance['kendala'] ?? '-') ?></p>
            <p><b>Dibuat:</b> <?= esc(isset($maintenance['created_at']) ? date('d M Y H:i', strtotime($maintenance['created_at'])) : '-') ?></p>
            <p><b>Deadline:</b>
                <?php if (!empty($maintenance['due_date']) && $maintenance['due_date'] !== '0000-00-00 00:00:00'): ?>
                    <?php if (strtotime($maintenance['due_date']) < time()): ?>
                        <span class="text-red-600 font-bold">
                            <?= date('d M Y H:i', strtotime($maintenance['due_date'])) ?> (Overdue)
                        </span>
                    <?php else: ?>
                        <span class="text-green-600 font-semibold">
                            <?= date('d M Y H:i', strtotime($maintenance['due_date'])) ?>
                        </span>
                    <?php endif; ?>
                <?php else: ?>
                    -
                <?php endif; ?>
            </p>
        </div>
    </div>

    <!-- Grid 2 Kolom -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Kiri -->
        <div class="space-y-8">

            <!-- Form Update Progress -->
            <div class="bg-white rounded-xl shadow border p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Update Progress</h3>
                <form action="<?= base_url('teknisi/update-status') ?>" method="post" enctype="multipart/form-data" class="space-y-4">
                    <input type="hidden" name="ticket_id" value="<?= esc($maintenance['id']) ?>">

                    <div>
                        <label class="block font-medium mb-1">Status</label>
                        <select name="status" class="border p-2 rounded w-full">
                            <option value="in_progress" <?= $maintenance['status']=='in_progress'?'selected':'' ?>>In Progress</option>
                            <option value="done" <?= $maintenance['status']=='done'?'selected':'' ?>>Done</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Deskripsi</label>
                        <textarea name="deskripsi" class="border p-2 rounded w-full" rows="3" placeholder="Isi update progress..."></textarea>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Foto (opsional, wajib jika Done)</label>
                        <input type="file" name="foto" class="border p-2 rounded w-full">
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                        Update
                    </button>
                </form>
            </div>

            <!-- Tracking Progress -->
<!-- Tracking Progress -->
<div class="bg-white rounded-xl shadow border p-6">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Tracking Progress</h3>
    <div class="space-y-4">
        <?php if(!empty($progress_list)): ?>
            <?php foreach($progress_list as $p): 
                $isDone = $p['status'] === 'done';
                $deadline = !empty($maintenance['due_date']) && $maintenance['due_date'] !== '0000-00-00 00:00:00'
                            ? strtotime($maintenance['due_date']) : null;
                $isOverdue = $deadline && $deadline < time();
                
                // Tentukan warna
                if ($isDone) {
                    $progressColor = 'bg-green-100 border-green-400 text-green-700';
                } elseif ($isOverdue) {
                    $progressColor = 'bg-red-100 border-red-400 text-red-700';
                } else {
                    $progressColor = 'bg-yellow-100 border-yellow-400 text-yellow-700';
                }
            ?>
                <div class="p-4 border rounded-lg <?= $progressColor ?> hover:opacity-90 transition">
                    <p class="text-xs"><?= date('d M Y H:i', strtotime($p['created_at'])) ?></p>
                    <p>
                        <b>Status:</b>
                        <span class="<?= $isDone ? 'text-green-600 font-bold' : ($isOverdue ? 'text-red-600 font-bold' : 'text-yellow-600') ?>">
                            <?= esc(strtoupper($p['status'])) ?>
                        </span>
                    </p>
                    <p><b>Oleh:</b> <?= esc($p['user_nama'] ?? $maintenance['assigned_to_nama'] ?? '-') ?></p>
                    <p><?= esc($p['deskripsi']) ?></p>
                    <?php if(!empty($p['foto'])): ?>
                        <div class="mt-3">
                            <img src="<?= base_url('uploads/progress/'.$p['foto']) ?>" alt="Foto Progress" class="max-w-xs rounded-lg shadow">
                        </div>
                    <?php endif; ?>

                    <!-- Info Deadline -->
                    <?php if ($deadline): ?>
                        <p class="mt-2 text-sm">
                            <b>Deadline:</b> <?= date('d M Y H:i', $deadline) ?>
                            <?php if ($isOverdue && !$isDone): ?>
                                <span class="ml-2 text-red-700 font-bold">(Overdue)</span>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500 italic">Belum ada progress.</p>
        <?php endif; ?>
    </div>
</div>

        </div>

        <!-- Kanan -->
        <div class="space-y-8">

            <!-- Gantt Progress -->
            <div class="bg-white rounded-xl shadow border p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Gantt Progress</h3>
                <div id="gantt"></div>
            </div>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.css"/>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.min.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var tasks = <?= json_encode($progress) ?>;

                    new Gantt("#gantt", tasks, {
                        view_mode: 'Day',
                        date_format: 'YYYY-MM-DD HH:mm:ss',
                        custom_popup_html: function(task) {
                            return `
                                <div class="details-container p-2">
                                    <h5>${task.name}</h5>
                                    <p><b>Start:</b> ${task.start}</p>
                                    <p><b>End:</b> ${task.end}</p>
                                </div>
                            `;
                        }
                    });
                });
            </script>

            <!-- Forum Diskusi -->
            <div class="bg-white rounded-xl shadow border p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Forum Diskusi</h3>
                <div id="chat-box" class="h-72 overflow-y-auto border p-4 rounded bg-gray-50 mb-4 space-y-4">
                    <?php if(!empty($messages)): ?>
                        <?php foreach($messages as $msg): 
                            $isMe = ($msg['sender_id'] == session()->get('user_id')); ?>
                            <div class="flex <?= $isMe ? 'justify-end' : 'justify-start' ?>">
                                <div class="max-w-xs px-4 py-2 rounded-2xl shadow
                                            <?= $isMe ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' ?>">
                                    <p class="text-sm font-semibold"><?= esc($msg['sender_nama']) ?></p>
                                    <p class="text-sm"><?= esc($msg['message']) ?></p>
                                    <p class="text-xs mt-1 <?= $isMe ? 'text-blue-100' : 'text-gray-500' ?>">
                                        <?= date('d M Y H:i', strtotime($msg['created_at'])) ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 italic">Belum ada pesan.</p>
                    <?php endif; ?>
                </div>

                <form action="<?= base_url('teknisi/maintenance/send-message') ?>" method="post" class="flex gap-2">
                    <input type="hidden" name="maintenance_id" value="<?= $maintenance['id'] ?>">
                    <input type="text" name="message" class="flex-1 border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-300" placeholder="Tulis pesan..." required>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
