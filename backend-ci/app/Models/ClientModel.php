<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table      = 'clients';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'email', 'cell_phone'];
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email|is_unique[clients.email]',
        'cell_phone' => 'required|min_length[10]|max_length[20]',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'El nombre es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.',
            'max_length' => 'El nombre no puede exceder los 255 caracteres.',
        ],
        'email' => [
            'required' => 'El correo electrónico es obligatorio.',
            'valid_email' => 'El correo electrónico no es válido.',
            'is_unique' => 'El correo electrónico ya está en uso.',
        ],
        'cell_phone' => [
            'required' => 'El número de teléfono celular es obligatorio.',
            'min_length' => 'El número de teléfono celular debe tener al menos 10 caracteres.',
            'max_length' => 'El número de teléfono celular no puede exceder los 20 caracteres.',
        ],
    ];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}