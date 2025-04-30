<?php

namespace App\Controllers;

use App\Models\ShoppingModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class ShoppingController extends Controller
{
    use ResponseTrait;

    private $shoppingModel;

    public function __construct()
    {
        $this->shoppingModel = new ShoppingModel();
    }

    /**
     * funcion realizada para permitir el acceso a la API desde el frontend
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function options()
    {
        if ($this->request->getMethod() === 'options') {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
                ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
                ->setStatusCode(200);
        }
    }

    /**
     * Devuelve todas las compras
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function index()
    {
        $shopping = $this->shoppingModel->findAll();
        return $this->respond($shopping);
    }

    /**
     * realizar una compra
     * @param mixed $id
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function registerPurchase()
    {
        $data = $this->request->getJSON(true);
  
        $clientModel = new \App\Models\ClientModel();
        $client = $clientModel->where('email', $data['email'])->first();
        if (!$client) {
            $dataClient = [
                'id'     => null,
                'name'   => $data['name'],
                'email'    => $data['email'],
                'cell_phone'  => $data['cell_phone'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ];
            if (!$clientModel->insert($dataClient)) {
                return $this->fail($clientModel->errors());
            }
            $clientId = $clientModel->getInsertID();
        } else {
            $clientId = $client['id'];
        }

        $this->shoppingModel->insert([
            'id'         => null,
            'client_id' => $clientId,
            'course_id'   => $data['course_id'],
            'date'       => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        return $this->respondCreated(['message' => 'Compra registrada']);
    }

    /**
     * Devuelve las compras de un cliente específico segun el email
     * @param mixed $id
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function pourchasesOrderByClient()
    {
        $email = $this->request->getGet('email');
        if (!$email) {
            return $this->fail('Email no proporcionado');
        }
        $clientModel = new \App\Models\ClientModel();
        $client = $clientModel->where('email', $email)->first();

        if (!$client) {
            return $this->failNotFound('Cliente no encontrado');
        }

        $purchases = $this->shoppingModel->where('client_id', $client['id'])->findAll();

        return $this->respond($purchases);
    }

    /**
     * Funcion especifica para el administrador, devuelve la cantidad de compras por curso
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function admin()
    {
        // en este punto se puede agregar una validacion para verificar si el usuario es administrador
        // o si tiene permisos para acceder a esta funcion
        // por ahora se dejara sin validacion por cuestiones de tiempo
        $result = $this->shoppingModel->select('course_id, COUNT(*) as total')
                        ->groupBy('course_id')
                        ->findAll();
        return $this->respond($result);
    }
}