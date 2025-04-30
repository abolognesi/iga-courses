<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table      = 'courses';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'description', 'price', 'details', 'image'];
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'description' => 'required|min_length[10]',
        'price' => 'required|decimal',
        'details' => 'permit_empty',
        'image' => 'permit_empty',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'El nombre es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.',
            'max_length' => 'El nombre no puede exceder los 255 caracteres.',
        ],
        'description' => [
            'required' => 'La descripción es obligatoria.',
            'min_length' => 'La descripción debe tener al menos 10 caracteres.',
        ],
        'price' => [
            'required' => 'El precio es obligatorio.',
            'decimal' => 'El precio debe ser un número decimal válido.',
        ],
    ];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}