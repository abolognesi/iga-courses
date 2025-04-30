<?php

namespace App\Models;

use CodeIgniter\Model;

class ShoppingModel extends Model
{
    protected $table      = 'shopping';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['client_id', 'course_id', 'date'];
    protected $validationRules = [
        'client_id' => 'required|integer',
        'course_id' => 'required|integer',
        'date' => 'required|valid_date',
    ];
    protected $validationMessages = [
        'client_id' => [
            'required' => 'El cliente es obligatorio.',
            'integer' => 'El cliente debe ser un número entero.',
        ],
        'course_id' => [
            'required' => 'El curso es obligatorio.',
            'integer' => 'El curso debe ser un número entero.',
        ],
        'date' => [
            'required' => 'La fecha de compra es obligatoria.',
            'valid_date' => 'La fecha de compra no es válida.',
        ],
    ];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}