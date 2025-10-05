<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Notification extends Controller
{
    protected $notificationModel;
    protected $userModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
        $this->userModel = new UserModel();
    }

    /**
     * Menampilkan notifikasi untuk user login
     */
    public function index()
    {
        // 🔥 ganti 'id' jadi 'user_id' biar konsisten
        $userId = session()->get('user_id');  
        $data['notifications'] = $this->notificationModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('notifications/index', $data);
    }
    /**
     * Buat notifikasi baru
     * Bisa ditujukan ke 1 user atau ke semua role
     */
    public function create($message, $userId = null, $role = null)
    {
        if ($userId) {
            // notif ke user tertentu
            $this->notificationModel->insert([
                'user_id' => $userId,
                'role'    => null,
                'message' => $message,
                'is_read' => 0
            ]);
        } elseif ($role) {
            // notif broadcast ke semua role tertentu
            $users = $this->userModel->where('role', $role)->findAll();
            foreach ($users as $u) {
                $this->notificationModel->insert([
                    'user_id' => $u['id'],
                    'role'    => $role,
                    'message' => $message,
                    'is_read' => 0
                ]);
            }
        }
    }

    public function markAsRead($id)
    {
        $this->notificationModel->update($id, ['is_read' => 1]);
        return redirect()->back();
    }

    public function markAllAsRead()
    {
        $userId = session()->get('user_id');
        $this->notificationModel->where('user_id', $userId)->set(['is_read' => 1])->update();
        return redirect()->back();
    }

    public function unreadCount()
{
    $userId = session()->get('user_id');
    $role   = session()->get('role');

    // Query sesuai role / user
    if ($role === 'superadmin') {
        $count = $this->notificationModel->groupStart()
                        ->where('role', 'superadmin')
                        ->orWhere('user_id', $userId)
                        ->groupEnd()
                        ->where('is_read', 0)
                        ->countAllResults();
    } else {
        $count = $this->notificationModel
                        ->where('user_id', $userId)
                        ->where('is_read', 0)
                        ->countAllResults();
    }

    return $this->response->setJSON(['count' => $count]);
}

public function latest()
{
    $userId = session()->get('user_id');
    $role   = session()->get('role');

    if ($role === 'superadmin') {
        $notifs = $this->notificationModel->groupStart()
                        ->where('role', 'superadmin')
                        ->orWhere('user_id', $userId)
                        ->groupEnd()
                        ->orderBy('created_at', 'DESC')
                        ->limit(5)
                        ->find();
    } else {
        $notifs = $this->notificationModel->where('user_id', $userId)
                        ->orderBy('created_at', 'DESC')
                        ->limit(5)
                        ->find();
    }

    return $this->response->setJSON($notifs);
}

}
