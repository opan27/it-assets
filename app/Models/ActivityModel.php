<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table      = 'activities';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'action', 'module', 'description', 'ip_address', 'user_agent', 'created_at'];
    public $useTimestamps = false;

    public function log($user_id, $action, $module, $description)
    {
        return $this->insert([
            'user_id'    => $user_id,
            'action'     => $action,
            'module'     => $module,
            'description'=> $description,
            'ip_address' => service('request')->getIPAddress(),
            'user_agent' => service('request')->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
