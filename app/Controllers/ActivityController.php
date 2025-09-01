<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityModel;

class ActivityController extends BaseController
{
    protected $activityModel;

    public function __construct()
    {
        $this->activityModel = new ActivityModel();
    }

    // 📌 List semua activity log
    public function index()
    {
        $activities = $this->activityModel
            ->select('activities.*, users.username')
            ->join('users', 'users.id = activities.user_id', 'left')
            ->orderBy('activities.created_at', 'DESC')
            ->findAll();

        return view('activities/index', [
            'activities' => $activities
        ]);
    }

    // 📌 Simpan activity baru (biasanya dipanggil otomatis setelah CRUD user lain)
    public function store($userId, $action, $module, $description = '')
    {
        $data = [
            'user_id'     => $userId,
            'action'      => $action,
            'module'      => $module,
            'description' => $description,
            'ip_address'  => $this->request->getIPAddress(),
            'user_agent'  => $this->request->getUserAgent()->getAgentString(),
        ];

        $this->activityModel->insert($data);
    }

    // 📌 Detail 1 log
    public function show($id)
    {
        $activity = $this->activityModel
            ->select('activities.*, users.username')
            ->join('users', 'users.id = activities.user_id', 'left')
            ->find($id);

        if (!$activity) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Activity tidak ditemukan');
        }

        return view('activities/show', [
            'activity' => $activity
        ]);
    }
}
