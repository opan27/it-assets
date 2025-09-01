<?php

use App\Models\ActivityModel;

if (!function_exists('add_log')) {
    function add_log($action, $module, $description)
    {
        $activityModel = new ActivityModel();

        $data = [
            'username'    => session()->get('username') ?? 'guest',
            'action'      => $action,
            'module'      => $module,
            'description' => $description,
            'ip_address'  => service('request')->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $activityModel->insert($data);
    }
}
