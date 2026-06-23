<?php

namespace App\Models;

use CodeIgniter\Model;

class LogActivityModel extends Model
{
    protected $table = 'log_activity';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'username',
        'action',
        'created_at'
    ];

    /**
     * Helper to write log activity
     */
    public static function log($action)
    {
        $session = session();
        $username = $session->get('username') ?? 'System';
        
        $model = new self();
        $model->insert([
            'username' => $username,
            'action'   => $action
        ]);
    }
}
